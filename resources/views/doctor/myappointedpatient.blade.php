@extends('layouts.solution')

@section('content')
<section class="content pt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Appointments</h3>
    
            {{-- <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
    
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div> --}}
          
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0"> {{-- Here the table size can be adjusted --}}
            @if ($appointments->count())
            <table class="table table-head-fixed text-nowrap">
              <thead>
                
                <tr>
                    <th scope="col" colspan="5" class="bg-info">Personal</th>
                    <th scope="col" colspan="5" class="bg-warning">Others</th>
                </tr>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th>Age</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>

                    {{-- <th scope="col">Appointment Id</th> --}}
                    <th scope="col">date</th>
                    <th scope="col">time</th>

                    <th>Booked</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
                    
              </thead>
              <tbody>
                
                  @foreach ($appointments as $appointment)
                
                  @php
                    //To use the eloquent methods re-initiating user again
                    $appointment = App\Models\Appointment::findOrFail($appointment->id);




                    //patient user
                    $patient = $appointment->patient;


                    // user info of the patient
                    $user = App\Models\User::findOrFail($patient->user_id);

                  @endphp

                  <tr class="text-justified">
                    {{-- <td scope="row">{{$user->id}}</td> --}}
                    <td>
                      <img height="50px" class="rounded" src="/img/profile/{{$user->profilePhoto ? $user->profilePhoto->path : 'doctor.png'}}" alt="user's profile picture">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$patient->age}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>

                    {{-- <td>{{$appointment->id}}</td> --}}
                    <td>{{\Carbon\Carbon::parse($appointment->dates)->isoFormat('MMM Do')}}</td>
                    <td>{{\Carbon\Carbon::parse($appointment->time)->isoFormat('h:mm A')}}</td>

                    <td>{{$appointment->created_at->diffForHumans()}}</td>{{-- Using carbon class --}}
                    {{-- <td class="   {{$appointment->visited == 0 ? 'table-warning' : 'table-success'}}   " >  {{$appointment->visited == 0 ? 'not visited' : 'visited'}}  </td> --}}
                    {{-- <td> --}}

                    {{-- The status column --}}
                    @if ($appointment->checking)
                      <td class="table-success">
                        Confirmed
                      </td>
                    @else
                      <td class="table-warning">
                        Waiting
                      </td>
                    @endif
                    {{-- </td> --}}
                    <td>
                      {{-- Here will be logic according to the appointment table showing Prescribe status --}}

                      {{-- It should be a form with a hidden value --}}

                      <form method="post" action="{{route('dc-pres.post')}}">
                        @csrf
                        <input type="hidden" name="patient_user_id" value="{{$user->id}}"> 
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}"> 
                        
                        @if ($appointment->checking)
                          <a href="{{route('dc-pres.show',['dc_pre'=>$appointment->checking->prescription->id])}}" class="btn btn-success" >Show</a>
                        @else
                          <input type="submit" value="Prescribe" class="btn btn-primary mx-1">
                        @endif
                      </form>

                      {{-- <a class=" btn btn-success" href="{{route('dc-pres.show',['dc_pre'=>$user->id])}}">Old Prescribe</a> --}}
                    </td>
                    {{-- <td>{{$user->updated_at->diffForHumans()}}</td> --}}
                  </tr>
                  @endforeach  
                     
                </tbody>
              </table>
              @else
                <p class="text-center mt-2 text-secondary">No patient has booked appointment</p>
              @endif
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
@endsection