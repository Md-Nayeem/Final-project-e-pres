@extends('layouts.solution')

@section('content')
<section class="content pt-4">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->

        
        <h3>User info</h3>
        <div class="row">
          
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{$userDoc->doctor->prescriptions->count()}} <i class="fas ml-1 fa-file-prescription"></i></i></h3>

                <p>Prescriptions</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{$userDoc->doctor->staffs->count()}} <i class="fas fa-users-cog ml-2 nav-icon"></i>  </h3>

                <p>My Staffs</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{$userDoc->doctor->prescriptions->groupBy('patient_id')->count()}} <i class="fas fa-user-injured ml-2 nav-icon"></i></h3>

                <p>My Patients</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class=" ml-5 col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>৳ {{$userDoc->doctor->visit_fees}} </h3>

                <p>visit fee (Current)</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="card ml-2">
            <div class="card-header bg-info">
              <div class="card-title">Change visit fees</div>
            </div>
            <div class="card-body">


              {{-- {!! Form::model($userDoc->doctor,['method'=>'POST', 'action' => 'App\Http\Controllers\DoctorPrescriptionController@update']) !!} --}}
              {!! Form::model($userDoc->doctor,['route' => ['dc-pres.update', $userDoc->doctor->id] , 'method'=>'PATCH']) !!}
              
                <div class='form-group'>
                  {{-- {!! Form::label('visit_fees', 'New Amount: ')!!} --}}
                  {!! Form::text('visit_fees',null, ['class'=>'form-control','placeholder'=>'New Amount'])!!}
                </div>
              <div class='text-center'>
                {!! Form::submit('Update',['class'=>' btn btn-sm mb-1 btn-success'])!!}
              </div>
              {!!Form::close()!!}


            </div>
          </div>








        </div><!-- ./row -->






        <!-- /.row -->
        <h3>Other info</h3>

        {{-- Prescription, Appointment, Scedules --}}





        <div class="row">
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                <h3>{{$userDoc->doctor->appointments->count()}} <i class="fas ml-1 fa-calendar-day"></i></h3>

                <p>Appointments</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{$userDoc->doctor->workingdays->count()}} <i class="far ml-1 fa-calendar-alt"></i> </h3>

                <p>Days Scheduled</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          
        </div>
        <!-- /.row -->

        <h3>Economy</h3>

        <div class="row">
          
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{$amount}} tk</i></h3>

                <p>Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          
        </div>


  </div>
</section>
@endsection