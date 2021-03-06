@extends('layouts.mob')

@section('content')
  <section class="content pt-3">
    <div class="container-fluid">
      <h3 class="text-center">My Booking</h3>
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
 
          
              
              {{-- <hr class="w-50"> --}}
              @if ($appointments->count())
                <div class="table-responsive"> 
                  <table class="table table-sm">
                    <thead>
                      
                     
                      <tr>
                        <th scope="col">Doctor</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        
                        <th scope="col" class="text-center">Status</th>
                          
                      </tr>
                          
                    </thead>
                    <tbody>
                  
                    @foreach ($appointments as $appointment)
                      <tr class="text-justified">
                        {{-- <td scope="row">{{$user->id}}</td> --}}
                        <td>
                          <img height="50px" class="rounded" src="/img/profile/{{$appointment->doctor->user->profilePhoto ? $appointment->doctor->user->profilePhoto->path : 'doctor.png'}}" alt="user's profile picture">
                        </td>
                        <td>{{$appointment->doctor->user->name}}</td>
                        <td>{{$appointment->doctor->office_location}}</td>
                        <td>{{\Carbon\Carbon::parse($appointment->dates)->isoFormat('MMM Do')}}</td>
                        <td>{{\Carbon\Carbon::parse($appointment->time)->isoFormat('h:mm A')}}</td>
                        
                          @if ($appointment->checking)
                          <td class="text-center">

                            @if ($appointment->checking->prescription->order)
                              <div>
                                {{-- <a href="#" class="btn btn-info">view</a> --}}
                                <a class="btn btn-info" href="{{route('patient-pres.show',['patient_pre'=>$appointment->id])}}">view</a>
                              </div>                        
                            @else
                              <div>
                                <a class="btn btn-warning" href="{{route('payment',['payment'=>$appointment->checking->prescription->id])}}">Pay</a>
                              </div>
                            @endif
                          </td>
                          
                          @else
                            <td class="text-center">
                              <div class="btn btn-success">
                                Not visited
                              </div>                        
                            </td>
                          @endif


                          




  
                          {{-- <a class=" btn btn-success" href="{{route('patient.show',['patient'=>$doctor->id])}}">Book Appointment</a> --}}
                      </tr>
                    @endforeach  
                  </tbody>
                </div>
              </table>
              @else
                <P>You don't have any Appointments.</P>
              @endif



            

        </div>
      </div>
    </div>
  </section>
@endsection