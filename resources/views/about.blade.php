@extends('layouts.app')

@section('content')
<!-- <div class="about-section">
  <h1>About Us</h1>
  <p>Some text about who we are and what we do.</p>
  <p>Resize the browser window to see that this page is responsive by the way.</p>
</div>
<br>
<br> -->
<h2 style="text-align:center">Our Doctors</h2>
<br>


<div class="row" style="margin: auto;">
@foreach($doctors as $doctor)
  <div class="column">
    <div class="card">
    @if(!$doctor->user_image)
    <center>
        <img src="{{asset("/images/user.png")}}"  style="width: 250px; border-radius: 100%; margin-top: 20px;">
   </center>
      @else
      <center>
      <img src="{{asset('images')}}/{{$doctor->user_image}}" style="width: 250px;  height: 300px; border-radius: 100%; margin-top: 20px;">
      </center>
      @endif
      <div class="container">
        <h2>Dr. {{$doctor->user_fName}} {{$doctor->user_lName}}</h2>
        <p class="title">{{$doctor->user_department}}</p>
        <p><i class="fas fa-envelope mr-3"></i>{{$doctor->email}}</p>
        <p><i class="fas fa-phone mr-3"></i>{{$doctor->user_phoneNum}}</p>
        <p><i class="fas fa-home mr-3"></i>{{$doctor->user_address}}</p>
      </div>
    </div>
  </div>
@endforeach
<!-- 
  <div class="column">
    <div class="card">
      <img src="/w3images/team2.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Mike Ross</h2>
        <p class="title">Art Director</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>mike@example.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="/w3images/team3.jpg" alt="John" style="width:100%">
      <div class="container">
        <h2>John Doe</h2>
        <p class="title">Designer</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>john@example.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div> -->

</div>
@endsection