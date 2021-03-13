@extends('layouts.solution')
@section('content')
<section class="content pt-4"> 
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-7 mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">New Staff</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\AdminStaffController@store', 'files' => true]) !!}
            <div class='form-group'>
              {!! Form::label('name', 'Name: ')!!}
              {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'name'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('email', 'Email: ')!!}
              {!! Form::email('email',null, ['class'=>'form-control','placeholder'=>'email'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('phone', 'Phone: ')!!}
              {!! Form::text('phone',null, ['class'=>'form-control','placeholder'=>'phone number'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('password', 'Password: ')!!}
              {!! Form::password('password',['class'=>'form-control','placeholder'=>'password'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('Shift', 'Shift: ')!!}
              {!! Form::select('shift_id', ['' => '--Select Shift--'] + $shifts, 0, ['class'=>'form-control'])!!}
            </div>  
            <div class="form-group">
              {!! Form::label('Qualification', 'Qualification: ')!!}
              {!! Form::textarea('qualification',null, ['class'=>'form-control','rows'=>3])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('Experience', 'Experience: ')!!}
              {!! Form::number('experience',1, ['class'=>'form-control'])!!}
            </div>  
            
            <div class='form-group'>
              {!! Form::label('photo_id', 'Photo: ')!!}
              {!! Form::file('photo_id',['class'=>'custom-control'])!!}
            </div>
          </div>
          <div class='card-footer text-center'>
            {!! Form::submit('Create',['class'=>'btn btn-primary w-50'])!!}
          </div>
          {!!Form::close()!!}
        </div>
        <!-- /.card -->
        @include('includes.form_error')
      </div>
    </div>
  </div>
</section>
@endsection