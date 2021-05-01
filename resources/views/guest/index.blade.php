@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 bg-info">
            {{-- <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                    You this will be the home page.
                <div class="card-body">
                    
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-6">
                    <img src="/img/ven/doc.jpg" alt="Demo doctor picture">
                </div>
                <div class="col-md-6 text-white">
                    <h3 class="  font-weight-bold mt-5"> Welcome to E-pres application!</h3>
                    <p class="text-justified "> Do you want to get a an Seach the doctor You need according to your location ? <br>
                    Now you can do just that by creating an account here. We will keep you prescription information secure with you and give you 24/7 access to your medical information.
                    </p>
                    
                    <div class="row">
                        <a class="btn btn-large btn-primary ml-3" href="{{ route('login') }}">Login</a>

                        <a class="btn btn-large btn-warning ml-2" href="{{ route('gst.create') }}">SignUp</a>
                    </div>
                </div>
            </div>

            






        </div>
    </div>
</div>
@endsection
