@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
 
                
          <div class="card pt-3">
            
            <img class="w-25 mx-auto rounded-circle"  src="/img/profile/{{$doctor->user->profilePhoto ? $doctor->user->profilePhoto->path : 'anonymous.jpg'}}" alt="Doctor Profile picture">
            <div class="card-body text-center">
              <h4 class="">{{$doctor->user->name}}</h4>
              <p class="card-text"> Exp: {{$doctor->experience}}years | Dept: {{$doctor->department->name}}</p>
              <p class="card-text"> {{$doctor->med_bio}}</p>
              <p class="card-text badge badge-dark"> Visit Fee: {{$doctor->visit_fees}} tk</p>

              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}

              <hr class="w-100">
              
              <p>Schedules</p>
              
              {{-- <hr class="w-50"> --}}
              @if ($doctor->doc_schedules->count())

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Day</th>
                      <th scope="col" colspan="3">times</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    

                    @php
                        $i=0; //this is will increase in every day iteration
                    @endphp

                    {{-- Iterate every working day. --}}
                    @foreach ($doctor->workingdays as $workday)
                      
                    <tr>
                      
                      <th scope="row"> {{\Carbon\Carbon::parse($workday->dates)->isoFormat('MMM Do YY')}} </th>
                      <td> {{\Carbon\Carbon::parse($workday->dates)->isoFormat('ddd')}}  </td>
                      
                      <td> 

                          @php
                              
                            //for each working day get times array using index - parent loop
                            $perticulardaytimes =  $doctor->workingdays->get($i)->dc_schedules;
                            
                            //perticular day time array element.
                            foreach ($perticulardaytimes as $perticulardaytime ) {
                              
                              $time = \Carbon\Carbon::parse($perticulardaytime->time)->isoFormat('h:mm A');

                              // NEED FIXING  doctor_id should be transferred from here.

                              // echo "<a href='".route('patient.makeAppointment')."' class='btn btn-sm btn-success mb-1 ml-1 mr-1'>$time</a>";

                              //already have appointment -color change 

                              $user = Auth::user();
                              $patient = $user->patient;





                              $matchedDatenTime = App\Models\Appointment::where([
                                ['patient_id','=',$patient->id],
                                ['doctor_id','=',$doctor->id],
                                ['dates','=',$workday->dates],
                                ['time','=',$perticulardaytime->time],
                              ]);

                              

                              if ($matchedDatenTime->count()) {
                                echo '<form method="post" action="'.route('patient.makeAppointment',['makeAppointment'=>$doctor->id]).'">
                                      <input type="hidden" name="doctor_id" value="'. $doctor->id .'"> 
                                      <input type="hidden" name="dates" value="'. $workday->dates .'"> 
                                      <input type="hidden" name="time" value="'. $perticulardaytime->time .'" > 
                                      <input type="hidden" name="_token" value="'. csrf_token() .'" /> 
                                      <input type="submit" value="'. $time .'" class="btn btn-sm btn-info mb-1 ml-1 mr-1">
                                    </form>';
                              } else {
                                echo '<form method="post" action="'.route('patient.makeAppointment',['makeAppointment'=>$doctor->id]).'">
                                      <input type="hidden" name="doctor_id" value="'. $doctor->id .'"> 
                                      <input type="hidden" name="dates" value="'. $workday->dates .'"> 
                                      <input type="hidden" name="time" value="'. $perticulardaytime->time .'" > 
                                      <input type="hidden" name="_token" value="'. csrf_token() .'" /> 
                                      <input type="submit" value="'. $time .'" class="btn btn-sm btn-success mb-1 ml-1 mr-1">
                                    </form>';
                              }
                              




                              
                                    
                            }
                            $i++; //iterate to next day index.

                          @endphp

                      </td>
                      
                    
                      {{-- testing  --}}

                      


                    </tr>
                    
                    @endforeach                      
                    
                  </tbody>
                </table>
              @else
                <P>Doctor Has not Added New Schedule yet.</P>
              @endif



            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection