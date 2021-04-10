@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resgister as Patient</div>

                <div class="card-body">


                  {{-- {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\PatientController@store', 'files' => true]) !!} --}}
                  {!! Form::open(['method'=>'POST', 'route' => 'register', 'files' => true]) !!}
                  <form method="POST" action="{{ route('register') }}">
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
                      {!! Form::label('password_confirmation', 'Confirm Password: ')!!}
                      {!! Form::password('password_confirmation',['class'=>'form-control ','placeholder'=>'password'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('age', 'Age: ')!!}
                      {!! Form::number('age',null, ['class'=>'form-control'])!!}
                    </div>  
                    <div class='form-group'>
                      {!! Form::label('gender', 'Gender: ')!!}
                      {!! Form::select('gender', ['' => '--Select --','M'=>'Male','F'=>'Female','O'=>'Other'] , 0, ['class'=>'form-control'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('blood_group', 'Blood Group: ')!!}
                      {!! Form::select('blood_group', ['' => '--Select --','O+'=>'O+','O-'=>'O-','A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-'] , 0, ['class'=>'form-control'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('height', 'Height: ')!!} <small class="text-muted">In CM</small>
                      {!! Form::text('height',null, ['class'=>'form-control','placeholder'=>'150'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('weight', 'Weight: ')!!} <small class="text-muted">In Kg</small>
                      {!! Form::text('weight',null, ['class'=>'form-control','placeholder'=>'50kg'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('allergies', 'Allergies: ')!!} <small class="text-muted">(Optional)</small>
                      {!! Form::text('allergies',null, ['class'=>'form-control','placeholder'=>'Red Meat, Peanuts...'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('chro_name', 'Chronic condition / illness: ')!!} <small class="text-muted">(Optional)</small>
                      {!! Form::text('chro_name',null, ['class'=>'form-control','placeholder'=>'Diabetes, Asthma...'])!!}
                    </div>
                    <div class='form-group'>
                      {!! Form::label('chro_medicine', 'Chronic condition / illness: ')!!} <small class="text-muted">(Optional)</small>
                      {!! Form::text('chro_medicine',null, ['class'=>'form-control','placeholder'=>'Insulin...'])!!}
                    </div>
                    <div class='form-group'> <small class="text-muted">(Optional)</small>
                      {!! Form::label('photo_id', 'Photo: ')!!}
                      {!! Form::file('photo_id',['class'=>'custom-control'])!!}
                    </div>

                  </div>


                  <div class='card-footer text-center'>
                    {!! Form::submit('Create',['class'=>'btn btn-primary w-50'])!!}
                  </div>
                  {!!Form::close()!!}



                </div>
                @include('includes.form_error')
            </div>
        </div>
    </div>
</div>
@endsection
