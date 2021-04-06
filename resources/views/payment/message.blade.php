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
              <h4 class="card-title mb-2 font-weight-bold">Payment status</h4>
              <p class="card-text  pt-2">Your payment is done successfully!</p>
              <div class="text-center">
                <a href="{{route('patient.index')}}" class="btn btn-success mx-1">Ok</a>
              </div>
            </div>
          </div>




        </div>
      </div>
    </div>
  </section>
@endsection