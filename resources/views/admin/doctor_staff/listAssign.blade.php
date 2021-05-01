@extends('layouts.solution')
@section('content')
<section>
  <div class="container-fluid">
  <div class="row pt-5">
    <!-- left column -->
    <div class="col-md-4 card ml-3">
      <div class="card-header">
        <h3 class="card-title">List of assigned doctor and staff</h3>
      </div>
        <!-- /.card-header --> 
      <div class="card-body table-responsive p-0"> {{-- Here the table size can be adjusted --}}
        <?php $local_id = 1 ?>
        @if ($doctors->count())
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Doctor</th>
                <th>Staff</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($doctors as $doc)
                {{-- staffs under perticular doctor --}}
                @foreach ($doc->staffs as $staff)
                <tr>
                  <td class="w-25">01</td>
                  <td class="w-25">{{$doc->user->name}}</td>
                  <td class="w-25">{{$staff->user->name}}</td>
                  {{-- <td class="w-25">{{$local_id++}}</td>
                  <td class="w-75">{{$department->name}}</td>
                  <td class="w-75">
                    <form method="post" action="/admin-dc/dpt/{{$department->id}}">
                      <input type="hidden" name="_method" value="DELETE"> 
                      @csrf
                      <input type="submit" value="DELETE" class="btn btn-sm btn-danger">
                    </form>
                  </td> --}}
                  <td class="w-25"><a class="btn btn-danger" href="#">delete</a></td>
                </tr>
                @endforeach{{-- Staff --}}
              @endforeach{{-- Doctor --}}
            </tbody>
        </table>
        @else
          <p class="ml-3">There is no relation between any Doctor with Staff</p>
        @endif
      </div>
    </div>
    <div class="col-md-6 mx-auto">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Assign Staff to Doctor</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\AdminDoctorController@assignStaffToDoctor']) !!}
        <div class="card-body">
          <div class='form-group'>
            {!! Form::label('doctor_id', 'Doctor: ')!!}
            {!! Form::select('doctor_id', ['' => '--Select Doctor--'] + $userDoc, 0, ['class'=>'form-control'])!!}
          </div> 
          <div class='form-group'>
            {!! Form::label('staff_id', 'Staff: ')!!}
            {!! Form::select('staff_id', ['' => '--Select Staff--'] + $userStaff, 0, ['class'=>'form-control'])!!}
          </div> 
        <div class='card-footer text-center'>
          {!! Form::submit('Create',['class'=>'btn btn-primary w-50'])!!}
        </div>
        {!!Form::close()!!}
      </div>
      <!-- /.card -->
      @include('includes.form_error')
    </div>

    @if (Session::has('Comment_message'))
        
      <div class="alert alert-success">{{session('Comment_message')}}</div> 
        
    @endif
  </div>
</div>
</section>  



@endsection

@section('script')
    <script>
      $("document").ready(function(){
        setTimeout(function(){
          $("div.alert-success").remove();
        }, 1000 ); // 2 secs
      });

      $("document").ready(function(){
        setTimeout(function(){
          $("div.alert-danger").remove();
        }, 3000 ); // 3 secs
    });


    </script>
@endsection