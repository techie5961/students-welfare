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
      @include('components.utilities',[
    'vite_js' => true
  ])
  <script>
    function Redirect(url,element=false){
        if(element){
            element.classList.add('animate');

            element.addEventListener('animationend',()=>{
                element.classList.remove('animate');
            })
        }
       Vitecss.navigate(url);
    }
    window.addEventListener('load',()=>{
        document.body.style.paddingBottom=document.querySelector('footer').offsetHeight + 'px';
    })
  </script>
    <title>{{ config('app.name') }} || Users || @yield('title') </title>
    <style>
        footer{
            padding:10px;
            width:100%;
            position:fixed;
            bottom:0;
            background:var(--bg);
            border-top:1px solid var(--rgt-01);
            display:grid;
            grid-template-columns: repeat(4,1fr);
            gap:10px;
            place-items: center;
            text-align: center;
            user-select: none;
            -webkit-user-select: none;
            color:var(--rgt-09);
            font-weight:400;
            z-index:3000;
        }
        footer > div{
            cursor: pointer;

                    &.animate{
                        animation: animate 0.5s ease forwards;
                    }
        }

        @keyframes animate{
            0%,100%{
                transform: scale(1);
            }
            50%{
                transform: scale(1.2);
            }
        }

         .back-icon{
         height:40px;
         width:40px;
         background:rgba(0,0,0,0.1);
         border-radius:50%;
         display:flex;
         align-items:center;
         justify-content: center;
         position:relative;

                &::before{
                    padding: 1px;
                    content:'';
                    position:absolute;
                    inset:0;
                    border-radius:inherit;
                    background:linear-gradient(to bottom right,rgba(255,255,255,0.5),transparent,rgba(255,255,255,0.5));
                    mask:linear-gradient(white 0,white 0) content-box,linear-gradient(white 0,white 0);
                    -webkit-mask:linear-gradient(white 0,white 0) content-box,linear-gradient(white 0,white 0);
                    mask-composite:exclude;
                    -webkit-mask-composite:xor;
                }
        }
        
        

        @media(min-width:800px){
            footer,main,header{
                padding-left:15vw;
                padding-right:15vw;
            }
        }
       
    </style>

    {{-- yield css --}}
     @yield('css')
     {{-- stack css --}}
     @stack('css')
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
    <header>
      
       
    </header>
    <main>
        
        {{-- yield main --}}
        @yield('main')
    </main>
    <footer>
        {{-- new nav link --}}
        <div onclick="Redirect('{{ url('users/dashboard') }}',this)" class="column g-5">
            <span>
                <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M20 20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V11L1 11L11.3273 1.6115C11.7087 1.26475 12.2913 1.26475 12.6727 1.6115L23 11L20 11V20ZM8 15V17H16V15H8Z"></path></svg>

            </span>
            <small>Home</small>
        </div>
          {{-- new nav link --}}
        <div onclick="Redirect('{{ url('users/products/active') }}',this)" class="column g-5">
            <span>
                <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4 3H20L22 7V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V7.00353L4 3ZM13 14V10H11V14H8L12 18L16 14H13ZM19.7639 7L18.7639 5H5.23656L4.23744 7H19.7639Z"></path></svg>

            </span>
            <small>My Products</small>
        </div>
          {{-- new nav link --}}
        <div onclick="Redirect('{{ url('users/invite') }}',this)" class="column g-5">
            <span>
                <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4 19H20V14H22V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V14H4V19ZM12 10H9C7.00442 10 5.23638 10.9742 4.14556 12.473C4.85831 8.78512 8.10391 6 12 6V2L20 8L12 14V10Z"></path></svg>

            </span>
            <small>Invite</small>
        </div>
          {{-- new nav link --}}
        <div onclick="Redirect('{{ url('users/profile') }}',this)" class="column g-5">
            <span>
             <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z"></path></svg>

</span>
            <small>Profile</small>
        </div>
    </footer>
  {{-- yield js --}}
    @yield('js')
    {{-- stack js --}}
    @stack('js')
    
</body>
</html>