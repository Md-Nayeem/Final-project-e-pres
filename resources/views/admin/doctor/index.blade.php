@extends('layouts.solution')

@section('content')
<section class="content mt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All User Info</h3>
    
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
                  <th>ID</th>
                  {{-- <th>Photo</th> --}}
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  {{-- <th>Status</th> --}}
                  <th>Create</th>
                  <th>Updated</th>
                </tr>
              </thead>
              <tbody>
                @if ($users)
                
                  @foreach ($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    {{-- <td>
                      <img height="50px" src="/img/user/{{$user->photo ? $user->photo->path : 'anonymous.jpg'}}" alt="user's profile picture">
                    </td> --}}
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role ? $user->role->name : 'Not assigned' }}</td> {{-- Edit This --}}
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