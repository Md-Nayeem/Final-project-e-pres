@if(count($errors))  {{-- Showing the errors --}}
  <div class="mt-4 alert alert-danger col-md-6 mx-auto">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif