@extends('layouts.solution')

@section('content')
<section class="content pt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">The Booked patient list</h3>
    

          
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0"> {{-- Here the table size can be adjusted --}}
            @if ($appointments->count())
            <table class="table table-head-fixed text-nowrap">
              <thead>
                
                <tr>
                    <th scope="col" colspan="5" class="bg-info">Personal</th>
                    <th scope="col" colspan="4" class="bg-warning">Others</th>

                    {{-- <th colspan="3">Weight</th>
                    <th>Volume</th> --}}
                </tr>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th>Age</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Doctor</th>

                    {{-- <th scope="col">Appointment Id</th> --}}
                    <th scope="col">date</th>
                    <th scope="col">time</th>

                    <th>status</th>
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
                    <td>{{$appointment->doctor->user->name}}</td>

                    {{-- <td>{{$appointment->id}}</td> --}}
                    <td>{{\Carbon\Carbon::parse($appointment->dates)->isoFormat('MMM Do')}}</td>
                    <td>{{\Carbon\Carbon::parse($appointment->time)->isoFormat('h:mm A')}}</td>

                    <td class="   {{$appointment->visited == 0 ? 'table-warning' : 'table-success'}}   " >  {{$appointment->visited == 0 ? 'not visited' : 'visited'}}  </td>
                    <td>
                      <a href="{{route('st-ap.visitedStatus',['visitedStatus'=>$appointment->id])}}" class="btn btn-info"> Change </a>
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