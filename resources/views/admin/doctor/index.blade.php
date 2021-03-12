@extends('layouts.solution')

@section('content')
<section class="content mt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All Doctors Info</h3>
    
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
    
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0"> {{-- Here the table size can be adjusted --}}
            <table class="table table-head-fixed text-nowrap">
              <thead>
                
                <tr>
                    <th scope="col" colspan="5" class="bg-info">Personal</th>
                    <th scope="col" colspan="3" class="bg-success">Career</th>
                    <th scope="col" colspan="3" class="bg-warning">Offical</th>
                    <th scope="col" colspan="3" class="bg-secondary">Other</th>

                    {{-- <th colspan="3">Weight</th>
                    <th>Volume</th> --}}
                </tr>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>

                    <th>Department</th>
                    <th>Medical Bio</th>
                    <th>Experience</th>

                    <th>District</th>
                    <th>Working Days</th>
                    <th>Office Location</th>

                    <th>Create</th>
                    <th>Updated</th>
                    
                </tr>
                
                
                
                
                
                {{-- <tr>
                  
                  <th>Role</th>
                  <th>Status</th>
              
                </tr> --}}

                
              </thead>
              <tbody>
                @if ($users)
                
                  @foreach ($users as $user)
                  <tr class="text-justified">
                    <td scope="row">{{$user->id}}</td>
                    <td>
                      <img height="50px" class="rounded" src="/img/profile/{{$user->profilePhoto ? $user->profilePhoto->path : 'doctor.png'}}" alt="user's profile picture">
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    {{-- <td>{{$user->role ? $user->role->name : 'Not assigned' }}</td> Edit This --}}
                    <td>{{$user->doctor->department->name}}</td>
                    <td>{{$user->doctor->med_bio}}</td>
                    <td>{{$user->doctor->experience}}</td>
                    <td>{{$user->doctor->district->name}}</td>
                    <td>{{$user->doctor->working_days}}</td>
                    <td>{{$user->doctor->office_location}}</td>

                    {{-- <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td> --}}
                    <td>{{$user->created_at->diffForHumans()}}</td>{{-- Using carbon class --}}
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                  </tr>
                  @endforeach  
                
                @else
                  <h2>Their is no user</h2>
                @endif

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
@endsection