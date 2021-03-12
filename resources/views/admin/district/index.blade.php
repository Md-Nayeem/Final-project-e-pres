@extends('layouts.solution')
@section('content')
<section>
  <div class="container-fluid">
  <div class="row pt-5">
    <!-- left column -->
    <div class="col-md-4 card ml-3">
      <div class="card-header">
        <h3 class="card-title">Districts</h3>
      </div>
        <!-- /.card-header --> 
      <div class="card-body table-responsive p-0"> {{-- Here the table size can be adjusted --}}
        <?php $local_id = 1 ?>
        @if ($districts->count())
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($districts as $district)
              <tr>
                <td class="w-25">{{$local_id++}}</td>
                <td class="w-75">{{$district->name}}</td>
                <td class="w-75">
                  <form method="post" action="/admin-dc/dist/{{$district->id}}">
                    <input type="hidden" name="_method" value="DELETE"> 
                    @csrf
                    <input type="submit" value="DELETE" class="btn btn-sm btn-danger">
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
        @else
          <p class="ml-3">Their is no districts</p>
        @endif
      </div>
    </div>
    <div class="col-md-6 mx-auto">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add District</h3>
        </div>

        {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\DistrictController@store']) !!}
        <div class="card-body">
          <div class='form-group'>
            {!! Form::label('name', 'Name: ')!!}
            {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'name'])!!}
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