@extends('layouts.mob')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@endsection

@section('content')


  @if ($oldprescriptionData)
  <section class="timeline-area">
    @foreach ($oldprescriptionData as $oldpres)
        <div class="timelinediv">
          <h4>Doctor: {{$oldpres->doctor->user->name}}  </h4>
          <h5>Issue: {{$oldpres->disease}} </h5>
          <h6>Session: {{\Carbon\Carbon::parse($oldpres->created_at)->isoFormat('MMM Do')}} -  {{ \Carbon\Carbon::parse($oldpres->end_date)->isoFormat('MMM Do YY')}}</h6>
        </div>
      @endforeach
    </section>
  @else
    You did not visited any doctor's yet 
  @endif

@endsection


