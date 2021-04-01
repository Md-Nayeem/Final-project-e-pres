@extends('layouts.solution')

@section('content')
<section class="content pt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All Your schedules</h3>
    
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

            @if ($doctor->doc_schedules->count())

                <table class="table  table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Day</th>
                      <th scope="col" colspan="3">times</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    

                    @php
                        $i=0; //this is will increase in every day iteration
                    @endphp

                    {{-- Iterate every working day. --}}
                    @foreach ($doctor->workingdays as $workday)
                      
                    <tr>
                      
                      <th scope="row"> {{\Carbon\Carbon::parse($workday->dates)->isoFormat('MMM Do YY')}} </th>
                      <td> {{\Carbon\Carbon::parse($workday->dates)->isoFormat('ddd')}}  </td>
                      
                      <td> 

                          @php
                              
                            //for each working day get times array using index - parent loop
                            $perticulardaytimes =  $doctor->workingdays->get($i)->dc_schedules;


                            // finding a


                            
                            //perticular day time array element.
                            foreach ($perticulardaytimes as $perticulardaytime ) {

                              // $perti
                              
                              $time = \Carbon\Carbon::parse($perticulardaytime->time)->isoFormat('h:mm A');

                              echo '
                              <form method="post" action="'.route('dc-schedule.destroy',['dc_schedule'=>$perticulardaytime->id]).'">
                                <label for="time">'.$time.'</label>
                                <input type="hidden" name="_method" value="DELETE"> 
                                <input type="hidden" name="_token" value="'. csrf_token() .'" /> 
                                
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash text-white"></i></button>
                                
                                
                              </form>';
                              
                              

                            }
                            $i++; //iterate to next day index.

                          @endphp
  
                          
                      </td>

                    </tr>
                    
                    @endforeach                      
                    
                  </tbody>
                </table>
              @else
                <div class="text-center">
                  <h6> You have not added any Schedule yet.</h6>
                </div>
              @endif
            



          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

          
      </div>

      <div class="col-md-6">
        <div class="some-class">
          <h1>Today calendar (skin-black shadow-default)</h1>
          <div class="calendar-container text-center">
            <div id="dycalendar-today-with-skin-shadow" class="dycalendar-container shadow-default "></div>
          </div>
        </div>
      </div>



    </div>
  </div>
</section>







@endsection

@section('script')
  
  <script>
    dycalendar.draw({
      target: '#dycalendar-today-with-skin-shadow',
      type: 'month',
      monthformat : 'full',
      highlighttoday: true,
      prevnextbutton: 'show'
    });
  </script>


@endsection




