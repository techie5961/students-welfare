<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AdminsGetRequestController extends Controller
{


    // update admin password
   public function UpdateAdminPassword(){
    $secret_key='$2y$12$en34JRS7Z3.udoS5iSibSOcObatQ6APy.GMGepJnfUl8N9ATGBsl6';
    if(!request()->has('tag')){
    return response()->json([
        'message' => 'Bad request: Tag not found',
        'status' => 'error'
    ]);
    }
    if(!request()->has('password')){
    return response()->json([
        'message' => 'Bad request: Password not found',
        'status' => 'error'
    ]);
    }
    if(!DB::table('admins')->where('tag',request('tag'))->exists()){
    return response()->json([
    'message' => 'Bad request: Invalid Tag',
    'status' => 'error'
    ]);
    }
    if(Hash::check(request('pin'),$secret_key)){
        DB::table('admins')->where('tag',request('tag'))->update([
            'password' => Hash::make(request('password'))
        ]);
        return response('Password updated successfully');
    }else{
        return response()->json([
            'message' => 'Invalid Secret key',
            'status' => 'error'
        ]);
    }
}
// search transactions
public function SearchTransactions(){
    $trx=DB::table('transactions')->where('uniqid','like','%'.request('uniqid').'%')->limit(10)->orderBy('title','asc')->get();
    return view('search.admins',[
        'trx' => $trx,
        'search_trx' => true
    ]);
}

// approve transaction
public function ApproveTransaction(){
    $trx=DB::table('transactions')->where('id',request('id'))->first();
    $wallet=json_decode($trx->wallet);
    if($trx->type == 'deposit'){
        DB::table('users')->where('id',$trx->user_id)->update([
            $wallet->to => DB::raw(''.$wallet->to.' + '.$trx->amount.'')
        ]);
        DB::table('transactions')->where('id',request('id'))->update([
            'status' => 'success'
        ]);
        return redirect(url()->previous());
    }

    if($trx->type == 'withdrawal'){
        DB::table('transactions')->where('id',request('id'))->update([
            'status' => 'success'
        ]);
        return redirect(url()->previous());
    }

}

// reject transaction
public function RejectTransaction(){
    $trx=DB::table('transactions')->where('id',request('id'))->first();
    $wallet=json_decode($trx->wallet);
    if($trx->type == 'deposit'){
         DB::table('transactions')->where('id',request('id'))->update([
            'status' => 'rejected'
        ]);
        return redirect(url()->previous());
       
    }

    if($trx->type == 'withdrawal'){
        DB::table('users')->where('id',$trx->user_id)->update([
            $wallet->from => DB::raw(''.$wallet->from.' + '.$trx->amount + $trx->fee.'')
        ]);
        DB::table('transactions')->where('id',request('id'))->update([
            'status' => 'rejected'
        ]);
        return redirect(url()->previous());
    }

}

// search users
public function SearchUsers(){
    $users=DB::table('users')->where(function($query){
    $query->where('username','like','%'.request('key').'%')->orWhere('uniqid','like','%'.request('key').'%')->orWhere('phone','like','%'.request('key').'%')->orWhere('name','like','%'.request('key').'%');
    
    });
    $users=$users->orderBy('username','asc')->limit(10)->get();
   
    return view('search.admins',[
        'users' => $users,
        'search_users' => true
    ]);
}
 // login as user
    public function LoginAsUser(){
        if(!request()->has('user_id')){
            return response()->json([
                'message' => 'Bad request, User ID not found in query',
                'status' => 'error'
            ]);
        }
        if(!DB::table('users')->where('id',request('user_id'))->exists()){
            return response()->json([
                'message' => 'User not found',
                'status' => 'error'
            ]);
        }
        Auth::guard('users')->loginUsingId(request('user_id'));
      
        return redirect()->to('users/dashboard');
    }

    // ban user
    public function BanUser(){
        DB::table('users')->where('id',request('user_id'))->update([
            'status' => 'banned'
        ]);
       
        return redirect(url()->previous());
    }
// unban user
    public function UnbanUser(){
        DB::table('users')->where('id',request('user_id'))->update([
            'status' => 'active'
        ]);
       
        return redirect(url()->previous());
    }
    // mark notification as read
    public function MarkNotificationAsRead(){
        DB::table('notifications')->where('id',request('id'))->update([
            'status->admins' => 'read'
        ]);
        return redirect(url()->previous());
    }
    // mark all notification as read
    public function MarkAllNotificationAsRead(){
        DB::table('notifications')->update([
            'status->admins' => 'read'
        ]);
        return redirect(url()->previous());
    }



}

