@extends('layouts.mob')
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
            {!! Form::model($user,['route' => ['pt.update', $user->id] , 'method'=>'PATCH',  'files' => true]) !!}
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
            <div class='form-group'>
              {!! Form::label('age', 'Age: ')!!}
              {!! Form::number('age',$user->patient->age, ['class'=>'form-control'])!!}
            </div>  
            <div class='form-group'>
              {!! Form::label('gender', 'Gender: ')!!}
              {!! Form::select('gender', ['' => '--Select --','M'=>'Male','F'=>'Female','O'=>'Other'] , $user->patient->gender, ['class'=>'form-control'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('blood_group', 'Blood Group: ')!!}
              {!! Form::select('blood_group', ['' => '--Select --','O+'=>'O+','O-'=>'O-','A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-'] , $user->patient->blood_group, ['class'=>'form-control'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('height', 'Height: ')!!} <small class="text-muted">In CM</small>
              {!! Form::text('height',$user->patient->height, ['class'=>'form-control','placeholder'=>'150'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('weight', 'Weight: ')!!} <small class="text-muted">In Kg</small>
              {!! Form::text('weight',$user->patient->weight, ['class'=>'form-control','placeholder'=>'50kg'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('allergies', 'Allergies: ')!!} <small class="text-muted">(Optional)</small>
              {!! Form::text('allergies',$user->patient->allergies, ['class'=>'form-control','placeholder'=>'Red Meat, Peanuts...'])!!}
            </div>
            <div class='form-group'>
              {!! Form::label('Chronic_condition', 'Chronic condition / illness: ')!!} <small class="text-muted">(Optional)</small>
              {!! Form::text('Chronic_condition',$user->patient->chronic_con->name, ['class'=>'form-control','placeholder'=>'Diabetes, Asthma...'])!!}
            </div>
            <div class='form-group'> <small class="text-muted">(Optional)</small>
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