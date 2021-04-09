@extends('layouts.mob')

@section('content')
  <section class="content pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
 
          <div class="card pt-3">
            <div class="card-body">

              <div class="row">
                <!-- ./col -->
                <div class=" col-5 mx-auto">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner mx-2">
                      {{-- Role -> user -> count --}}
                      <h4>{{($patientUser->patient->appointments->count())}} <i class="fas ml-1 fa-user-md"></i> </h4>

                      <p class="font-weight-bold">Appointments</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-5 mx-auto">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner mx-2">
                      {{-- Role -> user -> count --}}
                      <h4>{{$patientUser->patient->prescriptions->count()}} <i class="fas ml-1 fa-notes-medical"></i> </h4>

                      <p class="font-weight-bold">Prescriptions</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              {{-- ./row --}}
              <div class="row">
                <!-- ./col -->
                <div class=" col-5 mx-auto">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner mx-2">
                      {{-- Role -> user -> count --}}
                      <h4>{{$amount}} tk</h4>

                      <p class="font-weight-bold">Paid total</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-5 mx-auto">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner mx-2">
                      {{-- Role -> user -> count --}}
                      <h4>{{$testReports}} <i class="far ml-1 fa-building"></i> </h4>

                      <p class="font-weight-bold">Test uploaded</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              {{-- ./row --}}
            </div>
          </div>

          {{-- @if ($patientUser->patient->appointments->checking->count()>0) --}}
          <div class="card pt-3">
            <div class="card-body">
              <div class="table-responsive"> 
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th scope="col">BP_UP</th>
                      <th scope="col">BP_Down</th>
                      <th scope="col">Breathing</th>
                      <th scope="col">Heart rate</th>
                      <th scope="col">Time</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($patientUser->patient->appointments as $appointment)
                    <tr class="text-justified">
                      <td>{{$appointment->checking->BP_up}}</td>
                      <td>{{$appointment->checking->BP_down}}</td>
                      <td>{{$appointment->checking->Breathing_status}}</td>
                      <td>{{$appointment->checking->Heart_rate}}</td>
                      <td>{{$appointment->checking->created_at->diffForHumans()}}</td>
                    </tr>
                  @endforeach  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {{-- @else
            <P>You don't have any Checking.</P>
          @endif --}}
        </div>
      </div>
    </div>
  </section>
@endsection