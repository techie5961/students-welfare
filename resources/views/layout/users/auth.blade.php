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
{{-- yield css --}}
     @yield('css')
    <title>{{ config('app.name') }} || Users || @yield('title') </title>
    <style>
        main{
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        form{
           position:relative;
            padding: 20px;
            border-radius:10px;
            background:hsl(var(--primary-hsl),70%,10%);

                    
                    &::before{
                        content:'';
                        position:absolute;
                        inset:0;
                        background:linear-gradient(to bottom right,var(--rgt-05),transparent,var(--rgt-05));
                        border-radius:inherit;
                        mask:linear-gradient(white 0,white 0) content-box,linear-gradient(white 0,white 0);
                        -webkit-mask:linear-gradient(white 0,white 0) content-box,linear-gradient(white 0,white 0);
                        mask-composite:exclude;
                        -webkit-mask-composite:xor;
                        padding:1px;
                        z-index:50;
                    }

        }

        form > div{
          position:relative;
          z-index:100;
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
    <header>

    </header>
    <main>
        {{-- yield main --}}
        @yield('main')
    </main>
    <footer>

    </footer>
  @include('components.utilities',[
    'vite_js' => true
  ])
  {{-- yield js --}}
    @yield('js')
</body>
</html>