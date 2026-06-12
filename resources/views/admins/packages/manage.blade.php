@extends('layout.admins.app')
@section('title')
    Manage Packages
@endsection
@section('main')
    <section class="w-full column g-10">
      {{-- analytic --}}
        <div class="w-full p-20 row g-10 bg-light br-primary" style="border:1px solid var(--rgt-01)">
            <div class="h-50 perfect-square br-primary column align-center justify-center" style="border:1px solid #4caf50;background:rgba(0,255,0,0.1);color:#4caf50;">
<svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="30" width="30"><path d="M5 3C4.5313 3 4.12549 3.32553 4.02381 3.78307L2.02381 12.7831C2.00799 12.8543 2 12.927 2 13V20C2 20.5523 2.44772 21 3 21H21C21.5523 21 22 20.5523 22 20V13C22 12.927 21.992 12.8543 21.9762 12.7831L19.9762 3.78307C19.8745 3.32553 19.4687 3 19 3H5ZM19.7534 12H15C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12H4.24662L5.80217 5H18.1978L19.7534 12Z"></path></svg>
            </div>
            <div class="column g-5">
                <span>Total Packages</span>
                <strong class="font-1 font-weight-900">{{ number_format($total) }}</strong>
            </div>
        </div>
        {{-- packages --}}
        @if ($packages->isEmpty())
            @include('components.utilities',[
                'empty' => true,
                'text' => 'No Package Available'
            ])
        @else
           <div class="w-full grid pc-grid-2 g-10 place-center">
             @foreach ($packages as $data)
                <div class="p-20 w-full br-primary g-10 column bg-light" style="border:1px solid var(--rgt-01)">
                   {{-- new row --}}
                    <div style="border-bottom:1px dashed var(--rgt-01);padding-bottom:10px;" class="row space-between w-full g-10">
                     <img style="box-shadow:0 0 10px rgba(0,0,0,0.3)" src="{{ asset('packages/'.$data->photo.'') }}" alt="Product photo" class="w-50 perfect-square no-shrink br-primary">
                  
                     <div class="column m-right-auto g-5">
                       <div class="w-fit p-5 p-x-10 br-5 no-select" style="background:var(--primary-01);"><span>{{ $data->uniqid }}</span></div>
                   <strong class="font-1 font-weight-900">{{ $data->name }}</strong>
                           </div>
                          
                           <div class="status {{ $data->status == 'active' ? 'green' : 'gold' }}">{{ $data->status }}</div>
                   </div>
                   {{-- new row --}}
                   <div class="row w-full g-10 space-between">
                    <div style="text-align:start;" class="column g-5">
                        <small class="opacity-07">Package Price/Cost</small>
                        <strong>&#8358;{{ number_format($data->cost,2) }}</strong>
                    </div>
                     <div style="text-align:end;" class="column g-5">
                        <small class="opacity-07">Validity</small>
                        <strong>{{ number_format($data->validity) }} Days</strong>        
                    </div>
                   </div>
                   {{-- new row --}}
                   <div class="row w-full g-10 space-between">
                    <div style="text-align:start;" class="column g-5">
                        <small class="opacity-07">Daily Earning</small>
                        <strong>&#8358;{{ number_format($data->earning,2) }}</strong>
                    </div>
                     <div style="text-align:end;" class="column g-5">
                         <small class="opacity-07">Total Earning</small>
                        <strong>&#8358;{{ number_format($data->validity * $data->earning,2) }}</strong>
                    </div>
                   </div>
                   {{-- new row --}}
                   <div class="row w-full g-10 space-between">
                    <div style="text-align:start;" class="column g-5">
                        <small class="opacity-07">Available</small>
                        <strong>{{ number_format($data->available) }}</strong>
                    </div>
                     <div style="text-align:end;" class="column g-5">
                        <small class="opacity-07">Total Purchased</small>
                        <strong>{{ number_format($data->purchased ?? 0) }} Units</strong>
                    </div>
                   </div>
                     {{-- new row --}}
                   <div class="row w-full g-10 space-between">
                    <div style="text-align:start;" class="column g-5">
                        <small class="opacity-07">Last Updated</small>
                        <strong>{{ $data->updated_frame }}</strong>
                    </div>
                     <div style="text-align:end;" class="column g-5">
                        <small class="opacity-07">Added</small>
                        <strong>{{ $data->date_frame }}</strong>
                    </div>
                   </div>
                   {{-- new row --}}
                   <div style="border-top:1px dashed var(--rgt-01);padding-top:10px;" class="row w-full g-10 align-center space-between">
                    <button onclick="window.location.href='{{ url('admins/package/edit?id='.$data->id.'') }}'" class="btn-green-3d">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M224,128v80a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h80a8,8,0,0,1,0,16H48V208H208V128a8,8,0,0,1,16,0Zm5.66-58.34-96,96A8,8,0,0,1,128,168H96a8,8,0,0,1-8-8V128a8,8,0,0,1,2.34-5.66l96-96a8,8,0,0,1,11.32,0l32,32A8,8,0,0,1,229.66,69.66Zm-17-5.66L192,43.31,179.31,56,200,76.69Z"></path></svg>
                         Edit
                    </button>
                    <button onclick="ShowDeleteModal('{{ $data->id }}')" class="btn-red-3d">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM112,168a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm0-120H96V40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8Z"></path></svg>
                         Delete
                    </button>
                   </div>
                   {{-- new row --}}
                   <div class="row align-center space-between">
                     <button onclick="window.location.href='{{ url('admins/packages/investment/records?package_id='.$data->id.'') }}'" class="btn-primary-3d">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M230.14,58.87A8,8,0,0,0,224,56H62.68L56.6,22.57A8,8,0,0,0,48.73,16H24a8,8,0,0,0,0,16h18L67.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,160,204a28,28,0,1,0,28-28H91.17a8,8,0,0,1-7.87-6.57L80.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,230.14,58.87ZM104,204a12,12,0,1,1-12-12A12,12,0,0,1,104,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,200,204Z"></path></svg>
                        View Purchase History
                    </button>
                   </div>
                </div>
            @endforeach
           </div>
           @if ($packages->lastPage() > 1)
               @include('components.utilities',[
                'paginate' => true,
                'data' => $packages
               ])
           @endif
        @endif
    </section>
    {{-- delete modal --}}
    <section class="modal delete">
        <div class="child column align-center g-10 text-center">
            {{-- new row --}}
            <div class="w-50 perfect-square no-shrink circle bg-red c-white column align-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="30" width="30"><path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM112,168a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm0-120H96V40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8Z"></path></svg>

            </div>
            {{-- new row --}}
            <strong class="font-size-1">Delete this Package</strong>
            {{-- new row --}}
            <span>Are you sure you want to delete this package?</span>
            {{-- new row --}}
            <span class="c-red"> Units already purchased won't be affected. This action cannot be undone</span>
            {{-- new row --}}
            <div class="w-full row g-10 align-center space-between">
                <div onclick="this.closest('.modal').classList.remove('active');" class="h-40 no-select pointer br-5 row align-center justify-center bg-black c-white p-10 w-full" style="border:1px solid var(--rgt-10);color:var(--rgt-10)">No, Cancel</div>
             <div onclick="window.location.href='{{ url('admins/package/delete?id=') }}' + this.dataset.id" class="h-40 confirm-delete br-5 no-select pointer bg-primary primary-text row align-center justify-center p-10 w-full">Yes, Delete</div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script class="js">
        function ShowDeleteModal(id){
            document.querySelector('.modal.delete .confirm-delete').dataset.id=id;
            document.querySelector('.modal.delete').classList.add('active');
        }
    </script>
@endsection