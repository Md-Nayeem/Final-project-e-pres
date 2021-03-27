@extends('layouts.solution')

@section('content')
<section class="content pt-4">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                <h3>{{$users->count()}} <i class="fas fa-users ml-2"></i></h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{(App\Models\Role::findOrFail(2)->users->count())}} <i class="fas ml-2 fa-user-md "></i></h3>

                <p>Doctor</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{(App\Models\Role::findOrFail(3)->users->count())}} <i class="fas fa-users-cog ml-2 nav-icon"></i>  </h3>

                <p>Staff</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{(App\Models\Role::findOrFail(1)->users->count())}} <i class="fas fa-user-shield ml-2 nav-icon"></i>  </h3>

                <p>Admin</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner mx-2">
                {{-- Role -> user -> count --}}
                <h3>{{(App\Models\Role::findOrFail(1)->users->count())}} <i class="fas fa-user-injured ml-2 nav-icon"></i></h3>

                <p>Patient</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
  </div>
</section>
@endsection