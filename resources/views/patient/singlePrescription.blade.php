@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
 
                
          {{-- Patient test | Medicine | Next visit time --}}
          @if ($singlePresdata->count())

            <div class="card bg-light">
              <div class="card-header">
                <h6 class="card-title">Date: {{$singlePresdata->created_at->toFormattedDateString()}} | <span class="ml-3 font-italic"> Disease: {{$singlePresdata->disease}}</span></h6> 
                
              </div>
              <div class="card-body">
                <h4>Session: {{$singlePresdata->created_at->isoFormat('MMM Do')}} - {{\Carbon\Carbon::parse($singlePresdata->end_date)->isoFormat('MMM Do Y') }} </h4>
                <div class="row">
                  <div class="col-md-6">
                    <h3>By: {{$singlePresdata->doctor->user->name}} | {{$singlePresdata->doctor->department->name}}</h3>
                    <h4>Pres info  
                      
                    
                      @if ($singlePresdata->private == 1)
                        <a class="btn btn-primary float-right ml-2 btn-sm" href="{{ route('patient-pres.createPDF',['createPDF'=>$singlePresdata->id]) }}">Export to PDF</a> <a class="btn btn-warning btn-sm float-right"  href="{{route('patient-pres.edit',['patient_pre'=>$singlePresdata->id])}}">Make Public</a>
                        @else
                        <a class="btn btn-primary float-right ml-2 btn-sm" href="{{ route('patient-pres.createPDF',['createPDF'=>$singlePresdata->id]) }}">Export to PDF</a> <a class="btn btn-success btn-sm float-right"  href="{{route('patient-pres.edit',['patient_pre'=>$singlePresdata->id])}}">Make Private</a>
                      @endif


                    </h4>
                    <h5>Disease: {{$singlePresdata->disease}}</h5>
                    <h5>Symptoms: {{$singlePresdata->symptoms}}</h5>
                    
                  </div>
                  <div class="col-md-6">
                    <h4>Checkup Info</h4>
                    <p>Bp Up: {{$singlePresdata->checking->BP_up}}</p>
                    <p>Bp Down: {{$singlePresdata->checking->BP_down}}</p>
                    <p>Breathing status: {{$singlePresdata->checking->Breathing_status}}</p>
                    <p>Heart rate: {{$singlePresdata->checking->Heart_rate}}</p>
                  </div>
                </div>
                <hr class="hr_medi_info">
                <div class="row mx-auto ">
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
                <div class="row">
                  <h5 class="">Procedure: &nbsp;</h5> <br>
                  <p> <q> {{$singlePresdata->procedure}} </q></p>
                </div>
                <hr class="hr_medi_info">
                <div class="row">
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


                          

                          {{-- <td>{{$test->test_report_file_id ? 'file exists' : 'Not Uploaded'}}</td> --}}
                          <td>
                            @if ($test->testReport)
                          
                            {{-- <a href="#" class="btn btn-sm btn-danger" >Del</a> --}}
                            
                            <form method="post" action="/patient-pres/{{$test->testReport->id}}">
                              <a href="/img/test/{{$test->testReport ? $test->testReport->path : 'doctor.png'}}" class="btn btn-success btn-sm">view</a>
                              <input type="hidden" name="_method" value="DELETE"> 
                              @csrf
                              <input type="submit" value="Del" class="btn btn-sm btn-danger">
                            </form>


                          
                            @else
                            {{-- {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\PatientAppointmentPrescriptionController@store', 'files' => true]) !!} --}}
                            {!! Form::model($test,['route' => ['patient-pres.update', $test->id] , 'method'=>'PATCH',  'files' => true]) !!}
                            <div class='form-group text center'>

                              {{-- {!! Form::label('photo_id', 'Photo: ')!!} --}}
                              {{-- {!! Form::hidden('test_id',$test->id)!!} --}}

                              {!! Form::file('photo_id',['class'=>'custom-control w-75 mx-auto'])!!}
                            </div>
                            <div class='text-center'>
                              {!! Form::submit('Upload',['class'=>'btn btn-primary btn-sm'])!!}
                            </div>
                            {!!Form::close()!!}
                              
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
              <div class="card-footer">
                <p>Next visit: {{$singlePresdata->next_visit}} </p> 
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