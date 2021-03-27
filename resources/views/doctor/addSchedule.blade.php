@extends('layouts.solution')
@section('content')
<section class="content pt-4"> 
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-7 mx-auto">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Schedule</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            {!! Form::open(['method'=>'POST', 'action' => 'App\Http\Controllers\DoctorScheduleController@store']) !!}
            <div class='form-group'>
              {!! Form::label('dates', 'Date: ')!!}
              {!! Form::date('dates',null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
              <label for="time">Time:</label>
              <input type="time" class="form-control mb-2" name="time[]">

              <div id="newTime">{{-- This will be filled --}}
              </div> 


            </div>
            <button id="addTime" type="button" class="btn btn-info">Add Another</button>
            
          </div>
          <div class='card-footer text-center'>
            {!! Form::submit('Save',['class'=>'btn btn-primary w-50'])!!}
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


@section('script')
    <script type="text/javascript">
      $("#addTime").click(function(){
        var html = '';
        html += '<input type="time" class="form-control mb-2" name="time[]">';
        $("#newTime").append(html);
      });
    </script>
@endsection




