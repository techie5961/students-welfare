@extends('layout.users.app')
@section('title')
    Update Password
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
                <span class="font-weight-700 block font-1">Update Login Password</span>
               <span></span>
            </div>
         
        </section>
        {{-- new section /body --}}
        <section class="section body">
            <form action="{{ url('users/post/update/password/process') }}" onsubmit="PostRequest(event,this,Updated)" class="analytics max-w-500 m-x-auto column g-10">
               {{-- csrf token --}}
               <input type="hidden" class="input inp required" name="_token" value="{{ @csrf_token() }}">
                {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>Current Password</label>
                <div class="cont">
                    <input autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly')" name="current" placeholder="Enter current account password" type="password" class="inp input required">
                </div>
               </div>
                {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>New Password</label>
               <div class="cont">
                    <input name="new" placeholder="Enter new account password" type="password" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly')" class="inp input required">
                </div>
               </div>
               {{-- new input --}}
                <div class="column g-5 w-full">
                 <label>Confirm New Password</label>
               <div class="cont">
                    <input name="confirm" placeholder="Re-Type new account password" type="password" autocomplete="new-password" readofnly onfocus="this.removeAttribute('readonly')" class="inp input required">
                </div>
               </div>
              
             <button class="post">Update Password</button>
            </form>
        

            
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