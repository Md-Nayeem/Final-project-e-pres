@extends('layouts.solution')
@section('content')
<section class="content pt-4"> 
  @php
      $user = Auth::user();
  @endphp
  {{-- <a class="btn btn-info" href="dc/{{$user->id}}/edit">Edit</a> --}}
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8 mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Appointment</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            Here will be the Appointment system.
          </div>
          <div class='card-footer text-center'>
            End of the Appointment.
          </div>
          
        </div>
        <!-- /.card -->
        @include('includes.form_error')
      </div>
    </div>
  </div>

</section>
@endsection