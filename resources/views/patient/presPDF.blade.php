<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

  <h1 style="background-color: darkcyan; color:white; padding-bottom:5px;">Prescription</h1>
  <h2>By Dr: {{$singlePresdata->doctor->user->name}}</h2>
  <h3>Date: {{$singlePresdata->created_at->toFormattedDateString()}} | Disease: {{$singlePresdata->disease}}</h3>
  <h3>Symptoms: {{$singlePresdata->symptoms}}</h3>
   <hr>
  <h4 class="mx-auto">Medicines</h4>
  @php
    //collection of the medicines under same pres
    $medicines = $singlePresdata->medicine;
    
    $mednum = 1;
  @endphp
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Medicine</th>
          <th scope="col">Quantity</th>
          <th scope="col">Days</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($medicines as $medi)
        <tr>
          <th scope="row">{{$mednum}}</th>
          <td>{{$medi->medicine_name}}</td>
          <td>{{$medi->quantity}}</td>
          <td>{{$medi->days}}</td>
        </tr>
          @php
            $mednum++;
          @endphp
        @endforeach
      </tbody>
    </table>

    {{-- Pro --}}
    <h4>Procedure</h4>
    <p><q> {{$singlePresdata->procedure}} </q>_ Dr.</p>


  <hr>

  <h4 class="mx-auto">Test</h4>
  @php
    //collection of the medicines under same pres
    // $medicines = $singlePresdata->medicine;
    $tests = $singlePresdata->tests;
    
    $testnum = 1;
  @endphp
  <table class="table">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Test Name</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tests as $test)
      <tr>
        <th scope="row">{{$testnum}}</th>
        <td>{{$test->test_name}}</td>
        <td>
          {{$test->testReport ? 'tested':'not tested'}}
        </td>
      </tr>
        @php
          $testnum++;
        @endphp
      @endforeach
    </tbody>
  </table>


  {{-- <h1>Hello PDF This is <span style="color: blue">{{$user->name}}</span> . My Email address {{$user->emaill}}</h1> --}}
  
</body>
</html>