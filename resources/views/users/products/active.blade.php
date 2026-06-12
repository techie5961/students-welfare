@extends('layout.users.app')
@section('title')
    Active Products
@endsection
@section('main')
    <section class="w-full column g-10">
        <div style="background:var(--primary);color:var(--primary-text)" class="w-full br-5 p-15 column g-10">
            <div style="background:rgba(var(--primary-text-rgb),0.2);border:1px solid rgba(var(--primary-text-rgb),0.7)" class="w-full p-10 row align-center g-5">
              <div style="background:rgba(var(--primary-text-rgb),0.2)" class="h-50 w-50 no-shrink circle column align-center justify-center">
           <svg height="50" width="50"  version="1.1" id="L1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><circle fill="none" stroke="currentColor" stroke-width="6" stroke-miterlimit="15" stroke-dasharray="14.2472,14.2472" cx="50" cy="50" r="47"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="5s" from="0 50 50" to="360 50 50" repeatCount="indefinite"/></circle><circle fill="none" stroke="currentColor" stroke-width="1" stroke-miterlimit="10" stroke-dasharray="10,10" cx="50" cy="50" r="39"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="5s" from="0 50 50" to="-360 50 50" repeatCount="indefinite"/></circle><g fill="currentColor"><rect x="30" y="35" width="5" height="30"><animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.1"/></rect><rect x="40" y="35" width="5" height="30"><animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.2"/></rect><rect x="50" y="35" width="5" height="30"><animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.3"/></rect><rect x="60" y="35" width="5" height="30"><animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.4"/></rect><rect x="70" y="35" width="5" height="30"><animateTransform attributeName="transform" dur="1s" type="translate" values="0 5 ; 0 -5; 0 5" repeatCount="indefinite" begin="0.5"/></rect></g></svg>

            </div>  
            <div class="column g-5">
                <strong class="font-1">Active Products</strong>
                <div style="color:orange" class="row g-2 align-center">
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"></path></svg>
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"></path></svg>
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"></path></svg>
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"></path></svg>
                    <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z"></path></svg>

                </div>
            </div>
            </div>
            {{-- new row --}}
            <div style="grid-template-columns:repeat(auto-fit,minmax(100px,1fr))" class="grid overflow-hidden w-full g-10 place-center">
            <div style="max-width:100%;background:rgba(var(--primary-text-rgb),0.2);border:1px solid rgba(var(--primary-text-rgb),0.7)" class="w-full p-10 column g-5">
           <div class="row g-5 align-center">
            <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3 12H5V21H3V12ZM19 8H21V21H19V8ZM11 2H13V21H11V2Z"></path></svg>
             <div class="ws-nowrap text-overflow-ellipsis">Total Products</div>

           </div>
           <div style="max-width:100%" vitecss-marquee="" vitecss-marquee-check="">
            <div class="font-1 font-weight-900">
          {{ number_format($total) }}

            </div>
           </div>
            </div>
            {{-- new --}}
              <div style="max-width:100%;background:rgba(var(--primary-text-rgb),0.2);border:1px solid rgba(var(--primary-text-rgb),0.7)" class="w-full p-10 column g-5">
           <div style="max-width:100%;" class="row g-5 align-center">
            <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M5 3V19H21V21H3V3H5ZM20.2929 6.29289L21.7071 7.70711L16 13.4142L13 10.415L8.70711 14.7071L7.29289 13.2929L13 7.58579L16 10.585L20.2929 6.29289Z"></path></svg>
             <div class="ws-nowrap text-overflow-ellipsis">Total Daily Income</div>
           
           </div>
           <div style="max-width:100%" vitecss-marquee-speed='40' vitecss-marquee="" vitecss-marquee-check="">
            <div class="w-full font-1 font-weight-900">
          {{ $currency.number_format($income,2) }}

            </div>
           </div>
            </div>
            </div>
        </div>
        <strong class="font-1-5">Investment Records</strong>
        <span class="cd"></span>
        @if ($packages->isEmpty())
            @include('components.utilities',[
              'empty' => 'true',
              'text' => 'No package purchased'
            ])
        @else
        <section class="w-full g-10 place-center grid responsive-grid-200px">
              @foreach ($packages as $data)
                 <div style="border:1px solid var(--rgt-02);background:var(--rgt-005);padding:15px;" class="w-full column bg-lightg br-5 g-10">
            {{-- new --}}
         
          <img style="max-height:150px" src="{{ asset('packages/'.$data->package->photo.'') }}" alt="" class="w-full br-5 no-pointer no-select">
               {{-- new row --}}
               <strong class="desc">{{ $data->package->name }}</strong>
               {{-- new row --}}
               <div class="row w-full align-center space-between">
                <span class="opacity-07">Investment Cycle</span>
                <span>{{ number_format($data->package->validity) }} Days</span>
               </div>
               {{-- new row --}}
               <div class="row w-full align-center space-between">
                <span class="opacity-07">Purchase Price</span>
                <span>{{ $currency.number_format($data->package->cost,2) }}</span>
               </div>
 {{-- new row --}}
               <div class="row w-full align-center space-between">
                <span class="opacity-07">Daily Payout</span>
                <span>{{ $currency.number_format($data->package->earning,2) }}</span>
               </div>
               {{-- new row --}}
               <div class="row w-full align-center space-between">
                <span class="opacity-07">Settlement Method</span>
                <span>Daily Repayment</span>
               </div>
               {{-- new row --}}
               <div class="row w-full align-center space-between">
                <span class="opacity-07">Investment Status</span>
                <span style="color:aqua;">In Progress</span>
               </div>
               {{-- new --}}
               <div class="column w-full g-2">
                <div class="roow w-full align-center space-between">
                  {{-- new row --}}
               <div class="row w-full align-center space-between">
                <span class="opacity-07">Project Progress</span>
                <span>{{ (($data->package->validity - $data->cycle)/$data->package->validity)*100 }}%</span>
               </div>
                </div>
  <div style="background:var(--rgt-02)" class="w-full br-1000 h-5 overflow-hidden">
                <div style="background:aqua;width:{{ (($data->package->validity - $data->cycle)/$data->package->validity)*100 }}%;" class="w-full br-1000 h-full"></div>
               </div>
               </div>
             
               {{-- new row --}}
               <div class="w-full countdown row min-h-50 align-center g-10 justify-center bg-primary no-select no-pointer primary-text">
                <span>Next Payout:</span>
                <span>{{ $data->next }}</span>
               </div>
        </div>
            @endforeach
        </section>
        
        @endif
    </section>

    
@endsection
@section('js')
   
@endsection