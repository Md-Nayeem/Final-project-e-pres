@extends('layouts.mob')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@endsection

@section('content')

  {{-- <p class="text-white"> Hello world</p> --}}
  @if ($oldprescriptionData->count())
  <section class="timeline-area">
    @foreach ($oldprescriptionData as $oldpres)
        <div class="timelinediv">
          <h4>Doctor: {{$oldpres->doctor->user->name}}  </h4>
          <h5>Issue: {{$oldpres->disease}} </h5>  
          {{-- here might be  --}}
          @if ($oldpres->order->latest('id')->first()->status == "Processing")
            <h6>Status: <span class="badge badge-success"> Paid </span>| Amount {{$oldpres->order->amount}} tk</h6>
          @else
            <h6>Status: <span class="badge badge-warning"> Not Paid </span> </h6>
          @endif
          <h6>Session: {{\Carbon\Carbon::parse($oldpres->created_at)->isoFormat('MMM Do')}} -  {{ \Carbon\Carbon::parse($oldpres->end_date)->isoFormat('MMM Do YY')}}</h6>
        </div>
      @endforeach
    </section>
  @else
  <div class="text-center mt-4">
    <h5 class="text-white">
      You did not visited any doctor's yet 
    </h4>
  </div>
  @endif

@endsection


