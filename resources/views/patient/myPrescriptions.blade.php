@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
 
                
          {{-- Patient test | Medicine | Next visit time --}}
          @if ($oldprescriptionData->count())

            @foreach ($oldprescriptionData as $oldpres)


            
              <div class="card bg-light">
                <div class="card-header">
                  <h6 class="card-title">Date: {{$oldpres->created_at->toFormattedDateString()}} | <span class="font-italic"> Disease: {{$oldpres->disease}}</span></h6> 
                  <div class="card-tools">
                    
                    @if($oldpres->order)

                      @if ($oldpres->order->latest('id')->first()->status == "Processing")
                        <button type="button" class="btn text-success btn-tool" aria-expanded="true" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn text-danger btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                      @else
                      {{-- if order failed previously--}}
                        <a class="btn btn-warning" href="{{route('payment',['payment'=>$oldpres->id])}}">Pay</a>
                      @endif

                    @else
                    {{-- if no transaction --}}
                      <a class="btn btn-warning" href="{{route('payment',['payment'=>$oldpres->id])}}">Pay</a>
                    @endif
                  </div>
                </div>
                <div class="card-body collapse">
                  <h4>Session: {{$oldpres->created_at->isoFormat('MMM Do')}} - {{\Carbon\Carbon::parse($oldpres->end_date)->isoFormat('MMM Do Y') }} </h4>
                  <div class="row">
                    <div class="col-md-6">
                      <h3>By: {{$oldpres->doctor->user->name}} | {{$oldpres->doctor->department->name}}</h3>
                      <h3>Pres info 
                        @if ($oldpres->private == 1)
                        <a class="btn btn-primary float-right ml-2 btn-sm" href="{{ route('patient-pres.createPDF',['createPDF'=>$oldpres->id]) }}">Export to PDF</a> <a class="btn btn-warning float-right btn-sm"  href="{{route('patient-pres.edit',['patient_pre'=>$oldpres->id])}}">Make Public</a>
                        @else
                        <a class="btn btn-primary float-right ml-2 btn-sm" href="{{ route('patient-pres.createPDF',['createPDF'=>$oldpres->id]) }}">Export to PDF</a> <a class="btn btn-success float-right btn-sm" href="{{route('patient-pres.edit',['patient_pre'=>$oldpres->id])}}">Make Private</a>
                        @endif
                      </h3>
                      <h5>Disease: {{$oldpres->disease}}</h5>
                      <h5>Symptoms: {{$oldpres->symptoms}}</h5>
                      
                    </div>
                    <div class="col-md-6">
                      <h3>Checkup Info</h3>
                      <p>Bp Up: {{$oldpres->checking->BP_up}}</p>
                      <p>Bp Down: {{$oldpres->checking->BP_down}}</p>
                      <p>Breathing status: {{$oldpres->checking->Breathing_status}}</p>
                      <p>Heart rate: {{$oldpres->checking->Heart_rate}}</p>
                    </div>
                  </div>
                  <hr class="hr_medi_info">
                  <div class="row mx-auto ">
                    <h4 class="mx-auto">Medicines</h4>
                      @php
                        //collection of the medicines under same pres
                        $medicines = $oldpres->medicine;
                        
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
                    <p> <q> {{$oldpres->procedure}} </q></p>
                  </div>
                  <hr class="hr_medi_info">
                  <div class="row">
                    <div class="col-md-10 mx-auto text-center">
                      <h4 class="mx-auto">Test</h4>
                      @php
                        //collection of the medicines under same pres
                        // $medicines = $oldpres->medicine;
                        $tests = $oldpres->tests;
                        
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
                            
                              
                              <form method="post" action="/patient-pres/{{$test->testReport->id}}">
                                <a href="/img/test/{{$test->testReport ? $test->testReport->path : 'doctor.png'}}" class="btn btn-success btn-sm">view</a>
                                <input type="hidden" name="_method" value="DELETE"> 
                                @csrf
                                <input type="submit" value="Del" class="btn btn-sm btn-danger">
                              </form>


                            
                              @else
                              {!! Form::model($test,['route' => ['patient-pres.update', $test->id] , 'method'=>'PATCH',  'files' => true]) !!}
                              <div class='form-group text center'>

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
                <div class="card-footer collapse">
                  <p>Next visit:{{$oldpres->next_visit}} </p> 
                </div>
              </div>

            @endforeach

                
          
          @else
            <p class="text-center mt-2 text-secondary">Your have no prescription.</p>
          @endif

        </div>
      </div>
    </div>
  </section>
@endsection