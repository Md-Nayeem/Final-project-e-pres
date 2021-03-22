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
            <h3 class="card-title">Prescription System</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            Select Patient AC form .

            {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\DoctorPrescriptionController@findPatient']) !!}
              
              <div class='form-group'>
                {!! Form::label('email', 'Email: ')!!}
                {!! Form::email('email',null, ['class'=>'form-control','placeholder'=>'email'])!!}
              </div>
              <div class='form-group'>
                {!! Form::label('phone', 'Phone: ')!!}
                {!! Form::text('phone',null, ['class'=>'form-control','placeholder'=>'phone number'])!!}
              </div>
              <div class='card-footer text-center'>
                {!! Form::submit('Select',['class'=>'btn btn-primary w-50'])!!}
              </div>
            {!!Form::close()!!}
            
          </div>
          <div class='card-footer text-center'>
            End of the prescription.
          </div>
          
        </div>
        <!-- /.card -->
        @include('includes.form_error')
      </div>
    </div>
  </div>

</section>
@endsection