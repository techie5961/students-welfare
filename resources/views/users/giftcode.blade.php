@extends('layout.users.app')
@section('title')
    Gift Code
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
                <span class="font-weight-700 block font-1">Redeem Gift Code</span>
               <span></span>
            </div>
         <div class="w-full column align-center jsutify-center g-10">
            <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="50" width="50"><path d="M15.0049 2.00281C17.214 2.00281 19.0049 3.79367 19.0049 6.00281C19.0049 6.73184 18.8098 7.41532 18.4691 8.00392L23.0049 8.00281V10.0028H21.0049V20.0028C21.0049 20.5551 20.5572 21.0028 20.0049 21.0028H4.00488C3.4526 21.0028 3.00488 20.5551 3.00488 20.0028V10.0028H1.00488V8.00281L5.54065 8.00392C5.19992 7.41532 5.00488 6.73184 5.00488 6.00281C5.00488 3.79367 6.79574 2.00281 9.00488 2.00281C10.2001 2.00281 11.2729 2.52702 12.0058 3.35807C12.7369 2.52702 13.8097 2.00281 15.0049 2.00281ZM13.0049 10.0028H11.0049V20.0028H13.0049V10.0028ZM9.00488 4.00281C7.90031 4.00281 7.00488 4.89824 7.00488 6.00281C7.00488 7.05717 7.82076 7.92097 8.85562 7.99732L9.00488 8.00281H11.0049V6.00281C11.0049 5.00116 10.2686 4.1715 9.30766 4.02558L9.15415 4.00829L9.00488 4.00281ZM15.0049 4.00281C13.9505 4.00281 13.0867 4.81869 13.0104 5.85355L13.0049 6.00281V8.00281H15.0049C16.0592 8.00281 16.923 7.18693 16.9994 6.15207L17.0049 6.00281C17.0049 4.89824 16.1095 4.00281 15.0049 4.00281Z"></path></svg>

         </div>
        </section>
        {{-- new section /body --}}
        <section class="section body">
            <form method="POST" action="{{ url('users/post/redeem/gift/code/process') }}" onsubmit="PostRequest(event,this,Updated)" class="analytics max-w-500 m-x-auto column g-10">
               {{-- csrf token --}}
               <input type="hidden" class="input inp required" name="_token" value="{{ @csrf_token() }}">
                {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>Enter Gift Code</label>
                <div class="cont">
                    <input name="code" placeholder="Enter your gift code" type="text" class="inp input required">
                </div>
               </div>
               <small class="opacity-07">Enter a valid gift code to claim your reward</small>
                
              
             <button class="post">Redeem Code</button>
            </form>
        

              {{-- group --}}
          <section style="transform:translateY(-30px)" class="group w-full column g-10">
             

              {{-- new div --}}
            <div class="column w-full bg-light br-10 g-10 p-20">
                <strong class="font-1">How to get gift code</strong>
               
                 {{-- new row --}}
                <div class="row g-5">
                    <i class="c-green">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM17.4571 9.45711L11 15.9142L6.79289 11.7071L8.20711 10.2929L11 13.0858L16.0429 8.04289L17.4571 9.45711Z"></path></svg>

                    </i>
                    <span>Ensure you are in the platforms official groups & communities on whatsapp & telegram.</span>
                </div>
                  {{-- new row --}}
                <div class="row g-5">
                    <i class="c-green">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM17.4571 9.45711L11 15.9142L6.79289 11.7071L8.20711 10.2929L11 13.0858L16.0429 8.04289L17.4571 9.45711Z"></path></svg>

                    </i>
                    <span>Always stay active so you can get gift codes immediately admin drops.</span>
                </div>
                 
                 {{-- new row --}}
                <div class="row g-5">
                    <i class="c-green">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM17.4571 9.45711L11 15.9142L6.79289 11.7071L8.20711 10.2929L11 13.0858L16.0429 8.04289L17.4571 9.45711Z"></path></svg>

                    </i>
                    <span>Gift codes are limited to certain amount of users and are rendered invalid when met so the trick is survival of the fastest.</span>
                </div>
            </div>
          </section>
        </section>
      
    </section>

    
@endsection
@section('js')
    <script class="js">
        function Updated(response){
            let data=JSON.parse(response);
            if(data.status == 'success'){
                Redirect('{{ url()->current() }}');
            }
        }
    </script>
@endsection