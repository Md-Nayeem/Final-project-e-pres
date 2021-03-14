@extends('layouts.solution')

@section('content')
<section class="content mt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All Admins Info</h3>
    
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
                    <th scope="col" class="bg-success">Office</th>
                    <th scope="col" colspan="2" class="bg-warning">Others</th>
                </tr>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>

                    <th>Shift</th>

                    <th>Created</th>
                    <th>Updated</th>
                    
                </tr>
                    
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
                    <td>{{$user->admin->shift->name}}</td>                    
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