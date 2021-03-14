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
            <h3 class="card-title">Your Information</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            {!! Form::model($user,['route' => ['dc.update', $user->id] , 'method'=>'PATCH',  'files' => true]) !!}
            <div class='form-group'>
              {!! Form::label('name', 'Name: ')!!}
              {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'name'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('email', 'Email: ')!!}
              {!! Form::email('email',null, ['class'=>'form-control','disabled','placeholder'=>'email'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('phone', 'Phone: ')!!}
              {!! Form::text('phone',null, ['class'=>'form-control','placeholder'=>'phone number'])!!}
            </div>
            {{-- <div class='form-group'>
              {!! Form::label('password', 'Password: ')!!}
              {!! Form::password('password',['class'=>'form-control','placeholder'=>'password'])!!}
            </div> --}}
            <div class='form-group'>
              {!! Form::label('Department', 'Department: ')!!}
              {!! Form::select('department_id', ['' => '--Select Departments--'] + $departments, $user->doctor->department->id, ['class'=>'form-control'])!!}
            </div>  
            <div class="form-group">
              {!! Form::label('Medical Bio', 'Medical Bio: ')!!}
              {!! Form::textarea('med_bio',$user->doctor->med_bio, ['class'=>'form-control','rows'=>3])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('Experience', 'Experience: ')!!}
              {!! Form::number('experience',$user->doctor->experience, ['class'=>'form-control'])!!}
            </div>  
            <div class='form-group'>
              {!! Form::label('District', 'District: ')!!}
              {!! Form::select('district_id', ['' => '--Select Districts--'] + $districts, $user->doctor->district->id, ['class'=>'form-control'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('Office location', 'Office location: ')!!}
              {!! Form::text('office_location',$user->doctor->office_location, ['class'=>'form-control','placeholder'=>'Full address'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('Working days', 'Working days: ')!!}
              {!! Form::text('working_days',$user->doctor->working_days, ['class'=>'form-control','placeholder'=>'Mon-Fri'])!!}
            </div> 
            <div class='form-group'>
              {!! Form::label('Visiting time', 'Visiting time: ')!!}
              {!! Form::text('visit_time',$user->doctor->visit_time, ['class'=>'form-control','placeholder'=>'7pm-10pm'])!!}
            </div> 
            <div class='form-group'>
              {!! Form::label('photo_id', 'Photo: ')!!}
              {!! Form::file('photo_id',['class'=>'custom-control'])!!}
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