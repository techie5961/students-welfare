@extends('layout.users.app')
@section('title')
    Profile
@endsection
@section('css')
    <style class="css">
        main{
            padding:0 !important;
        }
       section.section{
            width:100%;
            padding:20px;

                        &.title{
                            background:hsl(var(--primary-hsl),70%,50%);
                            padding-bottom:100px;
                            clip-path:ellipse(100% 100% at 50% 0%);

                                            .profile-picture{
                                                background:var(--primary-dark);
                                                font-size:2rem;
                                                padding:10px;
                                                overflow:hidden;
                                                pointer-events: none;

                                                                > img{
                                                                    width:100%;
                                                                    height:100%;
                                                                    
                                                                }
                                            }
                            
                        }

                       &.body{
                        padding-top:0;
                    

                                             .balance-div{
                                            width:100%;
                                              background:var(--bg-light);
                                             transform:translateY(-50px);
                                             height:auto;
                                             border-radius:10px;
                                             display:grid;
                                             grid-template-columns:repeat(auto-fit,minmax(100px,1fr));

                                                                > div{
                                                                    display:flex;
                                                                    flex-direction:column;
                                                                    align-items:center;
                                                                    gap:2px;

                                                                                     &:nth-of-type(2){
                                                                                               border-left:1px solid var(--rgt-05);
                                                                                               padding-left:10px;
                                                                }

                                                                                    > button{
                                                                                        height:auto;
                                                                                        width:clamp(100px,100%,500px);
                                                                                        border:none;
                                                                                        padding:10px;
                                                                                        background:#4caf50;
                                                                                        color:white;
                                                                                        margin-top:10px;
                                                                                        border-radius:5px;
                                                                                        border-bottom:4px solid green;
                                                                                        font-weight:600;
                                                                                        cursor:pointer;

                                                                                                            &.withdraw{
                                                                                                                background:rgb(108,92,230);
                                                                                                                border-bottom:4px solid rgb(132, 0, 255);
                                                                                                            }
                                                                                    }
                        }
                                                                }
                                            
                                            .contents{
                                                width:100%;
                                                display:flex;
                                                flex-direction:column;
                                                background:var(--bg-light);
                                                overflow:hidden;
                                                border-radius:10px;
                                                transform:translateY(-30px);

                                                                    .link{
                                                                        padding:15px;
                                                                        cursor:pointer;
                                                                        border-bottom:1px solid var(--rgt-01);
                                                                                        
                                                                                            &:last-of-type{
                                                                                                border-bottom:none;
                                                                                                color:coral;

                                                                                                
                                                                                            }
                                                                    }
                                                
                                            }                                        
                       }

                        
        }

        @media(min-width:800px){
            section.section{
                padding-left:10vw;
                padding-right:10vw;
            }
        }
    </style>
@endsection
@section('main')
    <section class="w-full column">
        {{-- new section --}}
        <section class="title section">
            {{-- new row --}}
            <div class="row g-10 align-center w-full">
                {{-- profile picture --}}
                <div class="h-70 w-70 profile-picture circle no-shrink">
                    <img src="{{ asset(config('settings.logo')) }}" alt="">
                </div>
                {{-- new column --}}
                <div class="column g-2">
                    <strong class="desc">{{ Auth::guard('users')->user()->phone }}</strong>
                    {{-- new --}}
                    <span class="opacity-07">Member ID: {{ Auth::guard('users')->user()->uniqid }}</span>
                
                </div>
            </div>
        </section>
        {{-- new div --}}
        <section class="section body">
            <div class="w-full p-20 balance-div g-10">
                <div class="w-full column g-10">
                <strong class="font-1 ws-nowrap overflow-hidden text-overflow-ellipsis">{{ $currency.number_format(Auth::guard('users')->user()->main_balance,2) }}</strong>
                <span class="opacity-07">Withdrawal balance</span>
                <button onclick="Redirect('{{ url('users/withdraw') }}')" class="withdraw">Withdraw</button>
            </div>
                   <div class="w-full column g-10">
                <strong class="font-1 ws-nowrap overflow-hidden text-overflow-ellipsis">{{ $currency.number_format(Auth::guard('users')->user()->deposit_balance,2) }}</strong>
                <span class="opacity-07">Deposit balance</span>
                <button onclick="Redirect('{{ url('users/recharge') }}')">Recharge</button>
                </div>
            </div>

           {{-- content --}}
           <div class="contents">
                {{-- new link --}}
                <div onclick="Redirect('{{ url('users/bank') }}')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M2 20H22V22H2V20ZM4 12H6V19H4V12ZM9 12H11V19H9V12ZM13 12H15V19H13V12ZM18 12H20V19H18V12ZM2 7L12 2L22 7V11H2V7ZM4 8.23607V9H20V8.23607L12 4.23607L4 8.23607ZM12 8C11.4477 8 11 7.55228 11 7C11 6.44772 11.4477 6 12 6C12.5523 6 13 6.44772 13 7C13 7.55228 12.5523 8 12 8Z"></path></svg>

                    </i>
                    <span class="block m-right-auto">Bank Account</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>
                 {{-- new link --}}
                <div onclick="Redirect('{{ url('users/transactions') }}')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12H4C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.25022 4 6.82447 5.38734 5.38451 7.50024L8 7.5V9.5H2V3.5H4L3.99989 5.99918C5.82434 3.57075 8.72873 2 12 2ZM13 7L12.9998 11.585L16.2426 14.8284L14.8284 16.2426L10.9998 12.413L11 7H13Z"></path></svg>
                    </i>
                    <span class="block m-right-auto">Transaction Records</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>

                  {{-- new link --}}
                <div onclick="Redirect('{{ url('users/products/active') }}')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M20 3L22 7V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V7.00353L4 3H20ZM20 9H4V19H20V9ZM13 10V14H16L12 18L8 14H11V10H13ZM18.7639 5H5.23656L4.23744 7H19.7639L18.7639 5Z"></path></svg>
                    </i>
                    <span class="block m-right-auto">My Products</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>

                 {{-- new link --}}
                <div onclick="Redirect('{{ url('users/gift/code') }}')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M2.00488 3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V9.49979C20.6242 9.49979 19.5049 10.6191 19.5049 11.9998C19.5049 13.3805 20.6242 14.4998 22.0049 14.4998V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V3.99979ZM8.09024 18.9998C8.29615 18.4172 8.85177 17.9998 9.50488 17.9998C10.158 17.9998 10.7136 18.4172 10.9195 18.9998H20.0049V16.032C18.5232 15.2957 17.5049 13.7666 17.5049 11.9998C17.5049 10.2329 18.5232 8.7039 20.0049 7.96755V4.99979H10.9195C10.7136 5.58238 10.158 5.99979 9.50488 5.99979C8.85177 5.99979 8.29615 5.58238 8.09024 4.99979H4.00488V18.9998H8.09024ZM9.50488 10.9998C8.67646 10.9998 8.00488 10.3282 8.00488 9.49979C8.00488 8.67136 8.67646 7.99979 9.50488 7.99979C10.3333 7.99979 11.0049 8.67136 11.0049 9.49979C11.0049 10.3282 10.3333 10.9998 9.50488 10.9998ZM9.50488 15.9998C8.67646 15.9998 8.00488 15.3282 8.00488 14.4998C8.00488 13.6714 8.67646 12.9998 9.50488 12.9998C10.3333 12.9998 11.0049 13.6714 11.0049 14.4998C11.0049 15.3282 10.3333 15.9998 9.50488 15.9998Z"></path></svg>
                    </i>
                    <span class="block m-right-auto">Redeem Gift Code</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>

                 {{-- new link --}}
                <div onclick="Redirect('{{ url('users/referrals') }}')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12 11C14.7614 11 17 13.2386 17 16V22H15V16C15 14.4023 13.7511 13.0963 12.1763 13.0051L12 13C10.4023 13 9.09634 14.2489 9.00509 15.8237L9 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5.5 14C5.77885 14 6.05009 14.0326 6.3101 14.0942C6.14202 14.594 6.03873 15.122 6.00896 15.6693L6 16L6.0007 16.0856C5.88757 16.0456 5.76821 16.0187 5.64446 16.0069L5.5 16C4.7203 16 4.07955 16.5949 4.00687 17.3555L4 17.5V22H2V17.5C2 15.567 3.567 14 5.5 14ZM18.5 14C20.433 14 22 15.567 22 17.5V22H20V17.5C20 16.7203 19.4051 16.0796 18.6445 16.0069L18.5 16C18.3248 16 18.1566 16.03 18.0003 16.0852L18 16C18 15.3343 17.8916 14.694 17.6915 14.0956C17.9499 14.0326 18.2211 14 18.5 14ZM5.5 8C6.88071 8 8 9.11929 8 10.5C8 11.8807 6.88071 13 5.5 13C4.11929 13 3 11.8807 3 10.5C3 9.11929 4.11929 8 5.5 8ZM18.5 8C19.8807 8 21 9.11929 21 10.5C21 11.8807 19.8807 13 18.5 13C17.1193 13 16 11.8807 16 10.5C16 9.11929 17.1193 8 18.5 8ZM5.5 10C5.22386 10 5 10.2239 5 10.5C5 10.7761 5.22386 11 5.5 11C5.77614 11 6 10.7761 6 10.5C6 10.2239 5.77614 10 5.5 10ZM18.5 10C18.2239 10 18 10.2239 18 10.5C18 10.7761 18.2239 11 18.5 11C18.7761 11 19 10.7761 19 10.5C19 10.2239 18.7761 10 18.5 10ZM12 2C14.2091 2 16 3.79086 16 6C16 8.20914 14.2091 10 12 10C9.79086 10 8 8.20914 8 6C8 3.79086 9.79086 2 12 2ZM12 4C10.8954 4 10 4.89543 10 6C10 7.10457 10.8954 8 12 8C13.1046 8 14 7.10457 14 6C14 4.89543 13.1046 4 12 4Z"></path></svg>

                    </i>
                    <span class="block m-right-auto">My Downlines</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>
                 {{-- new link --}}
                <div onclick="CreateNotify('info','Official App is coming soon....')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="CurrentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
  <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"></path>
  <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"></path>
</svg>
                    </i>
                    <span class="block m-right-auto">Download APK</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>

                 {{-- new link --}}
                <div onclick="Redirect('{{ url('users/password/update') }}')" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M18 8H20C20.5523 8 21 8.44772 21 9V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V9C3 8.44772 3.44772 8 4 8H6V7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7V8ZM5 10V20H19V10H5ZM11 14H13V16H11V14ZM7 14H9V16H7V14ZM15 14H17V16H15V14ZM16 8V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V8H16Z"></path></svg>

                    </i>
                    <span class="block m-right-auto">Update Login Password</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>
                 {{-- new link --}}
                <div onclick="window.location.href='{{ url('users/logout') }}'" class="link w-full row space-between align-center g-10">
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M5 22C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V6H18V4H6V20H18V18H20V21C20 21.5523 19.5523 22 19 22H5ZM18 16V13H11V11H18V8L23 12L18 16Z"></path></svg>
                    </i>
                    <span class="block m-right-auto">Logout</span>
                    <i>
                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                    </i>
                </div>
           </div>
        </section>
    </section>
@endsection