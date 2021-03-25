@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
          <div class="card card-primary">
            <div class="card-hearder">
              <h4 class="card-title">Select doctor from here.</h4>
            </div>
            <div class="card-body">
              <p>Here, will be the doctors. </p>

              {{-- NEED TO FIX THE MOBILE VIEW --}}
              @if ($doctors->count())
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    
                    <tr>
                        <th scope="col" colspan="3" class="bg-info">Personal</th>
                        <th scope="col" colspan="1" class="bg-warning">Others</th>
                    </tr>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>

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
                      <td>
                        <a class=" btn btn-success" href="{{route('dc-pres.show',['dc_pre'=>$doctor->user->id])}}">Book Appointment</a>
                      </td>
                    </tr>
                  @endforeach  
                </tbody>
              </table>
              @else
                <p class="text-center mt-2 text-secondary">Their is no Staff.</p>
              @endif
              

              

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection