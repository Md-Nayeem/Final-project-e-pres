@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
          
          <p>Here, will be the doctors. </p>

          {{-- NEED TO FIX THE MOBILE VIEW --}}
          @if ($doctors->count())
            <div class="table-responsive">
              <table class="table table-sm">
                <thead class="text-center align-baseline">
                  
                  <tr>
                      <th scope="col" colspan="5" class="bg-info">info</th>
                      <th scope="col" colspan="1" class="bg-warning">Others</th>
                  </tr>
                  <tr>
                      <th scope="col">Photo</th>
                      <th scope="col">Name</th>
                      <th scope="col">Department</th>
                      <th scope="col">District</th>
                      <th scope="col">Location</th>
  
                      <th>Action</th>
                      
                  </tr>
                      
                </thead>
                <tbody>
              
                @foreach ($doctors as $doctor)
                  <tr class="text-justified">
                    {{-- <td scope="row">{{$user->id}}</td> --}}
                    <td>
                      <img height="50px" class="rounded" src="/img/profile/{{$doctor->user->profilePhoto ? $doctor->user->profilePhoto->path : 'doctor.png'}}" alt="user's profile picture">
                    </td>
                    <td>{{$doctor->user->name}}</td>
                    <td>{{$doctor->department->name}}</td>
                    <td>{{$doctor->district->name}}</td>
                    <td>{{$doctor->office_location}}</td>
                    <td>
                      <a class=" btn btn-success btn-sm" href="{{route('patient.show',['patient'=>$doctor->id])}}">Book Appointment</a>
                    </td>
                  </tr>
                @endforeach  
              </tbody>
            </table>
            </div>
          @else
            <p class="text-center mt-2 text-secondary">Their is no Staff.</p>
          @endif
              

              

           


        </div>
      </div>
    </div>
  </section>
@endsection