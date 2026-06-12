@extends('layout.users.app')
@section('title')
   Invite & Earn
@endsection
@section('css')
    <style class="css">
        main{
            padding:0;
        }
        section.section{
            padding:20px;
            
                    &.title{
                        background:hsl(var(--primary-hsl),70%,50%);
                        padding-bottom:70px;
                        clip-path:ellipse(100% 100% at top center);
                        display:flex;
                        flex-direction:column;
                        gap:20px;

                             
                    }

                    &.body{
                        padding-top:0;

                                > form{
                                    width:100%;
                                    background:var(--bg-light);
                                    padding:20px;
                                    border-radius:10px;
                                    transform:translateY(-50px);

                                    
                                }
                    }
        }


        @media(min-width:800px){
            section.section{
                padding-left:10vw;
                padding-right:10vw;
            }
            
        }

        .copy-btn,.glass-div{
            width:100%;
            padding:10px;
            display:flex;
            flex-direction: row;
            align-items:center;
            justify-content:center;
            gap:10px;
            position:relative;
            height:50px;
            border-radius:1000px;
            background:var(--rgt-001);
            font-weight:600;
            font-size:0.9rem;
            user-select:none;
            -webkit-user-select:none;
            cursor:pointer;
            --padding:1px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            
        }

        .copy-btn::before,.glass-div::before{
            content:'';
            position:absolute;
            inset:0;
            background:linear-gradient(to bottom right,var(--rgt-05),transparent,var(--rgt-05));
            mask:linear-gradient(white 0,white 0) content-box,linear-gradient(white 0, white 0);
            -webkit-mask:linear-gradient(white 0,white 0) content-box,linear-gradient(white 0, white 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            padding:var(--padding);
            border-radius:inherit;
        }
    </style>
@endsection
@section('main')
     <section class="w-full column">
        <section class="section title">
            <div class="row w-full g-10 align-center space-between">
               <i onclick="Redirect('{{ url()->previous() }}')" class="row back-icon pointer align-center h-fit">

                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z"></path></svg>
                </i>
                <span class="font-weight-700 block font-1">Invite & Earn</span>
               <span></span>
            </div>
         
        </section>
        {{-- new section /body --}}
        <section class="section body">
            <section style="transform:translateY(-50px);padding-top:0;" class="bg-light text-center align-center br-10 max-w-500 m-x-auto column g-10">
            <img class="no-pointer no-select" style="transform:translateY(-50%) translateX(20%);margin-left:auto;" src="{{ asset('banners/IMG_7876.png') }}" width="50px" alt="">
               <div style="transform: translateY(-25px)" class="column g-10 w-full p-x-20">
                 <strong class="desc font-weight-900">
                Invite & Earn
             </strong>
             <span class="opacity-08">
                Share your unique referral link to friends & families, earn commissions straight into your wallet(withdrawable anytime) whenever they register and purchase a product through your link.
             </span>
            
               <div onclick="this.classList.add('animate__animated','animate__rubberBand');this.addEventListener('animationend',()=>{this.classList.remove('animate__animated','animate__rubberBand')});copy('{{ url('users/register?ref='.Auth::guard('users')->user()->uniqid.'') }}')" class="copy-btn">
                <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.0607 8.11097L14.4749 9.52518C17.2086 12.2589 17.2086 16.691 14.4749 19.4247L14.1214 19.7782C11.3877 22.5119 6.95555 22.5119 4.22188 19.7782C1.48821 17.0446 1.48821 12.6124 4.22188 9.87874L5.6361 11.293C3.68348 13.2456 3.68348 16.4114 5.6361 18.364C7.58872 20.3166 10.7545 20.3166 12.7072 18.364L13.0607 18.0105C15.0133 16.0578 15.0133 12.892 13.0607 10.9394L11.6465 9.52518L13.0607 8.11097ZM19.7782 14.1214L18.364 12.7072C20.3166 10.7545 20.3166 7.58872 18.364 5.6361C16.4114 3.68348 13.2456 3.68348 11.293 5.6361L10.9394 5.98965C8.98678 7.94227 8.98678 11.1081 10.9394 13.0607L12.3536 14.4749L10.9394 15.8891L9.52518 14.4749C6.79151 11.7413 6.79151 7.30911 9.52518 4.57544L9.87874 4.22188C12.6124 1.48821 17.0446 1.48821 19.7782 4.22188C22.5119 6.95555 22.5119 11.3877 19.7782 14.1214Z"></path></svg>
               Copy Link
               </div>
               </div>
            </section>
        
            {{-- content body --}}
            <section style="padding:0;transform:translateY(-35px)" class="body column g-15 section">
                <div class="bg-light br-10 w-full column g-10 p-20">
                   {{-- new row --}}
                    <div style="border-bottom:1px dashed var(--rgt-01);padding-bottom:10px;" class="row w-full g-10 align-center">
                       <i class="c-gold block h-fit">
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.5759 17.2714L8.46576 14.484C7.83312 15.112 6.96187 15.5 6 15.5C4.067 15.5 2.5 13.933 2.5 12C2.5 10.067 4.067 8.5 6 8.5C6.96181 8.5 7.83301 8.88796 8.46564 9.51593L13.5759 6.72855C13.5262 6.49354 13.5 6.24983 13.5 6C13.5 4.067 15.067 2.5 17 2.5C18.933 2.5 20.5 4.067 20.5 6C20.5 7.933 18.933 9.5 17 9.5C16.0381 9.5 15.1669 9.11201 14.5343 8.48399L9.42404 11.2713C9.47382 11.5064 9.5 11.7501 9.5 12C9.5 12.2498 9.47383 12.4935 9.42408 12.7285L14.5343 15.516C15.167 14.888 16.0382 14.5 17 14.5C18.933 14.5 20.5 16.067 20.5 18C20.5 19.933 18.933 21.5 17 21.5C15.067 21.5 13.5 19.933 13.5 18C13.5 17.7502 13.5262 17.5064 13.5759 17.2714Z"></path></svg>

                       </i>
                        <strong class="font-size-09">Your Referral Code</strong>
                    </div>
                    {{-- new row --}}
                    <div style="height:auto;border-radius:10px;font-size:1rem;min-height:50px;font-weight:900;" class="glass-div">{{ Auth::guard('users')->user()->uniqid }}</div>
                {{-- new row --}}
                <div class="row w-full align-center g-10">
                    {{-- new btn --}}
                    <div onclick="copy('{{ Auth::guard('users')->user()->uniqid }}')" style="border:1px solid var(--primary-light);color:var(--primary-light);font-weight:700;" class="h-50 w-full br-5 row g-10 no-select pointer align-center justify-center p-10">
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M2 4H4V20H2V4ZM6 4H7V20H6V4ZM8 4H10V20H8V4ZM11 4H13V20H11V4ZM14 4H16V20H14V4ZM17 4H18V20H17V4ZM19 4H22V20H19V4Z"></path></svg>

                        <span>Copy Code</span>
                    </div>
                     {{-- new btn --}}
                    <div onclick="copy('{{ url('users/register?ref='.Auth::guard('users')->user()->uniqid.'') }}')" style="background:linear-gradient(to right,var(--primary-light),var(--primary));color:var(--primary-text);font-weight:700;" class="h-50 no-select pointer w-full br-5 row g-10 align-center justify-center p-10">
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.0607 8.11097L14.4749 9.52518C17.2086 12.2589 17.2086 16.691 14.4749 19.4247L14.1214 19.7782C11.3877 22.5119 6.95555 22.5119 4.22188 19.7782C1.48821 17.0446 1.48821 12.6124 4.22188 9.87874L5.6361 11.293C3.68348 13.2456 3.68348 16.4114 5.6361 18.364C7.58872 20.3166 10.7545 20.3166 12.7072 18.364L13.0607 18.0105C15.0133 16.0578 15.0133 12.892 13.0607 10.9394L11.6465 9.52518L13.0607 8.11097ZM19.7782 14.1214L18.364 12.7072C20.3166 10.7545 20.3166 7.58872 18.364 5.6361C16.4114 3.68348 13.2456 3.68348 11.293 5.6361L10.9394 5.98965C8.98678 7.94227 8.98678 11.1081 10.9394 13.0607L12.3536 14.4749L10.9394 15.8891L9.52518 14.4749C6.79151 11.7413 6.79151 7.30911 9.52518 4.57544L9.87874 4.22188C12.6124 1.48821 17.0446 1.48821 19.7782 4.22188C22.5119 6.95555 22.5119 11.3877 19.7782 14.1214Z"></path></svg>
                       
                        <span>Copy Link</span>
                    </div>
                </div>
                </div>
                {{-- new --}}
                 <div class="bg-light br-10 w-full column g-10 p-15">
                    <div class="row w-full space-between align-center g-10">
                        <i class="c-gold row h-fit">
                            <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M20.0049 13.0028V20.0028C20.0049 20.5551 19.5572 21.0028 19.0049 21.0028H5.00488C4.4526 21.0028 4.00488 20.5551 4.00488 20.0028V13.0028H20.0049ZM14.5049 2.00281C16.4379 2.00281 18.0049 3.56981 18.0049 5.50281C18.0049 6.04001 17.8839 6.54895 17.6676 7.00385L21.0049 7.00281C21.5572 7.00281 22.0049 7.45052 22.0049 8.00281V11.0028C22.0049 11.5551 21.5572 12.0028 21.0049 12.0028H3.00488C2.4526 12.0028 2.00488 11.5551 2.00488 11.0028V8.00281C2.00488 7.45052 2.4526 7.00281 3.00488 7.00281L6.34219 7.00385C6.12591 6.54895 6.00488 6.04001 6.00488 5.50281C6.00488 3.56981 7.57189 2.00281 9.50488 2.00281C10.4849 2.00281 11.3708 2.40557 12.0061 3.05459C12.639 2.40557 13.5249 2.00281 14.5049 2.00281ZM9.50488 4.00281C8.67646 4.00281 8.00488 4.67438 8.00488 5.50281C8.00488 6.2825 8.59977 6.92326 9.36042 6.99594L9.50488 7.00281H11.0049V5.50281C11.0049 4.72311 10.41 4.08236 9.64934 4.00967L9.50488 4.00281ZM14.5049 4.00281L14.3604 4.00967C13.6473 4.07782 13.0799 4.64524 13.0117 5.35835L13.0049 5.50281V7.00281H14.5049L14.6493 6.99594C15.41 6.92326 16.0049 6.2825 16.0049 5.50281C16.0049 4.72311 15.41 4.08236 14.6493 4.00967L14.5049 4.00281Z"></path></svg>

                        </i>
                        <strong class="font-size-1 block m-right-auto font-weight-900">My Referrals</strong>
                         <i onclick="Redirect('{{ url('users/referrals') }}')" style="height:30px;width:30px;" class="back-icon">
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                    </div>
                   
                 </div>

                 <div class="bg-light br-10 w-full column g-10 p-20">
                   {{-- new row --}}
                    <div style="border-bottom:1px dashed var(--rgt-01);padding-bottom:10px;" class="row w-full g-10 align-center">
                       <i class="c-primary-light block h-fit">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM7 13V17H9V13H7ZM11 7V17H13V7H11ZM15 10V17H17V10H15Z"></path></svg>
                       </i>
                        <strong class="font-size-09">Reward Levels</strong>
                    </div>
                   <div style="border:1px solid var(--primary-01)" class="w-full column br-5">
                    <div  class="row w-full p-15 align-center g-10 space-between">
                        <strong class="font-size-1">LV-1</strong>
                        <span class="font-size-1">{{ number_format($referral_settings->level_1) }}%</span>
                    </div>
                     <div style="background:var(--primary-01)" class="row w-full p-15 align-center g-10 space-between">
                        <strong class="font-size-1">LV-2</strong>
                        <span class="font-size-1">{{ number_format($referral_settings->level_2) }}%</span>
                    </div>
                     <div class="row w-full p-15 align-center g-10 space-between">
                        <strong class="font-size-1">LV-3</strong>
                        <span class="font-size-1">{{ number_format($referral_settings->level_3) }}%</span>
                    </div>
                   </div>
                   
                </div>
            </section>

            
        </section>
    </section>

    
@endsection
@section('js')
    <script class="js">
     
    </script>
@endsection