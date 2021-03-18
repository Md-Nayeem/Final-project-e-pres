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
            <h3 class="card-title">Change Password</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            {!! Form::model($user,['route' => ['user.update', $user->id] , 'method'=>'PATCH']) !!}
            <div class='form-group'>
              {!! Form::label('old_password', 'Old Password: ')!!}
              {!! Form::password('old_password',['class'=>'form-control'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('password', 'Password: ')!!}
              {!! Form::password('password',['class'=>'form-control'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('password_confirmation', 'Confirm Password: ')!!}
              {!! Form::password('password_confirmation',['class'=>'form-control '])!!}
            </div> 
          </div>

          <div class='card-footer text-center'>
            {!! Form::submit('Update',['class'=>'btn btn-primary w-50'])!!}
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