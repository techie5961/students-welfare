@extends('layout.users.app')
@section('title')
   My Downlines
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

                                > .analytics{
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
                <span class="font-weight-700 block font-1">My Downlines</span>
               <span></span>
            </div>
             
         
        </section>
        {{-- new section /body --}}
        <section class="section column g-10 body">
            <div class="analytics max-w-500 m-x-auto column g-5">
                <span>Team Size(Level-1)</span>
                <strong class="desc">{{ number_format($team_size) }}</strong>
            </div>
        @if ($referrals->isEmpty())
            @include('components.utilities',[
                'empty' => true,
                'text' => 'No referral yet',
                'icon' => '<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="50" width="50"><path d="M12 10C14.2091 10 16 8.20914 16 6 16 3.79086 14.2091 2 12 2 9.79086 2 8 3.79086 8 6 8 8.20914 9.79086 10 12 10ZM5.5 13C6.88071 13 8 11.8807 8 10.5 8 9.11929 6.88071 8 5.5 8 4.11929 8 3 9.11929 3 10.5 3 11.8807 4.11929 13 5.5 13ZM21 10.5C21 11.8807 19.8807 13 18.5 13 17.1193 13 16 11.8807 16 10.5 16 9.11929 17.1193 8 18.5 8 19.8807 8 21 9.11929 21 10.5ZM12 11C14.7614 11 17 13.2386 17 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5 15.9999C5 15.307 5.10067 14.6376 5.28818 14.0056L5.11864 14.0204C3.36503 14.2104 2 15.6958 2 17.4999V21.9999H5V15.9999ZM22 21.9999V17.4999C22 15.6378 20.5459 14.1153 18.7118 14.0056 18.8993 14.6376 19 15.307 19 15.9999V21.9999H22Z"></path></svg>'
            ])
        @else
            <div style="transform:translateY(-35px)" class="w-full grid place-center g-10 pc-grid-2">
                @foreach ($referrals as $data)
                    <div class="w-full column g-10 bg-light br-10 p-20">
                        {{-- new row --}}
                       <div class="row w-full align-center space-between">
                         <strong class="font-size-1">{{ $data->phone }}</strong>
                        <div class="status {{ $data->status == 'active' ? 'green' : 'red' }}">{{ $data->status }}</div>
                   
                       </div>
                       <hr>
                        {{-- new row --}}
                       <div class="row w-full g-10 align-center">
                        <span class="opacity-07">Registered: </span>
                        <span class="font-weight-500">{{ $data->date }}</span>
                       </div>
                       {{-- new row --}}
                       <div class="row w-full g-10 align-center">
                        <span class="opacity-07">Total Investment: </span>
                        <span class="font-weight-500">{{ $currency.number_format($data->invested,2) }}</span>
                       </div>
                        {{-- new row --}}
                       <div class="row w-full g-10 align-center">
                        <span class="opacity-07">Total Commission: </span>
                        <span class="font-weight-500">{{ $currency.number_format($data->commission,2) }}</span>
                       </div>
                    </div>
                @endforeach
            </div>
        @endif
          @if ($referrals->lastPage() > 1)
              @include('components.utilities',[
                'data' => $referrals,
                'paginate' => true
              ])
          @endif

            
        </section>
    </section>

@endsection