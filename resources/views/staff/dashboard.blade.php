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
                <h3>{{$StaffUser->staff->doctors->count()}} <i class="fas ml-1 fa-user-md"></i></i></h3>

                <p>Doctor</p>
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
                <h3>{{$MyDoctorsAppointments}} <i class="fas ml-1 fa-calendar-day"></i>  </h3>

                <p>Appointments</p>
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
                <h3>{{$visited}} <i class="fas fa-person-booth ml-2 nav-icon"></i></h3>

                <p>Visited</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class=" col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3> {{$notvisited}} <i class="fas fa-house-user ml-2 nav-icon"></i></h3>

                <p>Not Vistied</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div><!-- ./row -->
  </div>
</section>
@endsection