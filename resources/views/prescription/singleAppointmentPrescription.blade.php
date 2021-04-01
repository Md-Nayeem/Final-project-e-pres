@extends('layouts.solution')
@section('content')
<section class="content pt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">


        @if ($singlePresdata->count())

            <div class="card bg-light">
              <div class="card-header">
                <h6 class="card-title">Date: {{$singlePresdata->created_at->toFormattedDateString()}} | <span class="ml-3 font-italic"> Disease: {{$singlePresdata->disease}}</span></h6> 
                
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    @php
                        $patientUser = App\Models\User::findOrFail($singlePresdata->patient->user_id)
                    @endphp
                    <h3>Patient Info</h3>
                    <h4>Name: {{$patientUser->name}}</h4>
                    <h4>Age: {{$singlePresdata->patient->age}}</h4>
                    <h4>Email: {{$patientUser->email}}</h4>
                    <h4>Phone: {{$patientUser->phone}}</h4>                    
                  </div>
                  <div class="col-md-6">
                    <img src="/img/profile/{{$patientUser->profilePhoto ? $patientUser->profilePhoto->path : 'anonymous.jpg'}}" height="150px" width="150px" alt="patient's profile picture" class="img-rounded" alt="patient Image">
                  </div>
                </div>

                <hr>
                
                <div class="row">
                  <div class="col-md-6">
                    <h3>Pres info</h3>
                    <h4>Disease: {{$singlePresdata->disease}}</h4>
                    <h4>Symptoms: {{$singlePresdata->symptoms}}</h4>
                    
                  </div>
                  <div class="col-md-6">
                    <h3>Checkup Info</h3>
                    <p>Bp Up: {{$singlePresdata->checking->BP_up}}</p>
                    <p>Bp Down: {{$singlePresdata->checking->BP_down}}</p>
                    <p>Breathing status: {{$singlePresdata->checking->Breathing_status}}</p>
                    <p>Heart rate: {{$singlePresdata->checking->Heart_rate}}</p>
                  </div>
                </div>
                <hr>
                <div class="row mx-auto mt-4">
                  <h4 class="mx-auto">Medicines</h4>
                    @php
                      //collection of the medicines under same pres
                      $medicines = $singlePresdata->medicine;
                      
                      $mednum = 1;
                    @endphp
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Medicine Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Days</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($medicines as $medi)
                          <tr>
                            <th scope="row">{{$mednum}}</th>
                            <td>{{$medi->medicine_name}}</td>
                            <td>{{$medi->quantity}}</td>
                            <td>{{$medi->days}}</td>
                          </tr>
                            @php
                              $mednum++;
                            @endphp
                          @endforeach
                        </tbody>
                      </table>
                </div>
                <hr>
                <div class="row mt-4">
                  <div class="col-md-10 mx-auto text-center">
                    <h4 class="mx-auto">Test</h4>
                    @php
                      //collection of the medicines under same pres
                      // $medicines = $singlePresdata->medicine;
                      $tests = $singlePresdata->tests;
                      
                      $testnum = 1;
                    @endphp
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Test Name</th>
                          <th scope="col">Report</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tests as $test)
                        <tr>
                          <th scope="row">{{$testnum}}</th>
                          <td>{{$test->test_name}}</td>


                        
                          <td>
                            @if ($test->testReport)
                              <a href="/img/test/{{$test->testReport ? $test->testReport->path : 'doctor.png'}}" class="btn btn-success btn-sm">view</a>
                            @else
                              <p>Not uploaded</p>    
                            @endif

                            


                          </td>
                          


                        </tr>
                          @php
                            $testnum++;
                          @endphp
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer collapse">
                <p>Next visit:{{$singlePresdata->next_visit}} </p> 
              </div>
            </div>

            

                
          
          @else
            @php
              return redirect()->back();
            @endphp
          @endif



      </div>
    </div>
  </div>
</section>



@endsection