@extends('layout.users.app')
@section('title')
    Transaction History
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

                             
                    }

                    &.body{
                        padding-top:0;

                           .analytics{
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
    </style>
@endsection
@section('main')
    <section class="w-full column">
        <section class="section title">
            <div class="row w-full g-10 align-center space-between">
               <i onclick="Redirect('{{ url()->previous() }}')" class="row back-icon pointer align-center h-fit">

                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10.8284 12.0007L15.7782 16.9504L14.364 18.3646L8 12.0007L14.364 5.63672L15.7782 7.05093L10.8284 12.0007Z"></path></svg>
                </i>
                <span class="font-weight-600 block font-1">Transaction Records</span>
                <span></span>
           
            </div>
        </section>
        {{-- new section /body --}}
        <section class="section body">
            <div class="analytics max-w-500 m-x-auto column g-5">
                <span>Total Transactions</span>
                <strong class="desc">{{ number_format($total) }}</strong>
            </div>

            @if ($trx->isEmpty())
                @include('components.utilities',[
                    'empty' => true,
                    'text' => 'No Transaction Found'
                ])
            @else
                <div style="transform:translateY(-30px);" class="w-full pc-grid-3 g-10 place-center grid">
                    @foreach ($trx as $data)
                        <div style="box-shadow: 0 0 10px rgba(0,0,0,0.1)" class="w-full g-10 column g-10 br-10 p-20 bg-light">
                            {{-- new row --}}
                            <div style="border-bottom:1px solid var(--rgt-01);padding-bottom:10px;" class="row w-full g-10 align-center space-between">
                               {{-- new column --}}
                                <div class="column g-5">
                                    <small class="opacity-07">Transaction ID</small>
                                    <span class=" font-size-09">{{ $data->uniqid }}</span>
                                </div>
                                 {{-- new column --}}
                                <div class="column text-end g-5">
                                    <small class="opacity-07">Amount</small>
                                    <span class="font-weight-900 font-size-1 {{ $data->class == 'credit' ? 'c-green': 'c-red' }}">{{ $data->class == 'credit' ? '+' : '-' }}{{ $currency.number_format($data->amount,2) }}</span>
                                </div>
                            </div>
                             {{-- new row --}}
                            <div style="border-bottom:1px solid var(--rgt-01);padding-bottom:10px;" class="row w-full g-10 align-center space-between">
                               {{-- new column --}}
                                <div class="row opacity-07 align-center g-5">
                                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM13 12H17V14H11V7H13V12Z"></path></svg>

                                    <span>{{ $data->frame }}</span>
                                </div>
                                 {{-- new column --}}
                                <div class="column g-5">
                                    <div class="status {{ $data->status == 'success' ? 'green' : ($data->status == 'pending' ? 'gold' : 'red') }}">{{ $data->status }}</div>
                                </div>
                            </div>
                             {{-- new row --}}
                            <div class="row w-full g-10 align-center space-between">
                               {{ $data->title }}
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($trx->lastPage() > 1)
                    @include('components.utilities',[
                        'data' => $trx,
                        'paginate' => true
                    ])
                @endif
            @endif
        </section>
    </section>
@endsection