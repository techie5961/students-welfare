@extends('layout.users.app')
@section('title')
    Bank Details
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

        .banks-list{

                    .null{
                        display:none;
                    }

        &.empty{

                    .null{
                        display:flex;
                    }
        }       

                  
        }

        .bank-cont{

                    .selected-bank{
                        display:none;
                    }
        
        &.active{

            .placeholder{
                display:none !important;
            }
            .selected-bank{
                display:flex;
                flex-direction:row;
                align-items:center;
                justify-content:space-between;
                gap:5px;
                padding:10px;
                width:100%;
                
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
        <section class="section title">
            <div class="row w-full g-10 align-center space-between">
                <i onclick="Redirect('{{ url()->previous() }}')" class="row back-icon pointer align-center h-fit">

                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z"></path></svg>
                </i>
                <span class="font-weight-700 block font-1">Update Bank Details</span>
                <span onclick="Redirect('{{ url('users/withdraw') }}')">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="25" width="25"><path d="M3.00488 2.99979H21.0049C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979ZM20.0049 10.9998H4.00488V18.9998H20.0049V10.9998ZM20.0049 8.99979V4.99979H4.00488V8.99979H20.0049ZM14.0049 14.9998H18.0049V16.9998H14.0049V14.9998Z"></path></svg>

                </span>
           
            </div>
          @isset(Auth::guard('users')->user()->bank)
                <div style="border:1px solid rgb(var(--primary-text-rgb),0.2);box-shadow:0 10px 10px rgba(0,0,0,0.1)" class="w-full max-w-500 m-x-auto br-10 p-20 column g-5">
               <strong>Current Bank Account</strong>
               <span class="uppercase">{{ json_decode(Auth::guard('users')->user()->bank)->account_name }}</span>
               <span class="opacity-07">{{ json_decode(Auth::guard('users')->user()->bank)->bank_name }}  ....{{ substr(json_decode(Auth::guard('users')->user()->bank)->account_number,6,4) }}</span>
            </div>
          @endisset
        </section>
        {{-- new section /body --}}
        <section class="section body">
            <form action="{{ url('users/post/add/bank/process') }}" onsubmit="PostRequest(event,this,Added)" class="analytics max-w-500 m-x-auto column g-10">
               {{-- csrf token --}}
               <input type="hidden" class="input inp required" name="_token" value="{{ @csrf_token() }}">
                {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>Account Number</label>
                <div class="cont">
                    <input name="account_number" placeholder="Enter 10-digits account number" inputmode="numeric" type="number" class="inp input required">
                </div>
               </div>
                {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>Bank Name</label>
                <div onclick="document.querySelector('.overlay.banks').classList.add('active');" class="no-select bank-cont pc-pointer cont">
                    {{-- placeholder --}}
                    <div class="w-full placeholder p-10 opacity-07 row align-center space-between">
                        <span>Select Bank</span>
                        <i>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                        </i>
                    </div>
                    {{-- selected bank --}}
                    <div class="selected-bank">
                        <div style="box-shadow:0 0 10px rgba(0,0,0,0.1)" class="h-30 w-30 no-shrink column bg-white p-5 align-center justify-center circle">
                        <img src="" bank-photo alt="" class="h-full no-pointer br-inherit w-full">
                    </div>
                        <span bank-name class="m-right-auto ws-nowrap text-overflow-ellipsis"></span>
                          <i>
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M13.1717 12.0007L8.22192 7.05093L9.63614 5.63672L16.0001 12.0007L9.63614 18.3646L8.22192 16.9504L13.1717 12.0007Z"></path></svg>

                        </i>
                    </div>
                  <input name="bank_name" type="hidden" class="inp input required">
                </div>
               </div>
               {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>Account Name</label>
                <div class="cont">
                  <input name="account_name" type="text" placeholder="Enter account name" class="inp input required">
                </div>
               </div>
              
             <button class="post">Update Bank Details</button>
            </form>
          {{-- group --}}
          <section style="transform:translateY(-30px)" class="group w-full column g-10">
             

              {{-- new div --}}
            <div class="column w-full bg-light br-10 g-10 p-20">
                <strong class="font-1">Instructions</strong>
               
                 {{-- new row --}}
                <div class="row g-5">
                    <i class="c-green">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM17.4571 9.45711L11 15.9142L6.79289 11.7071L8.20711 10.2929L11 13.0858L16.0429 8.04289L17.4571 9.45711Z"></path></svg>

                    </i>
                    <span>Please ensure the account entered is correct to avoid issues with withdrawal.</span>
                </div>
                  {{-- new row --}}
                <div class="row g-5">
                    <i class="c-green">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM17.4571 9.45711L11 15.9142L6.79289 11.7071L8.20711 10.2929L11 13.0858L16.0429 8.04289L17.4571 9.45711Z"></path></svg>

                    </i>
                    <span>You can always come back here to update your bank details.</span>
                </div>
                 
                 {{-- new row --}}
                <div class="row g-5">
                    <i class="c-green">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM17.4571 9.45711L11 15.9142L6.79289 11.7071L8.20711 10.2929L11 13.0858L16.0429 8.04289L17.4571 9.45711Z"></path></svg>

                    </i>
                    <span>If you encounter any difficulties in adding your bank account do well to contact our support team.</span>
                </div>
            </div>
          </section>

            
        </section>
    </section>

    {{-- banks overlay --}}
    <section class="overlay banks">
        <div class="pos-sticky p-20 top-0 w-full g-10 bg-inherit column">
            {{-- new row --}}
            <div class="row w-full g-10 align-center space-between">
                <i class="pc-pointer" onclick="this.closest('.overlay').classList.remove('active');">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10.5859 12L2.79297 4.20706L4.20718 2.79285L12.0001 10.5857L19.793 2.79285L21.2072 4.20706L13.4143 12L21.2072 19.7928L19.793 21.2071L12.0001 13.4142L4.20718 21.2071L2.79297 19.7928L10.5859 12Z"></path></svg>

                </i>
                <strong class="font-1">Select Bank</strong>
                <span></span>
            </div>
            <div style="background:var(--rgt-01);" class="w-full row align-center h-40 br-5">
                <i style="color:#708090;" class="h-full row perfect-square no-shrink align-center justify-center">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="16" width="16"><path d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z"></path></svg>

                </i>
                <input oninput="SearchBanks(this)" style="padding-left:0" type="text" placeholder="Search bank Name" class="w-full bg-transparent h-full br-inherit border-none">
           <span onclick="ClearInput(this)" id="clear" style="background:var(--rgt-01);" class="circle pc-pointer h-20 display-none column align-center justify-center opacity-07 no-select m-right-10 w-20 perfect-square no-shrink p-5">
            &times;
           </span>
            </div>
        </div>
        {{-- body --}}

        <div class="w-full column g-10 banks-list">
            <div style="padding:30px;" class="row no-select text-center null column w-full align-center justify-center g-10">
                <i>
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="50" width="50"><path d="M15.5 5C13.567 5 12 6.567 12 8.5C12 10.433 13.567 12 15.5 12C17.433 12 19 10.433 19 8.5C19 6.567 17.433 5 15.5 5ZM10 8.5C10 5.46243 12.4624 3 15.5 3C18.5376 3 21 5.46243 21 8.5C21 9.6575 20.6424 10.7315 20.0317 11.6175L22.7071 14.2929L21.2929 15.7071L18.6175 13.0317C17.7315 13.6424 16.6575 14 15.5 14C12.4624 14 10 11.5376 10 8.5ZM3 4H8V6H3V4ZM3 11H8V13H3V11ZM21 18V20H3V18H21Z"></path></svg>

                </i>
                <span>Bank not found. Enter the correct bank name and try again</span>
            </div>
            @foreach ($banks as $data)
                <div onclick="ChooseBank(this,'{{ $data->id }}','{{ $data->name }}','{{ asset($data->logo) }}')" class="w-full bank p-20 p-y-10 no-select pc-pointer row g-10 align-center">
                    <div style="box-shadow:0 0 10px rgba(0,0,0,0.1)" class="h-40 w-40 no-shrink column bg-white p-5 align-center justify-center circle">
                        <img src="{{ asset($data->logo) }}" alt="" class="h-full no-pointer br-inherit w-full">
                    </div>
                    <span>{{ $data->name }}</span>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@section('js')
    <script class="js">
      function SearchBanks(element){
       try{
        if(element.value.trim() == ''){
            document.getElementById('clear').classList.add('display-none');
        }else{
            document.getElementById('clear').classList.remove('display-none');

 let isIncludes=false;
         element.closest('.overlay').querySelectorAll('.bank').forEach((bnk)=>{
            if(bnk.innerText.includes(element.value)){
                bnk.classList.remove('display-none');
                isIncludes=true;
            }else{
                bnk.classList.add('display-none');
            }
        });
        if(!isIncludes){
            document.querySelector('.banks-list').classList.add('empty');
        }else{
            document.querySelector('.banks-list').classList.remove('empty');

        }
        }
       
       }catch(error){
        alert(error)
       }
      }

    //   new
    function ClearInput(element){
        element.closest('div').querySelector('input').value='';
        document.querySelector('.banks-list').classList.remove('empty');
        element.classList.add('display-none');
         element.closest('.overlay').querySelectorAll('.bank').forEach((bnk)=>{
                bnk.classList.remove('display-none');
           
        });
    }

    // new
    function ChooseBank(element,id,name,logo){
        document.querySelector('input[name=bank_name]').value=id;
        document.querySelector('[bank-name]').innerText=name;
        document.querySelector('[bank-photo]').src=logo;
        document.querySelector('.bank-cont').classList.add('active');
        document.querySelector('.overlay.banks').classList.remove('active');
         element.closest('.overlay').querySelector('input').value='';
        document.querySelector('.banks-list').classList.remove('empty');
        document.getElementById('clear').classList.add('display-none');
         element.closest('.overlay').querySelectorAll('.bank').forEach((bnk)=>{
                bnk.classList.remove('display-none');
           
        });
        document.querySelector('.overlay.banks').scrollTo(0,0);
    }

    // added
    function Added(response){
        let data=JSON.parse(response);
        if(data.status == 'success'){
            if('{{ $next }}' == 'withdrawal'){
                Redirect('{{ url('users/withdraw') }}');
            }else{
                Redirect('{{ url()->current() }}')
            }
        }
    }
    </script>
@endsection