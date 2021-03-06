<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  {{-- from theme --}}

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  
  {{-- The Form tags --}}
  <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
  
  {{-- Custom CSS --}}
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  {{-- end theme --}}
  
  @yield('styles')
  
  <title>Document</title>
</head>
<body>
  @php
    $currentUser = Auth::user();
    // dd($currentUser);
  @endphp
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('pt.index')}}">E-Pres</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          {{-- <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a> --}}
          <a class="nav-link" href="{{route('pt.show',['pt'=>$currentUser->id])}}" class="d-block">Profile</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('patient.index')}}">Search Doctor<span class="sr-only">(current)</span></a>
        </li>
        {{-- <li class="nav-item active">
          <a class="nav-link" href="{{route('patient-pres.index')}}">Appointments <span class="sr-only">(current)</span></a>
        </li> --}}
        <li class="nav-item active">
          <a class="nav-link" href="{{route('patient.prescriptionsList',['prescriptionsList'=>$currentUser->patient->id])}}">
            
            Prescriptions 
            {{-- @if (count($currentUser->unreadNotifications->where('type','App\Notifications\PaymentNotify')) > 0 )
              <span class="right badge badge-danger">
                {{$currentUser->unreadNotifications->where('type','App\Notifications\PaymentNotify')->count()}}
              </span>
            @endif --}}


            @if (count($currentUser->unreadNotifications->where('type','App\Notifications\PaymentNotify')) > 0 )
              <span class="right badge badge-warning">
                {{$currentUser->unreadNotifications->where('type','App\Notifications\PaymentNotify')->count()}}
              </span>
              
            @elseif(count($currentUser->unreadNotifications->where('type','App\Notifications\PaymentDone')) > 0 )
              <span class="right badge badge-success">
                {{$currentUser->unreadNotifications->where('type','App\Notifications\PaymentDone')->count()}}
              </span>
            @else
              
            @endif


          </a>
        </li>
        <li class="nav-item active">


          <a class="nav-link" href="{{route('patient.appointments',['appointments'=>$currentUser->patient->id])}}">
            My Appointments 
            @if (count($currentUser->unreadNotifications->where('type','App\Notifications\AppointmentNotify')) > 0 )
              <span class="right badge badge-danger">
                {{$currentUser->unreadNotifications->where('type','App\Notifications\AppointmentNotify')->count()}}
              </span>
            @endif

          </a>


        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('pt.mtl',['mtl'=>$currentUser->patient->id])}}">My Payment timeline</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
            <i class="fas nav-icon fa-sign-out-alt"></i>
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
            </a>
        </li>
      </ul>
      
    </div>
  </nav>

  <div id="root">
    @yield('content')
  </div>



{{-- start theme js links--}}
  <!-- jQuery -->
  {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <!-- jQuery UI 1.11.4 -->
  {{-- <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  {{-- here will be custom js scripts --}}
  @yield('script')
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

  {{-- end theme --}}

</body>
</html>