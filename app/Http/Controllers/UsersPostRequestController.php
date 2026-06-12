<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UsersPostRequestController extends Controller
{
    // register
    public function Register(){
        $phone=request('phone');
        $ref=DB::table('users')->where('uniqid',request('ref'))->where('status','active');
        $upline=null;
        if($ref->exists()){
            $upline=$ref->first()->id;
        }
    if(request('verification_code') != request('captcha')){
        return response()->json([
            'message' => 'Invalid verification code',
            'status' => 'error'
        ]);
    }
    if(strlen($phone) != 11){
        return response()->json([
            'message' => 'Phone number must be 11-digits'
        ]);
    }
    if(DB::table('users')->where('phone',$phone)->exists()){
        return response()->json([
            'message' => 'Mobile number has been taken',
            'status' => 'error'
        ]);
    }

    if(!Hash::check(request('confirm_password'),Hash::make(request('password')))){
        return response()->json([
            'message' => 'Password & confirm password must match',
            'status' => 'error'
        ]);
    }

    DB::table('users')->insert([
        'uniqid' => GenerateID(),
        'type' => 'user',
        'username' => $phone,
        'phone' => $phone,
        'name' => $phone,
        'email' => $phone.'@'.str_replace(['http://','https://'],'',env('APP_URL')),
        'ref' => $upline,
        'password' => Hash::make(request('password')),
        'status' => 'active',
        'updated' => Carbon::now(),
        'date' => Carbon::now()
    ]);
    return response()->json([
        'message' => 'Registration successfull,redirecting...',
        'status' => 'success'
    ]);
    }

    // login
    public function Login(){
       
        $phone=request('phone');
        if(!DB::table('users')->where('phone',$phone)->exists()){
            return response()->json([
                'message' => 'User not found',
                'status' => 'error'
            ]);
        }
        $user=DB::table('users')->where('phone',$phone)->first();
        if($user->status == 'banned'){
            return response()->json([
                'message' => 'User account is banned',
                'status' => 'error'
            ]);
        }

        if(!Hash::check(request('password'),$user->password)){
            return response()->json([
                'message' => 'Invalid account password',
                'status' => 'error'
            ]);
        }
        Auth::guard('users')->loginUsingId($user->id,true);
        DB::table('logs')->updateOrInsert([ 'user_id' => $user->id ],[
            'user_id' => $user->id,
            'status' => 'success',
            'date' => Carbon::now()
        ]);
        return response()->json([
            'message' => 'Login successful,redirecting...',
            'status' => 'success'
        ]);

    }

    // purchase package
    public function PurchasePackage(){
        $tx=false;
        $package=DB::table('packages')->where('id',request('id'))->first();
        $referral_settings=json_decode(DB::table('settings')->where('key','referral_settings')->first()->value ?? '{}');
        if($package->available <= 0){
            return response()->json([
                'message' => 'Package is no longer available for purchase',
                'status' => 'info'
            ]);
        }
        if($package->cost > Auth::guard('users')->user()->deposit_balance){
            return response()->json([
                'message' => 'Insufficient balance,recharge your account to continue',
                'status' => 'error'
            ]);
        }

            $tx=DB::transaction(function() use($package,$referral_settings){
     DB::table('users')->where('id',Auth::guard('users')->user()->id)->update([
            'deposit_balance' => DB::raw('deposit_balance - '.$package->cost.''),
            'updated' => Carbon::now()
        ]);
        $investment_id=DB::table('purchased_packages')->insertGetId([
        'uniqid' => GenerateID(),
        'user_id' => Auth::guard('users')->user()->id,
        'package' => json_encode($package),
        'cycle' => $package->validity,
        'status' => 'active',
        'updated' => carbon::now(),
        'date' => Carbon::now()
    ]);

          DB::table('transactions')->insert([
    'uniqid' => GenerateID(),
    'user_id' => Auth::guard('users')->user()->id,
    'title' => 'Investment Package purchase',
    'class' => 'debit',
    'fee' => 0,
    'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4 3H20L22 7V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V7.00353L4 3ZM13 14V10H11V14H8L12 18L16 14H13ZM19.7639 7L18.7639 5H5.23656L4.23744 7H19.7639Z"></path></svg>',
    'type' => 'package_purchase',
    'amount' => $package->cost,
    'wallet' => json_encode([
        'from' => 'deposit_balance',
        'to' => 'admin',

    ]),
    'data' => json_encode([
        'Package' => $package->name,
        'Package Cost' => Auth::guard('users')->user()->currency.number_format($package->cost,2),
        'Daily Earning' => Auth::guard('users')->user()->currency.number_format($package->earning,2),
        'Total Earning' => Auth::guard('users')->user()->currency.number_format($package->earning * $package->validity,2),
        'Expires' => 'After '.number_format($package->validity).' days'
    ]),
     'json' => json_encode([
    'balance' => [
        'before' => Auth::guard('users')->user()->deposit_balance,
        'after' => Auth::guard('users')->user()->deposit_balance - $package->cost
    ],
    'primary_wallet' => 'Deposit Wallet',
    'package_id' => $package->id,
    'investment_id' => $investment_id

    ]),
    'status' => 'success',
    'updated' => Carbon::now(),
    'date' => Carbon::now()
    ]);
    
    DB::table('packages')->where('id',request('id'))->decrement('available');
    // level 1 referral commission
    if(Auth::guard('users')->user()->ref !== null && $referral_settings->level_1 > 0){
        $level1_commission=($referral_settings->level_1 * $package->cost)/100;
        $level1=DB::table('users')->where('id',Auth::guard('users')->user()->ref)->first();
        DB::table('users')->where('id',Auth::guard('users')->user()->ref)->increment('main_balance',$level1_commission,[
            'updated' => Carbon::now()
        ]);

     
          DB::table('transactions')->insert([
    'uniqid' => GenerateID(),
    'user_id' => $level1->id,
    'title' => 'Level 1 referral commission',
    'class' => 'credit',
    'fee' => 0,
    'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15.0049 2.00281C17.214 2.00281 19.0049 3.79367 19.0049 6.00281C19.0049 6.73184 18.8098 7.41532 18.4691 8.00392L23.0049 8.00281V10.0028H21.0049V20.0028C21.0049 20.5551 20.5572 21.0028 20.0049 21.0028H4.00488C3.4526 21.0028 3.00488 20.5551 3.00488 20.0028V10.0028H1.00488V8.00281L5.54065 8.00392C5.19992 7.41532 5.00488 6.73184 5.00488 6.00281C5.00488 3.79367 6.79574 2.00281 9.00488 2.00281C10.2001 2.00281 11.2729 2.52702 12.0058 3.35807C12.7369 2.52702 13.8097 2.00281 15.0049 2.00281ZM11.0049 10.0028H5.00488V19.0028H11.0049V10.0028ZM19.0049 10.0028H13.0049V19.0028H19.0049V10.0028ZM9.00488 4.00281C7.90031 4.00281 7.00488 4.89824 7.00488 6.00281C7.00488 7.05717 7.82076 7.92097 8.85562 7.99732L9.00488 8.00281H11.0049V6.00281C11.0049 5.00116 10.2686 4.1715 9.30766 4.02558L9.15415 4.00829L9.00488 4.00281ZM15.0049 4.00281C13.9505 4.00281 13.0867 4.81869 13.0104 5.85355L13.0049 6.00281V8.00281H15.0049C16.0592 8.00281 16.923 7.18693 16.9994 6.15207L17.0049 6.00281C17.0049 4.89824 16.1095 4.00281 15.0049 4.00281Z"></path></svg>',
    'type' => 'referral_commission',
    'amount' => $level1_commission,
    'wallet' => json_encode([
        'from' => 'admin',
        'to' => 'main_balance',

    ]),
    'data' => json_encode([
        'Referred User' => ucwords(Auth::guard('users')->user()->username),
        'Referral Level' => 'Level 1',
        'Package Purchased' => $package->name,
        'Package Cost' => $level1->currency.number_format($package->cost,2),
         ]),
     'json' => json_encode([
    'balance' => [
        'before' => $level1->main_balance,
        'after' => $level1->main_balance + $level1_commission
    ],
    'primary_wallet' => 'Main Wallet',
    'level' => 1

    ]),
    'status' => 'success',
    'updated' => Carbon::now(),
    'date' => Carbon::now()
    ]);

    // level 2 referral commission
    if($level1->ref !== null && $referral_settings->level_2 > 0){
            $level2=DB::table('users')->where('id',$level1->ref)->first();
            $level2_commission=($referral_settings->level_2 * $package->cost)/100;
            DB::table('users')->where('id',$level2->id)->increment('main_balance',$level2_commission,[
            'updated' => Carbon::now()
        ]);

     
          DB::table('transactions')->insert([
    'uniqid' => GenerateID(),
    'user_id' => $level2->id,
    'title' => 'Level 2 referral commission',
    'class' => 'credit',
    'fee' => 0,
    'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15.0049 2.00281C17.214 2.00281 19.0049 3.79367 19.0049 6.00281C19.0049 6.73184 18.8098 7.41532 18.4691 8.00392L23.0049 8.00281V10.0028H21.0049V20.0028C21.0049 20.5551 20.5572 21.0028 20.0049 21.0028H4.00488C3.4526 21.0028 3.00488 20.5551 3.00488 20.0028V10.0028H1.00488V8.00281L5.54065 8.00392C5.19992 7.41532 5.00488 6.73184 5.00488 6.00281C5.00488 3.79367 6.79574 2.00281 9.00488 2.00281C10.2001 2.00281 11.2729 2.52702 12.0058 3.35807C12.7369 2.52702 13.8097 2.00281 15.0049 2.00281ZM11.0049 10.0028H5.00488V19.0028H11.0049V10.0028ZM19.0049 10.0028H13.0049V19.0028H19.0049V10.0028ZM9.00488 4.00281C7.90031 4.00281 7.00488 4.89824 7.00488 6.00281C7.00488 7.05717 7.82076 7.92097 8.85562 7.99732L9.00488 8.00281H11.0049V6.00281C11.0049 5.00116 10.2686 4.1715 9.30766 4.02558L9.15415 4.00829L9.00488 4.00281ZM15.0049 4.00281C13.9505 4.00281 13.0867 4.81869 13.0104 5.85355L13.0049 6.00281V8.00281H15.0049C16.0592 8.00281 16.923 7.18693 16.9994 6.15207L17.0049 6.00281C17.0049 4.89824 16.1095 4.00281 15.0049 4.00281Z"></path></svg>',
    'type' => 'referral_commission',
    'amount' => $level2_commission,
    'wallet' => json_encode([
        'from' => 'admin',
        'to' => 'main_balance',

    ]),
    'data' => json_encode([
        'Level 1 Referra1' => ucwords(Auth::guard('users')->user()->username),
        'Referred User' => ucwords($level2->ref),
        'Referral Level' => 'Level 2',
        'Package Purchased' => $package->name,
        'Package Cost' => $level2->currency.number_format($package->cost,2),
         ]),
     'json' => json_encode([
    'balance' => [
        'before' => $level2->main_balance,
        'after' => $level2->main_balance + $level2_commission
    ],
    'primary_wallet' => 'Main Wallet',
    'level' => 2

    ]),
    'status' => 'success',
    'updated' => Carbon::now(),
    'date' => Carbon::now()
    ]);

        if($level2->ref !== null && $referral_settings->level_3 > 0){
               $level3=DB::table('users')->where('id',$level2->ref)->first();
            $level3_commission=($referral_settings->level_3 * $package->cost)/100;
            DB::table('users')->where('id',$level3->id)->increment('main_balance',$level3_commission,[
            'updated' => Carbon::now()
        ]);

     
          DB::table('transactions')->insert([
    'uniqid' => GenerateID(),
    'user_id' => $level3->id,
    'title' => 'Level 3 referral commission',
    'class' => 'credit',
    'fee' => 0,
    'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15.0049 2.00281C17.214 2.00281 19.0049 3.79367 19.0049 6.00281C19.0049 6.73184 18.8098 7.41532 18.4691 8.00392L23.0049 8.00281V10.0028H21.0049V20.0028C21.0049 20.5551 20.5572 21.0028 20.0049 21.0028H4.00488C3.4526 21.0028 3.00488 20.5551 3.00488 20.0028V10.0028H1.00488V8.00281L5.54065 8.00392C5.19992 7.41532 5.00488 6.73184 5.00488 6.00281C5.00488 3.79367 6.79574 2.00281 9.00488 2.00281C10.2001 2.00281 11.2729 2.52702 12.0058 3.35807C12.7369 2.52702 13.8097 2.00281 15.0049 2.00281ZM11.0049 10.0028H5.00488V19.0028H11.0049V10.0028ZM19.0049 10.0028H13.0049V19.0028H19.0049V10.0028ZM9.00488 4.00281C7.90031 4.00281 7.00488 4.89824 7.00488 6.00281C7.00488 7.05717 7.82076 7.92097 8.85562 7.99732L9.00488 8.00281H11.0049V6.00281C11.0049 5.00116 10.2686 4.1715 9.30766 4.02558L9.15415 4.00829L9.00488 4.00281ZM15.0049 4.00281C13.9505 4.00281 13.0867 4.81869 13.0104 5.85355L13.0049 6.00281V8.00281H15.0049C16.0592 8.00281 16.923 7.18693 16.9994 6.15207L17.0049 6.00281C17.0049 4.89824 16.1095 4.00281 15.0049 4.00281Z"></path></svg>',
    'type' => 'referral_commission',
    'amount' => $level3_commission,
    'wallet' => json_encode([
        'from' => 'admin',
        'to' => 'main_balance',

    ]),
    'data' => json_encode([
        'Level 1 Referral' => ucwords(Auth::guard('users')->user()->username),
        'Level 2 Referral' => ucwords($level2->username),
        'Referred User' => ucwords($level3->ref),
        'Referral Level' => 'Level 3',
        'Package Purchased' => $package->name,
        'Package Cost' => $level3->currency.number_format($package->cost,2),
         ]),
     'json' => json_encode([
    'balance' => [
        'before' => $level3->main_balance,
        'after' => $level3->main_balance + $level3_commission
    ],
    'primary_wallet' => 'Main Wallet',
    'level' => 3

    ]),
    'status' => 'success',
    'updated' => Carbon::now(),
    'date' => Carbon::now()
    ]);
        }
            
    }
    }
    return true;
            });
       
            if($tx){
     return response()->json([
            'message' => 'Package purchased successfully',
            'status' => 'success'
        ]);
            }

             return response()->json([
            'message' => 'Internal server error',
            'status' => 'error'
        ]);
       
    }

    // add bank
    public function AddBank(){
        $account_number=request('account_number');
        $account_name=request('account_name');
        $bank_id=request('bank_name');
        $banks=json_decode(file_get_contents(database_path('data/banks.json')));
        $bank_name=collect($banks)->where('id',$bank_id)->first()->name;

        if(strlen($account_number) != 10){
                return response()->json([
                    'message' => 'Please enter a valid 10-digits account number',
                    'status' => 'error'
                ]);
        }

        $json=[];
        $json['account_number'] = $account_number;
        $json['bank_name'] = $bank_name;
        $json['account_name'] = $account_name;
        $json['bank_id'] = $bank_id;

        DB::table('users')->where('id',Auth::guard('users')->user()->id)->update([
            'bank' => json_encode($json),
            'updated' => Carbon::now()
        ]);

        return response()->json([
            'message' => 'Bank account added successfully',
            'status' => 'success'
        ]);

      
    }

    // withdrawal
    public function Withdrawal(){
        try{
            $amount=request('amount');
        $finance_settings=json_decode(DB::table('settings')->where('key','finance_settings')->first()->value ?? '{}');
        $fee=($finance_settings->withdrawal->fee * $amount)/100;
        $amt=$amount - $fee;
        if(Auth::guard('users')->user()->status == 'banned'){
            return response()->json([
                'message' => 'Your account have been banned',
                'status' => 'error',
                'action' => 'refresh'
            ]);
        }
        if($amount > Auth::guard('users')->user()->main_balance){
            return response()->json([
                'message' => 'Insufficient balance',
                'status' => 'warning'
            ]);
        }

        if($amount == 0){
            return response()->json([
                'message' => 'Please enter a vaild amount',
                'status' => 'error'
            ]);
        }

        if($amount < $finance_settings->withdrawal->minimum){
            return response()->json([
                'message' => 'Minimum withdrawal is ₦'.number_format($finance_settings->withdrawal->minimum,2).'',
                'status' => 'error'
            ]);
        }

        if($finance_settings->withdrawal->maximum != 0 && $amount > $finance_settings->withdrawal->maximum){
              return response()->json([
                'message' => 'Maximum withdrawal per request is ₦'.number_format($finance_settings->withdrawal->maximum,2).'',
                'status' => 'error'
            ]);
        }

        if($finance_settings->withdrawal->portal == 'off'){
            return response()->json([
                'message' => 'Withdrawal portal is currently off, try again later',
                'status' => 'info'
            ]);
        }

        if(!isset(Auth::guard('users')->user()->bank)){
            return response()->json([
                'message' => 'Please link your bank account to be able to place withdrawal',
                'status' => 'info'
            ]);
        }

        $bank=json_decode(Auth::guard('users')->user()->bank);
        $tx=false;
        $tx=DB::transaction(function() use($amt,$amount,$fee,$bank){
            // new db
            DB::table('users')->where('id',Auth::guard('users')->user()->id)->decrement('main_balance',$amount,[
                'updated' => Carbon::now()
            ]);
            // new db
        DB::table('transactions')->insert([
    'uniqid' => GenerateID(),
    'user_id' => Auth::guard('users')->user()->id,
    'title' => 'Withdrawal from main wallet',
    'class' => 'debit',
    'type' => 'withdrawal',
    'amount' => $amt,
    'fee' => $fee,
    'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M1 14.5C1 12.1716 2.22429 10.1291 4.06426 8.9812C4.56469 5.044 7.92686 2 12 2C16.0731 2 19.4353 5.044 19.9357 8.9812C21.7757 10.1291 23 12.1716 23 14.5C23 17.9216 20.3562 20.7257 17 20.9811L7 21C3.64378 20.7257 1 17.9216 1 14.5ZM16.8483 18.9868C19.1817 18.8093 21 16.8561 21 14.5C21 12.927 20.1884 11.4962 18.8771 10.6781L18.0714 10.1754L17.9517 9.23338C17.5735 6.25803 15.0288 4 12 4C8.97116 4 6.42647 6.25803 6.0483 9.23338L5.92856 10.1754L5.12288 10.6781C3.81156 11.4962 3 12.927 3 14.5C3 16.8561 4.81833 18.8093 7.1517 18.9868L7.325 19H16.675L16.8483 18.9868ZM13 13V17H11V13H8L12 8L16 13H13Z"></path></svg>',

    'wallet' => json_encode([
        'from' => 'main_balance',
        'to' => [
            'method' => 'bank',
            'account_number' => $bank->account_number,
            'bank_name' => $bank->bank_name,
            'account_name' => ucwords($bank->account_name)
        ],

    ]),
    'data' => json_encode([
        'Withdrawal method' => 'Bank Withdrawal',
        'Account number' => $bank->account_number,
        'Bank name' => $bank->bank_name,
        'Account name' => ucwords($bank->account_name)
    ]),
    'json' => json_encode([
    'balance' => [
        'before' => Auth::guard('users')->user()->main_balance,
        'after' => Auth::guard('users')->user()->main_balance - $amount
    ],
    'primary_wallet' => 'Main Wallet'

    ]),
    'status' => 'pending',
    'updated' => Carbon::now(),
    'date' => Carbon::now()
    ]);

    return true;
        });

        if($tx){
            return response()->json([
                'message' => 'Withdrawal placed successfully, awaiting processing',
                'status' => 'success'
            ]);
        }
    



        return response()->json([
            'message' => 'Internal server error, please try again',
            'status' => 'error'
        ]);
        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    // update password
    public function UpdatePassword(){
        if(!Hash::check(request('current'),Auth::guard('users')->user()->password)){
            return response()->json([
                'message' => 'Invalid current password',
                'status' => 'warning'
            ]);
        }

        if(!Hash::check(request('confirm'),Hash::make(request('new')))){
            return response()->json([
                'message' => 'New password and confirm password must be the same',
                'status' => 'error'
            ]);
        }

        DB::table('users')->where('id',Auth::guard('users')->user()->id)->update([
            'password' => Hash::make(request('new')),
            'updated' => Carbon::now()
        ]);

        return response()->json([
            'message' => 'Account password updated successfully',
            'status' => 'success'
        ]);
    }

    // redeem gift code
    public function RedeemGiftCode(){
       try{
         $code=request('code');
        $giftcode=DB::table('giftcodes')->where('code',$code);
        
        if(!$giftcode->exists()){
            return response()->json([
                'message' => 'Invalid gift code',
                'status' => 'error'
            ]);
        }

        $giftcode=$giftcode->first();
        if($giftcode->invest_before_redeeming == 'yes' && !DB::table('purchased_packages')->where('user_id',Auth::guard('users')->user()->id)->where('cycle','>','0')->where('status','active')->exists()){
             return response()->json([
                'message' => 'You must invest before redeeming this gift code',
                'status' => 'error'
            ]);
        }

        if($giftcode->redeemed >= $giftcode->limit){
            return response()->json([
                'message' => 'Gift Code has been fully redeemed by other users',
                'status' => 'info'
            ]);
        }


        if(DB::table('redeemed_giftcodes')->where('user_id',Auth::guard('users')->user()->id)->where('giftcode->code',$code)->exists()){
            return response()->json([
                'message' => 'Gift Code has already been redeemed by you',
                'status' => 'warning'
            ]);
        }

        DB::transaction(function() use($giftcode){
            DB::table('users')->where('id',Auth::guard('users')->user()->id)->increment('main_balance',$giftcode->reward,[
                'updated' => carbon::now()
            ]);
            DB::table('giftcodes')->where('code',$giftcode->code)->increment('redeemed',1);
            DB::table('redeemed_giftcodes')->insert([
                'user_id' => Auth::guard('users')->user()->id,
                'giftcode' => json_encode($giftcode),
                'status' => 'success',
                'updated' => Carbon::now(),
                'date' => carbon::now()
            ]);

             DB::table('transactions')->insert([
    'uniqid' => GenerateID(),
    'user_id' => Auth::guard('users')->user()->id,
    'title' => 'Gift Code',
    'class' => 'credit',
    'type' => 'giftcode',
    'amount' => $giftcode->reward,
    'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15.0049 2.00281C17.214 2.00281 19.0049 3.79367 19.0049 6.00281C19.0049 6.73184 18.8098 7.41532 18.4691 8.00392L23.0049 8.00281V10.0028H21.0049V20.0028C21.0049 20.5551 20.5572 21.0028 20.0049 21.0028H4.00488C3.4526 21.0028 3.00488 20.5551 3.00488 20.0028V10.0028H1.00488V8.00281L5.54065 8.00392C5.19992 7.41532 5.00488 6.73184 5.00488 6.00281C5.00488 3.79367 6.79574 2.00281 9.00488 2.00281C10.2001 2.00281 11.2729 2.52702 12.0058 3.35807C12.7369 2.52702 13.8097 2.00281 15.0049 2.00281ZM11.0049 10.0028H5.00488V19.0028H11.0049V10.0028ZM19.0049 10.0028H13.0049V19.0028H19.0049V10.0028ZM9.00488 4.00281C7.90031 4.00281 7.00488 4.89824 7.00488 6.00281C7.00488 7.05717 7.82076 7.92097 8.85562 7.99732L9.00488 8.00281H11.0049V6.00281C11.0049 5.00116 10.2686 4.1715 9.30766 4.02558L9.15415 4.00829L9.00488 4.00281ZM15.0049 4.00281C13.9505 4.00281 13.0867 4.81869 13.0104 5.85355L13.0049 6.00281V8.00281H15.0049C16.0592 8.00281 16.923 7.18693 16.9994 6.15207L17.0049 6.00281C17.0049 4.89824 16.1095 4.00281 15.0049 4.00281Z"></path></svg>',
    'fee' => 0,
    'wallet' => json_encode([
        'from' => 'admin',
        'to' => 'main_balance',

    ]),
    'data' => json_encode([
        'Gift Code' => $giftcode->code,
        'Position' => ($giftcode->redeemed + 1).' out of '.$giftcode->limit,
        'Reward Method' => 'Instant'
    ]),
     'json' => json_encode([
    'balance' => [
        'before' => 0,
        'after' => 500
    ],
    'primary_wallet' => 'Main Wallet',
    'giftcode_id' => $giftcode->id

    ]),
    'status' => 'success',
    'updated' => Carbon::now(),
    'date' => Carbon::now()
    ]);
        });
        return response()->json([
            'message' => 'Gift code redeemed successfully & balance creditted',
            'status' => 'success'
        ]);
       }catch(\Exception $e){
        return response()->json([
            'message' => $e->getMessage(),
            'status' => 'error'
        ]);
       }
    }

    // generate paga account number
    public function GeneratePagaAccount(){
      try{
          if(isset(Auth::guard('users')->user()->paga_account)){
            return response()->json([
                    'message' => 'Deposit account generated successfully',
                    'status' => 'success'
                ]);
        }
        
            $response=Http::withToken(env('ASPFIY_SECRET_KEY'))->post('https://api-v1.aspfiy.com/reserve-paga/',[
                'email' => trim(request('email')),
                'reference' => GenerateID(),
                'firstName' => trim(request('first_name')),
                'lastName' => trim(request('last_name')),
                'webhookUrl' => url('aspfiy/paga/verify/webhook/process'),
                'phone' => Auth::guard('users')->user()->phone
            ]);
            if($response->successful()){
                $data=$response->json();
               $account_number=$data['data']['account']['account_number'];
               $account_name=$data['data']['account']['account_name'];
               $bank_name=$data['data']['account']['bank_name'];
                DB::transaction(function() use($account_name,$account_number,$bank_name){
                    DB::table('users')->where('id',Auth::guard('users')->user()->id)->update([
                        'paga_account' => json_encode([
                            'account_number' => $account_number,
                            'account_name' => $account_name,
                            'bank_name' => $bank_name
                        ]),
                        'updated' => Carbon::now() 
                    ]);
                });
                return response()->json([
                    'message' => 'Deposit account generated successfully',
                    'status' => 'success'
                ]);
            }

            return response()->json([
            'message' => 'Internal server error,please try again',
            'status' => 'error'
             ]);
      }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
      }
    }

    // aspfiy paga webhook
    public function AspfiyPagaWebhook(){
        try{
            $secret_key=env('ASPFIY_SECRET_KEY');
        $signature=request()->header('x-wiaxy-signature');
        $account_number=request('data.account.account_number');
         $amount=request('data.amount');
        $expected=md5($secret_key);
        if(!$signature || $signature != $expected){
            return response()->json([
                'message' => 'Unauthorised',
                'status' => 'error'
            ],401);
        }

        if(request('event') === 'PAYMENT_NOTIFICATION'){
           
        
       
            DB::transaction(function() use($account_number,$amount){
                DB::table('users')->where('paga_account->account_number',$account_number)->increment('deposit_balance',$amount,[
                    'updated' => Carbon::now()
                ]);
                $user=DB::table('users')->where('paga_account->account_number',$account_number)->first();
                

                    DB::table('transactions')->insert([
                    'uniqid' => GenerateID(),
                    'user_id' => $user->id,
                    'title' => 'Recharge via Paga Account',
                    'class' => 'credit',
                    'type' => 'deposit',
                    'amount' => $amount,
                    'fee' => 0,
                    'icon' => '',
                    'wallet' => json_encode([
                        'from' => [
                        'method' => 'automatic',
                        
                    ],
                    'to' => 'deposit_balance',


                    ]),
                    'data' => json_encode([
                        'Account Type' => 'Paga Account',
                        'Account Number' => json_decode($user->paga_account)->account_number,
                        'Account Name' => json_decode($user->paga_account)->account_name,
                        'Bank Name' => json_decode($user->paga_account)->bank_name,

                    ]),
                    'json' => json_encode([
                    'balance' => [
                    'before' => 0,
                    'after' => 0
                    ],
                    'primary_wallet' => 'Deposit Wallet'

                    ]),
                    
                    'status' => 'success',
                    'updated' => Carbon::now(),
                    'date' => Carbon::now()
                    ]);
            });
        }
        return 'OK';
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}
