@extends('layouts.solution')
@section('content')
<section class="content pt-4"> 
  @php
      $user = Auth::user();
  @endphp
  {{-- <a class="btn btn-info" href="dc/{{$user->id}}/edit">Edit</a> --}}
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8 mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Your Profile</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-3 pl-5 ">
                <img src="/img/profile/{{$user->profilePhoto ? $user->profilePhoto->path : 'anonymous.jpg'}}" height="150px" width="150px" alt="user's profile picture" class="img-rounded" alt="User Image">
              </div>
              <div class="col-md-5 mx-auto ">
                <h1>{{$user->name}}</h1>
                <h5><i>{{$user->email}}</i></h5>
                {{-- <h5><i> {{$user->doctor->office_location}} </i><span class="ml-2"> <i class="fas fa-map-pin"></i></span></h5>  --}}
              </div>
            </div>
            <div class="row mt-5 ">
              {{-- test --}}
              <div class="col-md-8 mx-auto">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Basic Info</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Career Info</a>
                  </li>
                  {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Office Info</a>
                  </li> --}}
                </ul>

                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    

                    <div class="row ml-2 mt-4">
                      <div class="col-sm-3 col-md-4 col-5">
                          <label style="font-weight:bold;">Name</label>
                      </div>
                      <div class="col-md-8 col-6">
                          {{$user->name}}
                      </div>
                    </div>
                    <hr />

                    <div class="row ml-2">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">Email</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->email}}
                        </div>
                    </div>
                    <hr />

                    <div class="row ml-2">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">Phone</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->phone}}
                        </div>
                    </div>
                    <hr />

                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    
                    <div class="row ml-2 mt-4">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">Qualification</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->staff->qualification}}
                        </div>
                    </div>
                    <hr />

                    <div class="row ml-2 mt-4">
                      <div class="col-sm-3 col-md-4 col-5">
                          <label style="font-weight:bold;">Shift</label>
                      </div>
                      <div class="col-md-8 col-6">
                          {{$user->staff->shift->name}}
                      </div>
                    </div>
                    <hr />

                    

                    <div class="row ml-2">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">Experience</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->staff->experience}}
                        </div>
                    </div>
                    <hr />

                    
                    

                  </div>

                  {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                    <div class="row ml-2 mt-4">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">District</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->doctor->district->name}}
                        </div>
                    </div>
                    <hr />

                    <div class="row ml-2">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">Working days</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->doctor->working_days}}
                        </div>
                    </div>
                    <hr />

                    <div class="row ml-2">
                        <div class="col-sm-3 col-md-4 col-5">
                            <label style="font-weight:bold;">Office Location</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{$user->doctor->office_location}}
                        </div>
                    </div>
                    <hr />

                  </div> --}}


                </div>
              {{-- end --}}
              </div>
            </div>

            <div class="text-center mt-2">
              <a class=" btn btn-success" href="{{route('st.edit',['st'=>$user->id])}}">Edit</a>
            </div>
            <br>
            <div class="text-center mt-2">
              <a class=" btn btn-success" href="{{route('user.edit',['user'=>$user->id])}}">Change Password</a>
            </div>
          
          </div>
          <div class='card-footer text-center'>
            Your account was created {{$user->created_at->diffForHumans()}}.
          </div>
          {!!Form::close()!!}
        </div>
        <!-- /.card -->
        @include('includes.form_error')
      </div>
    </div>
  </div>

</section>
@endsection