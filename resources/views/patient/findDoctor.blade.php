@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
          <div class="card card-primary">
            <div class="card-hearder">
              <h4 class="card-title">Select doctor from here.</h4>
            </div>
            <div class="card-body">
              <p>Here, will be the search </p>
              

              {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\PatientMobBookingController@search']) !!}
                <div class='form-group'>
                  {!! Form::label('name', 'Name: ')!!}
                  {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'name'])!!}
                </div>
                <div class='form-group'>
                  {!! Form::label('District', 'District: ')!!}
                  {!! Form::select('district_id', ['' => '--Select Districts--'] + $districts, 0, ['class'=>'form-control'])!!}
                </div>
                
                <div class='form-group'>
                  {!! Form::label('Department', 'Department: ')!!}
                  {!! Form::select('department_id', ['' => '--Select Departments--'] + $departments, 0, ['class'=>'form-control'])!!}
                </div>  
                
                <div class='card-footer text-center'>
                  {!! Form::submit('Search',['class'=>'btn btn-primary w-50'])!!}
                </div>
              {!!Form::close()!!}
            </div>






              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection