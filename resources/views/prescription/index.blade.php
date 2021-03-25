@extends('layouts.solution')
@section('content')
<section class="content pt-4"> 
  {{-- <a class="btn btn-info" href="dc/{{$user->id}}/edit">Edit</a> --}}
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-10 mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Prescription System</h3>
            
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            {{-- Here will be the prescription system. --}}

            {{-- <h3>Patient Name: {{$user->name}}</h3>
            <h3>Patient Name: {{$user->id}}</h3> --}}

            <div class="row">
              <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">User Info</a>
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Medical history</a>
                  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">CheckUp</a>
                  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Prescription</a>
                  {{-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Test</a> --}}
                </div>
              </div>
              <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                  {{-- User Info tab --}}
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="row my-3">
                      <div class="col-md-4 mx-auto">
                        <h3 class="inline">Patient Name: <u>{{$patient->name}}</u></h3>
                      </div>
                      <div class="col-md-4 mx-auto">
                        <img src="/img/profile/{{$patient->profilePhoto ? $patient->profilePhoto->path : 'anonymous.jpg'}}" height="100px" width="100px" alt="patient's profile picture" class="img-rounded" alt="patient Image">
                      </div>
                    </div>
                    <div class="row my-3">
                      <div class="col-md-4 mx-auto"><h4>Patient Age: <u>{{$patient->patient->age}}</u></h4></div>
                      <div class="col-md-4 mx-auto"><h4>Height: <u>{{$patient->patient->height}}</u></h4></div>
                    </div>
                    <div class="row my-3 mb-5">
                      <div class="col-md-4 mx-auto"><h4>Weight: <u>{{$patient->patient->weight}}</u></h4></h4></div>
                      <div class="col-md-4 mx-auto"><h4>BMI: <u>{{$patient->patient->BMI}}</u></h4></div>
                    </div>

                  </div>

                  {{-- Medical History tab --}}
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    {{-- Patient test | Medicine | Next visit time --}}
                    @if ($oldprescriptionData->count())

                      @foreach ($oldprescriptionData as $oldpres)
                        <div class="card bg-light">
                          <div class="card-header">
                            <h6 class="card-title">Issue Date: {{$oldpres->created_at->toFormattedDateString()}} | <span class="font-italic"> Disease: {{$oldpres->disease}}</span></h6> 
                            <div class="card-tools">
                              <button type="button" class="btn text-success btn-tool" aria-expanded="false" data-card-widget="collapse">
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
                  

                  {{-- The Checking tab--}}
                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <div class="card-body">
                      @if (!Session::has('checking_id'))
                        <form method="POST" action="{{route('dc-pres.checkdata')}}" >
                          @csrf
                          <div class="form-row">
                            <div class="form-group col-md-4 mx-auto">
                              <input type="text" hidden name="patient_id" id="patient_id" value="{{$patient->patient->id}}">
                              <label for="BP_up">BP Up: </label>
                              <input type="text" name="BP_up" class="form-control" id="BP_up">
                            </div>
                            <div class="form-group col-md-4 mx-auto">
                              <label for="BP_down">BP Down</label>
                              <input type="text" name="BP_down" class="form-control" id="BP_down">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4 mx-auto">
                              <label for="Breathing_status">Breathing status</label>
                              <select id="Breathing_status" name="Breathing_status" class="form-control">
                                <option selected value="Normal">Normal</option>
                                <option value="Heavy">Heavey</option>
                              </select>
                            </div>
                            <div class="form-group col-md-4 mx-auto">
                              <label for="Heart_rate">Heart Rate</label>
                              <input type="text" name="Heart_rate" class="form-control" id="Heart_rate" placeholder="70">
                            </div>
                          </div>   
                          <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary w-50">Add</button>
                          </div>   
                        </form>
                      @endif
                      <p>There is checking session here.</p>


                      
                    </div>
                    
                  </div>

                  {{-- Main Prescription form tab--}}
                  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"> 
                     <div class="row my-3 ">
                      <div class="col-md-6 mx-auto">
                        <h3 class="inline">Patient Name: <b>{{$patient->name}}</b></h3>
                        <h4>Patient Age: <b>{{$patient->patient->age}}</b></h4>
                      </div>
                      <div class="col-md-6 pl-5">
                        <img src="/img/profile/{{$patient->profilePhoto ? $patient->profilePhoto->path : 'anonymous.jpg'}}" height="100px" width="100px" alt="patient's profile picture" class="img-rounded" alt="patient Image">
                      </div>
                      {{-- <div class="col-md-4 mx-auto"></div> --}}

                    </div>                  
                    

                    {{-- general form --}}
                    @if (Session::has('checking_id'))
                      <form method="POST" action="{{route('dc-pres.store')}}">
                        {{-- <div class="form-group">
                          <label for="post_tag">Disease test</label>
                          <input type="post_tag" id="tags" data-role="tagsinput" class="form-control">
                        </div> --}}
                        <input type="hidden" name="patient_id" value="{{$patient->patient->id}}">
                        @csrf
                        <div class="form-group">
                          <label for="disease">Disease</label>
                          <input type="text" class="form-control" id="disease" name="disease" required >
                        </div>
                        <div class="form-group">
                          <label for="symptoms">Symptoms</label>
                          <textarea class="form-control" name="symptoms" id="symptoms" required rows="2"></textarea>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-7">
                            <label for="inputAddress">Medicine</label>
                            <div id="newMedRow"></div> {{-- This will be filled --}}
                            <button id="addMed" type="button" class="btn btn-info">Add Med</button>
                          </div>
                          <div class="form-group col-md-5">
                            <label for="inputAddress">Test</label>
                            <div id="newTestRow"></div> {{-- This will be filled --}}
                            <button id="addTest" type="button" class="btn btn-info">Add Test</button>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="procedure">Procedure to use Medicine</label>
                          {{-- <input type="text" class="form-control" id="inputAddress" placeholder=""> --}}
                          <textarea class="form-control" name="procedure" id="procedure" rows="3"></textarea>
                        </div>
                        <div class="form-row">
                          
                          <div class="form-group col-md-6">
                            <label for="end_date">Session end date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" >
                          </div>
                          <div class="form-group col-md-6">
                            <label for="next_visit">Possible Next visit</label>
                            <input type="date" class="form-control" id="next_visit" name="next_visit" >
                          </div>
                          
                        </div>

                        <div class="form-group">
                          <label for="inputAddress">Signature</label>
                          <input type="text" class="form-control" id="inputAddress" placeholder="">
                        </div>
                          
                        <button type="submit" class="btn btn-primary">Prescribe</button>
                        {{-- <a href="#disease">Focus</a> --}}
                      </form>
                    @else
                      <p>Please CheckUp --<i>{{$patient->name}}</i>-- first</p>   
                    @endif

                  </div>


                 

                  {{-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <form action="">
                      <div class="form-group">
                        <label for="inputAddress">Add Tests</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="type">
                      </div>
                    </form>
                  </div> --}}





                </div>
              </div>
            </div>
            
          </div>
          <div class='card-footer text-center'>
            End of the prescription.
          </div>
          
        </div>
        <!-- /.card -->
        @include('includes.form_error')
      </div>
    </div>
  </div>

</section>
@endsection

@section('script')
    

  <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

  <script type="text/javascript">
        
        // add Med
        $("#addMed").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="medicine[]" class="form-control m-input col-md-4" placeholder="Name" autocomplete="off">';
            html += '<input type="text" name="qty[]" class="form-control m-input col-md-2" placeholder="Qty" autocomplete="off">';
            html += '<input type="text" name="days[]" class="form-control m-input col-md-2" placeholder="Days" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newMedRow').append(html);
        });
        
        
        
        // add row
        $("#addTest").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="test[]" class="form-control m-input" placeholder="Enter tests" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newTestRow').append(html);
        });





        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

@endsection
