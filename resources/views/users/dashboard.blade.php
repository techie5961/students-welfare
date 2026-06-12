@extends('layout.users.app')
@section('title')
    Dashboard
@endsection
@section('css')
    <style class="css">
        .nav-links{
            user-select:none;
            -webkit-user-select:none;
        }
        .nav-links > div{
            display:flex;
            flex-direction: column;
            align-items:center;
            justify-content:center;
            width:100%;
            gap:5px;
            text-align: center;
            cursor: pointer;
            font-weight:600;
        }
        .nav-links .icon{
            width:50px;
            aspect-ratio:1;
            flex-shrink: 0;
            border-radius:50%;
            display:flex;
            align-items: center;
            justify-content: center;
        }
        .quick-actions{
            width:100%;
            padding:10px;
            border-radius:5px;
            display: flex;
            flex-direction: column;
            gap:10px;
            position: relative;
            overflow:hidden;
           

        }
        .quick-actions::after{
            content:'';
            position: absolute;
            bottom:0;
            right:0;
            width:50%;
            background:rgba(255,255,255,0.1);
            z-index:10;
          
        }
        .quick-actions > div{
            position: relative;
            z-index:100;
           
        }
        .package-card{
            width: 100%;
            border-radius:10px;
            overflow:hidden;
            background:var(--bg-light);
            padding:10px;
            

        }
        .package-card .img{
            /* max-height: 200px; */
            overflow:hidden;
            position: relative;
            border-radius:10px;
            height:100%;
            background-size:cover;
            background-position: center;
            padding-top:50%;
        }
        .package-card .img > div{
            position: relative;
            z-index:100;
            color:white;
        }
        .package-card .img::after{
            content:'';
            position: absolute;
            bottom:0;
            left:0;
            right:0;
            background:linear-gradient(to top,var(--bg-light) 0%,rgba(var(--bg-light-rgb),0.8) 65%,rgba(var(--bg-light-rgb),0.1) 100%);
            overflow:hidden;
           height:100%;
           z-index:10;
           width:100%;
           
        }
        .welcome-message{
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.2);
            z-index:4000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding:20px;
            display: flex;
            align-items:center;
            justify-content: center;
            flex-direction: column;
            display:none;

                    &.active{
                        display:flex;
                    }

                    .child{
                        width:100%;
                        max-width:500px;
                        background:var(--bg);
                        padding:20px;
                        border-radius:5px;
                        max-height:70%;
                        display:flex;
                        flex-direction:column;
                        gap:10px;

                                &.active{
                                    animation:zoomInDown 2s ease forwards;
                                }
                                  &.inactive{
                                    animation:zoomInDown 2s ease reverse forwards;
                                }


                    }

        }
        body:has(.welcome-message.active){
            overflow: hidden;
        }
       
        /* media query for pc */
        @media(min-width:800px){
             img[alt=Banner]{
            max-height:150px;
            max-width:500px;
            margin:auto;
        }
        .quick-actions{
            max-width:70%;
            
        }
        }
    </style>
@endsection
@section('main')
{{-- welcome message --}}
<section onclick="this.classList.remove('active');this.querySelector('.child').classList.remove('active');" class="welcome-message">
    <div onclick="event.stopPropagation()" class="child">
        {{-- new column --}}
        <div class="column align-center w-full g-10">
            <img src="{{ asset(config('settings.logo')) }}" alt="" class="h-40 no-pointer">

<strong class="font-weight-900 text-center c-primary-light font-size-1">
           Welcome to {{ config('app.name') }}

</strong>
        </div>
        {{-- new column --}}
        <div class="w-full overflow-auto">
            
            {!! nl2br($social_settings->site_notification) !!}
        </div>
          {{-- new column --}}
          
        <div class="column align-center w-full g-10">
            <div onclick="this.classList.add('animate__animated','animate__rubberBand');this.addEventListener('animationend',function(){this.classList.remove('animate__animated','animate__rubberBand');});window.open('{{ $social_settings->whatsapp_community }}');" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;border-radius:1000px;height:auto;padding:10px;" class="back-icon">
                <svg viewBox="0 0 24 24" fill="#4caf50" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2ZM8.59339 7.30019L8.39232 7.30833C8.26293 7.31742 8.13607 7.34902 8.02057 7.40811C7.93392 7.45244 7.85348 7.51651 7.72709 7.63586C7.60774 7.74855 7.53857 7.84697 7.46569 7.94186C7.09599 8.4232 6.89729 9.01405 6.90098 9.62098C6.90299 10.1116 7.03043 10.5884 7.23169 11.0336C7.63982 11.9364 8.31288 12.8908 9.20194 13.7759C9.4155 13.9885 9.62473 14.2034 9.85034 14.402C10.9538 15.3736 12.2688 16.0742 13.6907 16.4482C13.6907 16.4482 14.2507 16.5342 14.2589 16.5347C14.4444 16.5447 14.6296 16.5313 14.8153 16.5218C15.1066 16.5068 15.391 16.428 15.6484 16.2909C15.8139 16.2028 15.8922 16.159 16.0311 16.0714C16.0311 16.0714 16.0737 16.0426 16.1559 15.9814C16.2909 15.8808 16.3743 15.81 16.4866 15.6934C16.5694 15.6074 16.6406 15.5058 16.6956 15.3913C16.7738 15.2281 16.8525 14.9166 16.8838 14.6579C16.9077 14.4603 16.9005 14.3523 16.8979 14.2854C16.8936 14.1778 16.8047 14.0671 16.7073 14.0201L16.1258 13.7587C16.1258 13.7587 15.2563 13.3803 14.7245 13.1377C14.6691 13.1124 14.6085 13.1007 14.5476 13.097C14.4142 13.0888 14.2647 13.1236 14.1696 13.2238C14.1646 13.2218 14.0984 13.279 13.3749 14.1555C13.335 14.2032 13.2415 14.3069 13.0798 14.2972C13.0554 14.2955 13.0311 14.292 13.0074 14.2858C12.9419 14.2685 12.8781 14.2457 12.8157 14.2193C12.692 14.1668 12.6486 14.1469 12.5641 14.1105C11.9868 13.8583 11.457 13.5209 10.9887 13.108C10.8631 12.9974 10.7463 12.8783 10.6259 12.7616C10.2057 12.3543 9.86169 11.9211 9.60577 11.4938C9.5918 11.4705 9.57027 11.4368 9.54708 11.3991C9.50521 11.331 9.45903 11.25 9.44455 11.1944C9.40738 11.0473 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.74939 10.663 9.86248 10.5183C9.97128 10.379 10.0652 10.2428 10.125 10.1457C10.2428 9.95633 10.2801 9.76062 10.2182 9.60963C9.93764 8.92565 9.64818 8.24536 9.34986 7.56894C9.29098 7.43545 9.11585 7.33846 8.95659 7.32007C8.90265 7.31384 8.84875 7.30758 8.79459 7.30402C8.66053 7.29748 8.5262 7.29892 8.39232 7.30833L8.59339 7.30019Z"></path></svg>
                Join Whatsapp
            </div>
            <div onclick="this.classList.add('animate__animated','animate__rubberBand');this.addEventListener('animationend',function(){this.classList.remove('animate__animated','animate__rubberBand');});window.open('{{ $social_settings->telegram_community }}');"  style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;border-radius:1000px;height:auto;padding:10px;" class="back-icon">
                <svg viewBox="0 0 24 24" fill="aqua" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM12.3584 9.38246C11.3857 9.78702 9.4418 10.6244 6.5266 11.8945C6.05321 12.0827 5.80524 12.2669 5.78266 12.4469C5.74451 12.7513 6.12561 12.8711 6.64458 13.0343C6.71517 13.0565 6.78832 13.0795 6.8633 13.1039C7.37388 13.2698 8.06071 13.464 8.41776 13.4717C8.74164 13.4787 9.10313 13.3452 9.50222 13.0711C12.226 11.2325 13.632 10.3032 13.7203 10.2832C13.7826 10.269 13.8689 10.2513 13.9273 10.3032C13.9858 10.3552 13.98 10.4536 13.9739 10.48C13.9361 10.641 12.4401 12.0318 11.666 12.7515C11.4351 12.9661 11.2101 13.1853 10.9833 13.4039C10.509 13.8611 10.1533 14.204 11.003 14.764C11.8644 15.3317 12.7323 15.8982 13.5724 16.4971C13.9867 16.7925 14.359 17.0579 14.8188 17.0156C15.0861 16.991 15.3621 16.7397 15.5022 15.9903C15.8335 14.2193 16.4847 10.3821 16.6352 8.80083C16.6484 8.6623 16.6318 8.485 16.6185 8.40717C16.6052 8.32934 16.5773 8.21844 16.4762 8.13635C16.3563 8.03913 16.1714 8.01863 16.0887 8.02009C15.7125 8.02672 15.1355 8.22737 12.3584 9.38246Z"></path></svg>

                Join Telegram
            </div>
                 </div>

    </div>
</section>
    <section class="w-full column g-10">
        {{-- new row --}}
        <div class="grid place-center nav-links grid-4 w-full row align-center g-10 space-between">
            {{-- new item --}}
            <div onclick="Redirect('{{ url('users/recharge') }}')">
                <div style="background:gold;color:black;" class="icon">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M22.0049 10.9998V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V10.9998H22.0049ZM22.0049 6.99979H2.00488V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V6.99979Z"></path></svg>

                </div>
                <span class="font-weight-500">Recharge</span>
            </div>
             {{-- new item --}}
            <div onclick="Redirect('{{ url('users/withdraw') }}')">
                <div style="background:rgb(0, 255, 242);color:black;" class="icon">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M22.0049 9.99979V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V9.99979H22.0049ZM22.0049 7.99979H2.00488V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V7.99979ZM15.0049 15.9998V17.9998H19.0049V15.9998H15.0049Z"></path></svg>

                </div>
                <span>Withdrawal</span>
            </div>
            {{-- new item --}}
            <div onclick="Redirect('{{ url('users/gift/code') }}')">
                <div style="background:rgb(108,92,230);color:white;" class="icon">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15.0049 2.00281C17.214 2.00281 19.0049 3.79367 19.0049 6.00281C19.0049 6.73184 18.8098 7.41532 18.4691 8.00392L23.0049 8.00281V10.0028H21.0049V20.0028C21.0049 20.5551 20.5572 21.0028 20.0049 21.0028H4.00488C3.4526 21.0028 3.00488 20.5551 3.00488 20.0028V10.0028H1.00488V8.00281L5.54065 8.00392C5.19992 7.41532 5.00488 6.73184 5.00488 6.00281C5.00488 3.79367 6.79574 2.00281 9.00488 2.00281C10.2001 2.00281 11.2729 2.52702 12.0058 3.35807C12.7369 2.52702 13.8097 2.00281 15.0049 2.00281ZM13.0049 10.0028H11.0049V20.0028H13.0049V10.0028ZM9.00488 4.00281C7.90031 4.00281 7.00488 4.89824 7.00488 6.00281C7.00488 7.05717 7.82076 7.92097 8.85562 7.99732L9.00488 8.00281H11.0049V6.00281C11.0049 5.00116 10.2686 4.1715 9.30766 4.02558L9.15415 4.00829L9.00488 4.00281ZM15.0049 4.00281C13.9505 4.00281 13.0867 4.81869 13.0104 5.85355L13.0049 6.00281V8.00281H15.0049C16.0592 8.00281 16.923 7.18693 16.9994 6.15207L17.0049 6.00281C17.0049 4.89824 16.1095 4.00281 15.0049 4.00281Z"></path></svg>

                </div>
                <span class="font-weight-500">Gift Code</span>
            </div>
            {{-- new item --}}
            <div>
                <div style="background:#4caf50;color:white;" class="icon">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2ZM8.59339 7.30019L8.39232 7.30833C8.26293 7.31742 8.13607 7.34902 8.02057 7.40811C7.93392 7.45244 7.85348 7.51651 7.72709 7.63586C7.60774 7.74855 7.53857 7.84697 7.46569 7.94186C7.09599 8.4232 6.89729 9.01405 6.90098 9.62098C6.90299 10.1116 7.03043 10.5884 7.23169 11.0336C7.63982 11.9364 8.31288 12.8908 9.20194 13.7759C9.4155 13.9885 9.62473 14.2034 9.85034 14.402C10.9538 15.3736 12.2688 16.0742 13.6907 16.4482C13.6907 16.4482 14.2507 16.5342 14.2589 16.5347C14.4444 16.5447 14.6296 16.5313 14.8153 16.5218C15.1066 16.5068 15.391 16.428 15.6484 16.2909C15.8139 16.2028 15.8922 16.159 16.0311 16.0714C16.0311 16.0714 16.0737 16.0426 16.1559 15.9814C16.2909 15.8808 16.3743 15.81 16.4866 15.6934C16.5694 15.6074 16.6406 15.5058 16.6956 15.3913C16.7738 15.2281 16.8525 14.9166 16.8838 14.6579C16.9077 14.4603 16.9005 14.3523 16.8979 14.2854C16.8936 14.1778 16.8047 14.0671 16.7073 14.0201L16.1258 13.7587C16.1258 13.7587 15.2563 13.3803 14.7245 13.1377C14.6691 13.1124 14.6085 13.1007 14.5476 13.097C14.4142 13.0888 14.2647 13.1236 14.1696 13.2238C14.1646 13.2218 14.0984 13.279 13.3749 14.1555C13.335 14.2032 13.2415 14.3069 13.0798 14.2972C13.0554 14.2955 13.0311 14.292 13.0074 14.2858C12.9419 14.2685 12.8781 14.2457 12.8157 14.2193C12.692 14.1668 12.6486 14.1469 12.5641 14.1105C11.9868 13.8583 11.457 13.5209 10.9887 13.108C10.8631 12.9974 10.7463 12.8783 10.6259 12.7616C10.2057 12.3543 9.86169 11.9211 9.60577 11.4938C9.5918 11.4705 9.57027 11.4368 9.54708 11.3991C9.50521 11.331 9.45903 11.25 9.44455 11.1944C9.40738 11.0473 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.74939 10.663 9.86248 10.5183C9.97128 10.379 10.0652 10.2428 10.125 10.1457C10.2428 9.95633 10.2801 9.76062 10.2182 9.60963C9.93764 8.92565 9.64818 8.24536 9.34986 7.56894C9.29098 7.43545 9.11585 7.33846 8.95659 7.32007C8.90265 7.31384 8.84875 7.30758 8.79459 7.30402C8.66053 7.29748 8.5262 7.29892 8.39232 7.30833L8.59339 7.30019Z"></path></svg>

                </div>
                <span class='font-weight-500'>Channel</span>
            </div>
        </div>
        {{-- banner --}}
        <img style="pointer-events: none;" src="{{ asset('banners/IMG_6768.jpeg') }}" alt="Banner" class="w-full no-pointer br-10 no-select">
      
        {{-- new row --}}
        <div class="row no-select align-center justify-center w-full g-10">
            {{-- new item --}}
            <div style="background:greenyellow;color:black;" class="quick-actions">
               <div class="column g-10 w-full">
                 <strong class="font-weight-900 font-1">Invite Friends</strong>
                 <small>Invite your families & friends and get up to {{ number_format($referral_settings->level_1) }}%, {{ number_format($referral_settings->level_2) }}%, {{ number_format($referral_settings->level_3) }}% reward if your friend purchases a package.</small>
               <div class="row w-full align-center g-10 space-between">
                <div onclick="Redirect('{{ url('users/invite') }}')" class="row opacity-05 align-center g-5">
                    <small>Click to share</small>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="10" width="10"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg>

                </div>
                <span class="c-white">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="30" width="30"><path d="M216,72H180.92c.39-.33.79-.65,1.17-1A29.53,29.53,0,0,0,192,49.57,32.62,32.62,0,0,0,158.44,16,29.53,29.53,0,0,0,137,25.91a54.94,54.94,0,0,0-9,14.48,54.94,54.94,0,0,0-9-14.48A29.53,29.53,0,0,0,97.56,16,32.62,32.62,0,0,0,64,49.57,29.53,29.53,0,0,0,73.91,71c.38.33.78.65,1.17,1H40A16,16,0,0,0,24,88v32a16,16,0,0,0,16,16v64a16,16,0,0,0,16,16h60a4,4,0,0,0,4-4V120H40V88h80v32h16V88h80v32H136v92a4,4,0,0,0,4,4h60a16,16,0,0,0,16-16V136a16,16,0,0,0,16-16V88A16,16,0,0,0,216,72ZM84.51,59a13.69,13.69,0,0,1-4.5-10A16.62,16.62,0,0,1,96.59,32h.49a13.69,13.69,0,0,1,10,4.5c8.39,9.48,11.35,25.2,12.39,34.92C109.71,70.39,94,67.43,84.51,59Zm87,0c-9.49,8.4-25.24,11.36-35,12.4C137.7,60.89,141,45.5,149,36.51a13.69,13.69,0,0,1,10-4.5h.49A16.62,16.62,0,0,1,176,49.08,13.69,13.69,0,0,1,171.49,59Z"></path></svg>


                </span>
               </div>
                </div>
            </div>
            {{-- new item --}}
             <div style="background:coral;color:black;" class="quick-actions">
                   <div class="column g-10 w-full">
                 <strong class="font-weight-900 font-1">Download the APP</strong>
                 <small>Download and install our app and get download bonus and push notifications</small>
               <div class="row w-full align-center g-10 space-between">
                <div onclick="CreateNotify('info','Official app is coming soon....')" class="row opacity-05 align-center g-5">
                    <small>Click to install</small>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="10" width="10"><path d="M144.49,136.49l-80,80a12,12,0,0,1-17-17L119,128,47.51,56.49a12,12,0,0,1,17-17l80,80A12,12,0,0,1,144.49,136.49Zm80-17-80-80a12,12,0,1,0-17,17L199,128l-71.52,71.51a12,12,0,0,0,17,17l80-80A12,12,0,0,0,224.49,119.51Z"></path></svg>

                </div>
                <span class="c-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="30" width="30"><path d="M207.06,80.67c-.74-.74-1.49-1.46-2.24-2.17l24.84-24.84a8,8,0,0,0-11.32-11.32l-26,26a111.43,111.43,0,0,0-128.55.19L37.66,42.34A8,8,0,0,0,26.34,53.66L51.4,78.72A113.38,113.38,0,0,0,16,161.13V184a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V160A111.25,111.25,0,0,0,207.06,80.67ZM92,160a12,12,0,1,1,12-12A12,12,0,0,1,92,160Zm72,0a12,12,0,1,1,12-12A12,12,0,0,1,164,160Z"></path></svg>


                </span>
               </div>
                </div>
            </div>
        </div>
        {{-- packages loop --}}
        @if ($packages->isEmpty())
            @include('components.utilities',[
                'empty' => true,
                'data' => $packages
            ])
        @else
        
        
            <strong class="desc font-weight-900 m-top-10">Available Products</strong>
        <div class="grid pc-grid-2 g-10 w-full">
         @foreach ($packages as $data)
          <div style="border:1px solid var(--rgt-02);background:var(--rgt-005);padding:15px 0;" class="w-full column bg-lightg br-5 g-10">
            {{-- new row --}}
            <div style="padding:0 15px;" class="row w-full g-10">
                {{-- new column --}}
                <div class="column g-5 align-center">
                    <img style="max-width:100px;width:100px;max-height:70px" src="{{ asset('packages/'.$data->photo.'') }}" alt="" class="br-10">
            {{-- new --}}
            <div class="row w-fit p-5 font-weight-900 p-x-20 h-fit br-1000 bg-green c-white no-select">Available</div>
            
                </div>
                {{-- new column --}}
                <div class="column g-5">
                    {{-- new --}}
                    <strong class="font-1 font-weight-900">{{ $data->name }}</strong>
                    {{-- new row --}}
                    <div class="row align-center g-5">
                        <div style="color:#00ff08;display:flex;align-items:center;justify-content:center;border-radius:50%;height:25px;width:25px;background:var(--rgt-01);">
                            <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM13 12H17V14H11V7H13V12Z"></path></svg>

                        </div>
                        <span>{{ number_format($data->validity) }} Days</span>
                    </div>
                      {{-- new row --}}
                    <div class="row align-center g-5">
                        <div style="color:#00ffdd;display:flex;align-items:center;justify-content:center;border-radius:50%;height:25px;width:25px;background:var(--rgt-01);">
                           <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12.0004 16C14.2095 16 16.0004 14.2091 16.0004 12 16.0004 9.79086 14.2095 8 12.0004 8 9.79123 8 8.00037 9.79086 8.00037 12 8.00037 14.2091 9.79123 16 12.0004 16ZM21.0049 4.00293H3.00488C2.4526 4.00293 2.00488 4.45064 2.00488 5.00293V19.0029C2.00488 19.5552 2.4526 20.0029 3.00488 20.0029H21.0049C21.5572 20.0029 22.0049 19.5552 22.0049 19.0029V5.00293C22.0049 4.45064 21.5572 4.00293 21.0049 4.00293ZM4.00488 15.6463V8.35371C5.13065 8.017 6.01836 7.12892 6.35455 6.00293H17.6462C17.9833 7.13193 18.8748 8.02175 20.0049 8.3564V15.6436C18.8729 15.9788 17.9802 16.8711 17.6444 18.0029H6.3563C6.02144 16.8742 5.13261 15.9836 4.00488 15.6463Z"></path></svg>

                        </div>
                        <span>{{ $currency.number_format($data->earning,2) }}</span>
                    </div>
                     {{-- new row --}}
                    <div class="row align-center g-5">
                        <div style="color:#ffee00;display:flex;align-items:center;justify-content:center;border-radius:50%;height:25px;width:25px;background:var(--rgt-01);">
                           <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM11 13V17H6V13H11ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z"></path></svg>

                        </div>
                        <span>Daily Interest Repayment</span>
                    </div>
                </div>
                </div>
                {{-- new row --}}
            <div style="padding:0 15px;padding-top:15px;border-top:1px solid var(--rgt-02)" class="column w-full g-10">
                {{-- new row --}}
                    <div class="row font-size-1 font-weight-900 align-center g-5">
                        <div style="color:#91ff00;display:flex;align-items:center;justify-content:center;border-radius:50%;height:30px;width:30px;background:var(--rgt-01);">
                           <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M17.0047 16.0028H19.0047V4.00281H9.00468V6.00281H17.0047V16.0028ZM17.0047 18.0028V21.0019C17.0047 21.5547 16.5547 22.0028 15.9978 22.0028H4.01154C3.45548 22.0028 3.00488 21.5582 3.00488 21.0019L3.00748 7.00368C3.00759 6.45091 3.45752 6.00281 4.0143 6.00281H7.00468V3.00281C7.00468 2.45052 7.4524 2.00281 8.00468 2.00281H20.0047C20.557 2.00281 21.0047 2.45052 21.0047 3.00281V17.0028C21.0047 17.5551 20.557 18.0028 20.0047 18.0028H17.0047ZM5.0073 8.00281L5.00507 20.0028H15.0047V8.00281H5.0073ZM7.00468 16.0028H11.5047C11.7808 16.0028 12.0047 15.7789 12.0047 15.5028C12.0047 15.2267 11.7808 15.0028 11.5047 15.0028H8.50468C7.12397 15.0028 6.00468 13.8835 6.00468 12.5028C6.00468 11.1221 7.12397 10.0028 8.50468 10.0028H9.00468V9.00281H11.0047V10.0028H13.0047V12.0028H8.50468C8.22854 12.0028 8.00468 12.2267 8.00468 12.5028C8.00468 12.7789 8.22854 13.0028 8.50468 13.0028H11.5047C12.8854 13.0028 14.0047 14.1221 14.0047 15.5028C14.0047 16.8835 12.8854 18.0028 11.5047 18.0028H11.0047V19.0028H9.00468V18.0028H7.00468V16.0028Z"></path></svg>

                        </div>
                        <span>Product Cost: {{ $currency.number_format($data->cost,2) }}</span>
                    </div>
                <button onclick="Overlay('{{ $data->id }}','{{ asset('packages/'.$data->photo.'') }}','{{ $data->name }}','{{ $currency.number_format($data->cost,2) }}','{{ number_format($data->available) }}','{{ number_format($data->validity) }} Days','{{ $currency.number_format($data->earning,2) }}','{{ $currency.number_format(($data->earning * $data->validity),2) }}')" style="background:var(--primary)" class="w-full font-weight-900 h-50 br-5 border-none no-select pointer bg-primary primary-text row align-center justify-center">
                    Invest
                </button>
            </div>
          </div>
        @endforeach
        @endif
       
       </div>
    </section>
 {{-- overlay --}}
 <section class="overlay">
{{-- new row --}}
<div style="background:hsl(var(--primary-hsl),70%,50%);" class="row pos-sticky top-0 w-full align-center space-between p-15 g-10 bg-primary no-select primary-text">
    
 <i onclick="this.closest('.overlay').classList.remove('active')" class="row back-icon pointer align-center h-fit">

    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z"></path></svg>
  </i>
    <span class="font-1 font-weight-500">Investment Details</span>
    <span></span>
</div>
{{-- new column --}}
<section class="column w-full p-15 g-10">
    <form action="{{ url('users/post/purchase/package/process') }}" method="POST" onsubmit="PostRequest(event,this,Purchased)" style="border:1px solid var(--rgt-02)" class="w-full br-5 column g-10 p-15">
{{-- csrf token --}}
<input type="hidden" class="inp input" name="_token" value="{{ @csrf_token() }}">
{{-- package id --}}
<input type="hidden" class="inp bg-transparent input" name="id" value="">

        {{-- new --}}
<div class="row align-center g-5">
 <img style="max-width:100px;width:100px;max-height:70px" src="" package-banner alt="" class="br-10 no-shrink no-pointer">

<div package-name class="desc font-weight-900">PACKAGE VIP 1</div>
</div>

{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02)" class="row w-full align-center space-between">
    <span>Available balance</span>
    <span>{{ $currency.number_format(Auth::guard('users')->user()->deposit_balance,2) }}</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02)" class="row w-full align-center space-between">
    <span>Package Price</span>
    <span package-cost>{{ $currency.number_format(50000,2) }}</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02)" class="row w-full align-center space-between">
    <span>Purchase Quantity</span>
    <span>1</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02)" class="row w-full align-center space-between">
    <span>Total Units Available</span>
    <span total-available>{{ number_format(100) }}</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02)" class="row w-full align-center space-between">
    <span>Investment Cycle</span>
    <span package-cycle>20 Days</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02)" class="row w-full align-center space-between">
    <span>Daily Payout</span>
    <span package-earning>{{ $currency.number_format(10000,2) }}</span>
</div>
 <button onclick="document.querySelector('.overlay').classList.add('active')" style="background:var(--primary)" class="w-full font-weight-900 h-50 g-5 br-5 border-none no-select pointer bg-primary primary-text row align-center justify-center">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12.0049 22.0027C6.48204 22.0027 2.00488 17.5256 2.00488 12.0027C2.00488 6.4799 6.48204 2.00275 12.0049 2.00275C17.5277 2.00275 22.0049 6.4799 22.0049 12.0027C22.0049 17.5256 17.5277 22.0027 12.0049 22.0027ZM12.0049 20.0027C16.4232 20.0027 20.0049 16.421 20.0049 12.0027C20.0049 7.58447 16.4232 4.00275 12.0049 4.00275C7.5866 4.00275 4.00488 7.58447 4.00488 12.0027C4.00488 16.421 7.5866 20.0027 12.0049 20.0027ZM8.50488 14.0027H14.0049C14.281 14.0027 14.5049 13.7789 14.5049 13.5027C14.5049 13.2266 14.281 13.0027 14.0049 13.0027H10.0049C8.62417 13.0027 7.50488 11.8835 7.50488 10.5027C7.50488 9.12203 8.62417 8.00275 10.0049 8.00275H11.0049V6.00275H13.0049V8.00275H15.5049V10.0027H10.0049C9.72874 10.0027 9.50488 10.2266 9.50488 10.5027C9.50488 10.7789 9.72874 11.0027 10.0049 11.0027H14.0049C15.3856 11.0027 16.5049 12.122 16.5049 13.5027C16.5049 14.8835 15.3856 16.0027 14.0049 16.0027H13.0049V18.0027H11.0049V16.0027H8.50488V14.0027Z"></path></svg>

    Invest Now
    </button>
</form>
    <div style="border:1px solid var(--rgt-02)" class="w-full br-5 column g-10 p-15">
{{-- new --}}
<div style="border-bottom:1px solid var(--primary-lighter);padding-bottom:15px;color:var(--primary-lighter)" class="w-full desc font-weight-900 row c-prgimary">Project Rules</div>
    {{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02);padding-top:10px;" class="row w-full align-center space-between">
    <span>Repayment</span>
    <span>Every 24 Hrs.</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02);" class="row w-full align-center space-between">
    <span>Expected Income</span>
    <span total-earning>{{ $currency }}2000,000</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;border-bottom:1px solid var(--rgt-02);" class="row w-full align-center space-between">
    <span>Daily Report</span>
    <span>Yes</span>
</div>
{{-- new row --}}
<div style="padding-bottom:15px;" class="row w-full align-center space-between">
    <span>Expires After</span>
    <span validity>20 Days</span>
</div>
</div>
</section>
 </section>
@endsection
@section('js')
<script class="js">
    // new
    function Overlay(id,banner,name,cost,available,cycle,earning,total_earning){
        try{
        document.querySelector('.overlay img[package-banner]').src=banner;
        document.querySelector('.overlay [package-name]').innerHTML=name;
        document.querySelector('.overlay [package-cost]').innerHTML=cost;
        document.querySelector('.overlay [total-available]').innerHTML=available;
        document.querySelector('.overlay [package-cycle]').innerHTML=cycle;
        document.querySelector('.overlay [package-earning]').innerHTML=earning;
        document.querySelector('.overlay [total-earning]').innerHTML=total_earning;
        document.querySelector('.overlay [validity]').innerHTML=cycle;
        document.querySelector('.overlay input[name=id]').value=id;
        document.querySelector('.overlay').classList.add('active');
        }catch(error){
            alert(error)
        }

    }
    // new
    function Purchased(response){
        let data=JSON.parse(response);
        if(data.status == 'success'){
            Redirect('{{ url('users/products/active') }}');
        }
    }
// new
function PageStyle(){
    document.querySelector('.welcome-message').classList.add('active');
    document.querySelector('.welcome-message .child').classList.add('active');
    document.querySelector('.welcome-message .child').addEventListener('animationend',()=>{
        this.classList.remove('active');
    });
    let quick_actions=document.querySelectorAll('.quick-actions > div');
    let max_height=0;
    quick_actions.forEach((data)=>{
        if(data.offsetHeight > max_height){
            max_height=data.offsetHeight;
        }
    });

     quick_actions.forEach((data)=>{
       
          data.style.height=max_height + 'px';
       
    });


}


// calling functions
// loaded
window.addEventListener('load',()=>{
PageStyle();
});
// spa navigated
document.addEventListener('vitecss:navigated',()=>{
PageStyle();
});
</script>
@endsection