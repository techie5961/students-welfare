<!DOCTYPE html>
<html lang="en">
<head>
    {{-- include meta tags --}}
   @include('components.utilities',[
    'meta_tags' => true
   ])
{{-- include favicon --}}
@include('components.utilities',[
    'favicon' => true
])
{{-- include vite css --}}
@include('components.utilities',[
    'vite_css' => true
])
{{-- include admin changed vars --}}
@include('components.sections.admins',[
    'css_var' => true
])
{{-- yield css --}}
     @yield('css')

    <title>{{ config('app.name') }} || Admins || @yield('title') </title>

    <style>
        
        /* body */
        body:has(nav.active){
            overflow:hidden !important;
           
        }
        /* header */
        header{
            position: fixed;
            top:0;
            left:0;
            right:0;
            padding:20px;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:space-between;
            gap:10px;
            background:var(--bg-light);
            border-bottom:1px solid var(--rgt-01);
            user-select:none;
            z-index:2000;

        }
        main{
            overflow:auto;
            scrollbar-width: none;
            -webkit-scrollbar-width:none;
           

        }
        /* menu icon */
        .menu-icon{
            width:40px;
            aspect-ratio:1;
          
            color:var(--primary);
            border-radius:10px;
            display:flex;
            flex-direction: column;
            align-items:center;
            justify-content:center;


        }
        /* nav */
        nav{
            position:fixed;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background:rgba(0,0,0,0.1);
            z-index:3000;
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(10px);
            user-select:none;
            display:none;

        }
        nav .child{
            width:70%;
            background:var(--bg-light);
            height:100%;
            border-right: 1px solid var(--rgt-01);
            display:flex;
            transform:translateX(-100%);
            transition:all 0.5s linear;
            gap:30px;
            flex-direction:column;
            overflow:auto;
            font-size:0.8rem;

        }
        .nav-child-header{
            position:sticky;
            top:0;
            left:0;
            right:0;
            background:inherit;
            border-bottom:1px solid var(--rgt-01)
        }
        nav.active{
            display:flex;
        }
        nav.active .child{
            animation:animate-trans 0.5s linear forwards;

        }
        @keyframes animate-trans{
            0%{
                transform:translateX(-100%);
            }
            100%{
                transform:translateX(0)
            }
        }
        
        .expandible-nav{
            width:100%;
            display:flex;
            flex-direction:column;
            gap:10px;
            
        }
        .expandible-body{
            width:calc(100% - 30px);
            display:none;
            flex-direction:column;
            gap:5px;
            margin-left:30px;
            background:var(--rgt-005);
            border:1px solid var(--rgt-01);
            border-radius:5px;
            padding:10px;

        }
        .expandible-header:hover{
            background:var(--rgt-005);

        }
        .expandible-header{
            padding:5px;
            border-radius:5px;
        }
        .expandible-body a{
            text-decoration:none;
            color:var(--primary);
            padding:5px;
        }
        .expandible-body a:hover{
            background:var(--bg-light);
            border-radius:5px;
        }
        .nav-a{
            padding:5px;
            border-radius:5px;
        }
        .nav-a:hover{
            background:var(--rgt-005);
        }
        .expandible-nav.active .expandible-body{
            display:flex;
        }
        .expandible-header .chevron svg{
            transition:all 0.2s linear;
            height:15px;
            width:15px;
        }
        .expandible-nav.active .expandible-header .chevron svg{
            transform:rotate(45deg);
        }
        /* footer */
        footer{
            background:var(--primary);
            padding:20px;
            color:var(--primary-text);
            display:flex;
            flex-direction:column;
            gap:5px;
            text-align:center;
            user-select:none;
            position:none;

        }
        /* search */
        .search{
            position:relative;
        }
        .search .child{
            position:absolute;
            left:0;
            right:0;
            top:100%;
            padding:20px;
            border:1px solid var(--rgt-01);
            background:inherit;
            border-radius:5px;
            display:none;
            flex-direction:column;
            gap:5px;
            z-index:500;
            overflow:hidden;
        }
        .search .child a{
            width:100%;
            display:flex;
            flex-direction: row;
            align-items:center;
            color:var(--rgt-07);
            text-decoration:none;
           cursor:pointer;
           overflow:hidden;
           border-radius:10px;
           clip-path:inset(0 round 10px);
           user-select: none;
           padding:5px 10px;
          
           
        }
        .search.active .child{
            display:flex;
        }

        
       

        /* media queries */
        @media(min-width:800px){
            /* header */
            header{
                padding-left:calc(30% + 20px);
            }
            .menu-icon{
                display:none;
            }
            /* nav */
            nav{
                display:flex;
                width:30%;
            }
            nav .child{
                transform:none;
                width:100%;

            }
            main{
                width:calc(100% - 30%);
               margin-left:30%;
               
             
               
            }
            .nav-close{
                display:none;
            }
            /* footer */
            footer{
                text-align:start;
                align-items:start;
                width:calc(100% - 30%);
                margin-left:30%;

            }

        
        }
        
    </style>
</head>
<body>
   {{-- include action loader for post requests,get requests and spa loading --}}
    @include('components.utilities',[
        'action_loader' => true
    ])  
{{-- include general codes --}}
    @include('components.utilities',[
        'general_codes' => true
    ])
    {{-- header --}}
    <header>
        {{-- logo --}}
        <div class="row align-center g-10">
            <div class="h-40 br-10 w-40 no-shrink column align-center justify-center p-10 bg-primary primary-text">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M213.85,125.46l-112,120a8,8,0,0,1-13.69-7l14.66-73.33L45.19,143.49a8,8,0,0,1-3-13l112-120a8,8,0,0,1,13.69,7L153.18,90.9l57.63,21.61a8,8,0,0,1,3,12.95Z"></path></svg>

            </div>
            <strong style="font-size:30px" class="c-primary">Lumina</strong>
        </div>
        {{-- notifictions --}}
        <div onclick="window.location.href='{{ url('admins/notifications') }}'" style="background:var(--rgt-01)" class="m-left-auto pc-pointer no-select g-5 align-center jusify-center p-5 row w-fit br-1000">
            <span class="h-fit row">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216Z"></path></svg>

            </span>
            @if (TotalNotifications() > 0)
                  <small class="bg-red bold c-white h-full p-5 p-x-10 br-1000 row">{{ TotalNotifications() }}</small>
    
            @endif
              </div>
        {{-- menu icon --}}
        <div onclick="document.querySelector('nav').classList.toggle('active')" class="menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="30" width="30"><path d="M228,128a12,12,0,0,1-12,12H40a12,12,0,0,1,0-24H216A12,12,0,0,1,228,128ZM40,76H216a12,12,0,0,0,0-24H40a12,12,0,0,0,0,24ZM216,180H40a12,12,0,0,0,0,24H216a12,12,0,0,0,0-24Z"></path></svg>

        </div>
    </header>
    {{-- nav --}}
    <nav onclick="this.classList.remove('active')">
        <div onclick="event.stopPropagation()" class="child">
            {{-- nav child header --}}
            <div class="row nav-child-header p-20 align-center w-full space-between">
                 {{-- logo --}}
        <div class="row align-center g-10">
            <div class="h-40 br-10 w-40 no-shrink column align-center justify-center p-10 bg-primary primary-text">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M213.85,125.46l-112,120a8,8,0,0,1-13.69-7l14.66-73.33L45.19,143.49a8,8,0,0,1-3-13l112-120a8,8,0,0,1,13.69,7L153.18,90.9l57.63,21.61a8,8,0,0,1,3,12.95Z"></path></svg>

            </div>
            <strong style="font-size:30px" class="c-primary">Lumina</strong>
        </div>
        {{-- close --}}
        <span onclick="document.querySelector('nav').classList.remove('active')" class="nav-close" style="font-size:40px;">&times;</span>
            </div>
            {{-- nav child body --}}
            <div class="w-full flex-auto column c-primary p-20 g-10">
                {{-- new nav a --}}
                <a href="{{ url('admins/dashboard') }}" class="row nav-a no-u space-between c-primary align-center g-10">
                    <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M20 20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V11L1 11L11.3273 1.6115C11.7087 1.26475 12.2913 1.26475 12.6727 1.6115L23 11L20 11V20Z"></path></svg>
                    </span>
                    <span class="m-right-auto">Dashboard</span>
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>

                    </span>
                </a>
                {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12 10C14.2091 10 16 8.20914 16 6 16 3.79086 14.2091 2 12 2 9.79086 2 8 3.79086 8 6 8 8.20914 9.79086 10 12 10ZM5.5 13C6.88071 13 8 11.8807 8 10.5 8 9.11929 6.88071 8 5.5 8 4.11929 8 3 9.11929 3 10.5 3 11.8807 4.11929 13 5.5 13ZM21 10.5C21 11.8807 19.8807 13 18.5 13 17.1193 13 16 11.8807 16 10.5 16 9.11929 17.1193 8 18.5 8 19.8807 8 21 9.11929 21 10.5ZM12 11C14.7614 11 17 13.2386 17 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5 15.9999C5 15.307 5.10067 14.6376 5.28818 14.0056L5.11864 14.0204C3.36503 14.2104 2 15.6958 2 17.4999V21.9999H5V15.9999ZM22 21.9999V17.4999C22 15.6378 20.5459 14.1153 18.7118 14.0056 18.8993 14.6376 19 15.307 19 15.9999V21.9999H22Z"></path></svg>



                        </span>
                        <span class="m-right-auto">Users</span>
                        <span class="chevron">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"></path></svg>
                           </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/users') }}">All Users</a>
                        <a href="{{ url('admins/users?status=active') }}">Active Users</a>
                        <a href="{{ url('admins/users?status=banned') }}">Banned Users</a>
                        <a href="{{ url('admins/users?type=promoter') }}">Promoters/Influencers</a>
                    </div>
                </div>
                  {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M5 3C4.5313 3 4.12549 3.32553 4.02381 3.78307L2.02381 12.7831C2.00799 12.8543 2 12.927 2 13V20C2 20.5523 2.44772 21 3 21H21C21.5523 21 22 20.5523 22 20V13C22 12.927 21.992 12.8543 21.9762 12.7831L19.9762 3.78307C19.8745 3.32553 19.4687 3 19 3H5ZM19.7534 12H15C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12H4.24662L5.80217 5H18.1978L19.7534 12Z"></path></svg>



                        </span>
                        <span class="m-right-auto">Packages</span>
                        <span class="chevron">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"></path></svg>
                           </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/packages/add') }}">Add New</a>
                        <a href="{{ url('admins/packages/manage') }}">Manage Packages</a>
                        <a href="{{ url('admins/packages/investment/records') }}">Investment Records</a>
                    </div>
                </div>

                 {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M11.0049 20.9997C11.0049 20.1712 10.3333 19.4997 9.50488 19.4997C8.67646 19.4997 8.00488 20.1712 8.00488 20.9997H3.00488C2.4526 20.9997 2.00488 20.5519 2.00488 19.9997V3.99966C2.00488 3.44738 2.4526 2.99966 3.00488 2.99966H8.00488C8.00488 3.82809 8.67646 4.49966 9.50488 4.49966C10.3333 4.49966 11.0049 3.82809 11.0049 2.99966H21.0049C21.5572 2.99966 22.0049 3.44738 22.0049 3.99966V9.49966C20.6242 9.49966 19.5049 10.619 19.5049 11.9997C19.5049 13.3804 20.6242 14.4997 22.0049 14.4997V19.9997C22.0049 20.5519 21.5572 20.9997 21.0049 20.9997H11.0049ZM9.50488 10.4997C10.3333 10.4997 11.0049 9.82809 11.0049 8.99966C11.0049 8.17124 10.3333 7.49966 9.50488 7.49966C8.67646 7.49966 8.00488 8.17124 8.00488 8.99966C8.00488 9.82809 8.67646 10.4997 9.50488 10.4997ZM9.50488 16.4997C10.3333 16.4997 11.0049 15.8281 11.0049 14.9997C11.0049 14.1712 10.3333 13.4997 9.50488 13.4997C8.67646 13.4997 8.00488 14.1712 8.00488 14.9997C8.00488 15.8281 8.67646 16.4997 9.50488 16.4997Z"></path></svg>



                        </span>
                        <span class="m-right-auto">Gift Codes</span>
                        <span class="chevron">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"></path></svg>
                           </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/gift/code/create') }}">Create Code</a>
                        <a href="{{ url('admins/gift/codes/manage') }}">Manage Gift Codes</a>
                    </div>
                </div>
                 {{-- new nav a --}}
                <a href="{{ url('admins/transactions') }}" class="row nav-a no-u space-between c-primary align-center g-10">
                    <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM8 7V9H16V7H8ZM8 11V13H16V11H8ZM8 15V17H13V15H8Z"></path></svg>
                   </span>
                    <span class="m-right-auto">Transactions</span>
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                       
                    </span>
                </a>
                  {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M22.0049 9.99979V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V9.99979H22.0049ZM22.0049 7.99979H2.00488V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V7.99979ZM15.0049 15.9998V17.9998H19.0049V15.9998H15.0049Z"></path></svg>



                        </span>
                        <span class="m-right-auto">Withdrawals</span>
                        <span class="chevron">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"></path></svg>
                          </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/transactions?type=withdrawal') }}">All Withdrawals</a>
                        <a href="{{ url('admins/transactions?type=withdrawal&status=pending') }}">Pending Withdrawals</a>
                        <a href="{{ url('admins/transactions?type=withdrawal&status=success') }}">Successfull Withdrawals</a>
                        <a href="{{ url('admins/transactions?type=withdrawal&status=rejected') }}">Rejected Withdrawals</a>
                    </div>
                </div>
                  {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M22.0049 10.9998V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V10.9998H22.0049ZM22.0049 6.99979H2.00488V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V6.99979Z"></path></svg>

                        </span>
                        <span class="m-right-auto">Deposits</span>
                        <span class="chevron">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,128a12,12,0,0,1-12,12H140v76a12,12,0,0,1-24,0V140H40a12,12,0,0,1,0-24h76V40a12,12,0,0,1,24,0v76h76A12,12,0,0,1,228,128Z"></path></svg>
                           </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/transactions?type=deposit') }}">All Deposits</a>
                        <a href="{{ url('admins/transactions?type=deposit&status=pending') }}">Pending Deposits</a>
                        <a href="{{ url('admins/transactions?type=deposit&status=success') }}">Successfull Deposits</a>
                        <a href="{{ url('admins/transactions?type=deposit&status=rejected') }}">Rejected Deposits</a>
                    </div>
                </div>
                 {{-- new nav a --}}
                <a href="{{ url('admins/settings') }}" class="row nav-a no-u space-between c-primary align-center g-10">
                    <span>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.95401 2.2106C11.2876 1.93144 12.6807 1.92263 14.0449 2.20785C14.2219 3.3674 14.9048 4.43892 15.9997 5.07103C17.0945 5.70313 18.364 5.75884 19.4566 5.3323C20.3858 6.37118 21.0747 7.58203 21.4997 8.87652C20.5852 9.60958 19.9997 10.736 19.9997 11.9992C19.9997 13.2632 20.5859 14.3902 21.5013 15.1232C21.29 15.7636 21.0104 16.3922 20.6599 16.9992C20.3094 17.6063 19.9049 18.1627 19.4559 18.6659C18.3634 18.2396 17.0943 18.2955 15.9997 18.9274C14.9057 19.559 14.223 20.6294 14.0453 21.7879C12.7118 22.067 11.3187 22.0758 9.95443 21.7906C9.77748 20.6311 9.09451 19.5595 7.99967 18.9274C6.90484 18.2953 5.63539 18.2396 4.54272 18.6662C3.61357 17.6273 2.92466 16.4164 2.49964 15.1219C3.41412 14.3889 3.99968 13.2624 3.99968 11.9992C3.99968 10.7353 3.41344 9.60827 2.49805 8.87524C2.70933 8.23482 2.98894 7.60629 3.33942 6.99923C3.68991 6.39217 4.09443 5.83576 4.54341 5.33257C5.63593 5.75881 6.90507 5.703 7.99967 5.07103C9.09364 4.43942 9.7764 3.3691 9.95401 2.2106ZM11.9997 14.9992C13.6565 14.9992 14.9997 13.6561 14.9997 11.9992C14.9997 10.3424 13.6565 8.99923 11.9997 8.99923C10.3428 8.99923 8.99967 10.3424 8.99967 11.9992C8.99967 13.6561 10.3428 14.9992 11.9997 14.9992Z"></path></svg>
               </span>
                    <span class="m-right-auto">Site Settings</span>
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                       
                    </span>
                </a>





                <div onclick="window.location.href='{{ url('admins/logout') }}'" style="border:1px solid red;color:red;background:rgba(255,0,0,0.1)" class="w-full pointer m-top-auto justify-center br-10 p-10 g-5 align-center row">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40A8,8,0,0,0,176,88v32H112a8,8,0,0,0,0,16h64v32a8,8,0,0,0,13.66,5.66l40-40A8,8,0,0,0,229.66,122.34Z"></path></svg>
                    </span>
                    <span>Sign Out</span>
                </div>





            </div>
        </div>
    </nav>
    {{-- main --}}
    <main>
        {{-- yield main --}}
        @yield('main')
    </main>
    <footer>
        <span>{{ config('app.name') }} Admin Dashboard <br> &copy;{{ date('Y') }} powered by Lumina Admin</span>
        <span>Coding and design by <a style="color:aqua" href="https://wa.me/+2349013350351">Techie Innovations</a></span>

    </footer>
  @include('components.utilities',[
    'vite_js' => true
  ])
  <script>
    function spa(url){
        // alert(url)
        window.location.href=url;
    }
   async function Search(element,url){
    
    if(element.value.trim() == ''){
        element.closest('.search').classList.remove('active');
        return;
    }
        let response=await fetch(url);
        if(response.ok){
            let data=await response.text();
            element.closest('.search').classList.add('active');
            element.closest('.search').querySelector('.child').innerHTML=data;
        }else{
             element.closest('.search').classList.add('active');
             element.closest('.search').querySelector('.child').innerHTML=` <a href="/" class="w-full row align-center g-10">
                    <span>
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M128,20A108,108,0,1,0,236,128,108.12,108.12,0,0,0,128,20Zm0,192a84,84,0,1,1,84-84A84.09,84.09,0,0,1,128,212ZM76,108a16,16,0,1,1,16,16A16,16,0,0,1,76,108Zm104,0a16,16,0,1,1-16-16A16,16,0,0,1,180,108Zm-3.26,57a12,12,0,0,1-19.48,14,36,36,0,0,0-58.52,0,12,12,0,0,1-19.48-14,60,60,0,0,1,97.48,0Z"></path></svg>
                 </span>
                  <span>${response.status} Error</span>
                
                </a>`;
        }
    }
    document.querySelector('main').style.height=Math.abs(document.querySelector('body').getBoundingClientRect().height - document.querySelector('header').getBoundingClientRect().height) + 'px';
    document.querySelector('main').style.marginTop=document.querySelector('header').getBoundingClientRect().height + 'px';
  </script>
  {{-- yield js --}}
    @yield('js')
</body>
</html>