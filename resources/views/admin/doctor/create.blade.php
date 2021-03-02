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
            <h3 class="card-title">Add Doctor</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\AdminUsersController@store', 'files' => true]) !!}
          <div class="card-body">
            <div class='form-group'>
              {!! Form::label('name', 'Name: ')!!}
              {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'name'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('email', 'Email: ')!!}
              {!! Form::email('email',null, ['class'=>'form-control','placeholder'=>'email'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('password', 'Password: ')!!}
              {!! Form::password('password',['class'=>'form-control','placeholder'=>'password'])!!}
            </div>
            {{-- <div class='form-group'>
              {!! Form::label('role', 'Role: ')!!}
              {!! Form::select('role_id', ['' => '--Select Role--'] + $roles, 0, ['class'=>'form-control'])!!}
            </div>  --}}           
            {{-- <div class="form-group">
              {!! Form::label('Status', 'User Status: ')!!}
              <div class="custom-control custom-checkbox">
                {!! Form::checkbox('is_active', '1')!!}
                {!! Form::label('is_active', 'Active')!!}
              </div>
            </div>  --}}
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
      </div>
    </div>
  </div>
</section>
@endsection