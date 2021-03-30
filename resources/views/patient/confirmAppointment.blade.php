@extends('layouts.mob')

@section('content')
  <section class="content pt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4 col-md-6 col-lg-8">
 
                
          {{-- <div class="card pt-3">
          
            <h1>Confirmation</h1>
          
            
          </div> --}}

          <div class="card pt-3">
            <div class="card-body">
              {{-- test --}}
              

              {{-- If the oldAppointment is not null --}}
              @if ($oldAppointment->count())
              <h4 class="card-title mb-2 font-weight-bold">Delete Old Appointment</h4>
              
                
                <p class="card-text text-center pt-2">You Already have an appointment with  <u> {{$doctor->user->name}} </u><br> 
                  on {{\Carbon\Carbon::parse($date)->isoFormat('MMM Do dddd')}} 
                  at {{\Carbon\Carbon::parse($oldAppointment[0]->time)->isoFormat('h:mm A')}}
                  <br> <br>
                  Do you Want to delete the old appointment?
                </p>
                <div class="text-center">



                <form method="post" action="{{route('patient.destroy',['patient'=>$oldAppointment[0]->id])}}">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  
                  <a href="{{url()->previous()}}" class="btn btn-danger mx-1">No</a>
                  <input type="submit" value="Delete" class="btn btn-primary mx-1">
                </form>
              @else

              <h4 class="card-title mb-2 font-weight-bold">Confirm Appointment</h4>
                <p class="card-text">Do you want to confirm your appointment ? <br> with  <u> {{$doctor->user->name}} </u><br> on {{\Carbon\Carbon::parse($date)->isoFormat('MMM Do dddd')}} at {{\Carbon\Carbon::parse($time)->isoFormat('h:mm A')}}</p>
                <div class="text-center">



                <form method="post" action="{{route('patient.store')}}">
                  @csrf
                  <input type="hidden" name="doctor_id" value="{{$doctor->id}}"> 
                  <input type="hidden" name="dates" value="{{$date}}"> 
                  <input type="hidden" name="time" value="{{$time}}"> 
                  
                  <a href="{{url()->previous()}}" class="btn btn-danger mx-1">No</a>
                  <input type="submit" value="Yes" class="btn btn-primary mx-1">
                </form>
                  
              @endif



                {{-- <a href="#" class="btn btn-primary mx-1">Yes</a> --}}
              </div>
            </div>
          </div>




        </div>
      </div>
    </div>
  </section>
@endsection