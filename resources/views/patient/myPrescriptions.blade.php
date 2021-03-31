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
                    <button type="button" class="btn text-success btn-tool" aria-expanded="true" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn text-danger btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body collapse">
                  <div class="row">
                    <div class="col-md-6">
                      <h3>Pres info</h3>
                      <h4>Disease: {{$oldpres->disease}}</h4>
                      <h4>Symptoms: {{$oldpres->symptoms}}</h4>
                      
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

                            <td>{{$test->test_report_file_id ? 'file exists' : 'Not Uploaded'}}</td>


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
            <p class="text-center mt-2 text-secondary">Your Have Not Prescribes this patient before.</p>
          @endif

        </div>
      </div>
    </div>
  </section>
@endsection