@extends('layouts.app')

@section('content')
<!-- <div class="about-section">
  <h1>About Us</h1>
  <p>Some text about who we are and what we do.</p>
  <p>Resize the browser window to see that this page is responsive by the way.</p>
</div>
<br>
<br> -->
<div class="row justify-content-center">
  <div class="col-lg-6">
                    <div class="section-tittle text-center mb-100">
                        <!-- <span>Our Doctors</span> -->
                        <h2>Urgent Care Clinic</h2>
                    </div>
                </div>
            </div>
            <div class="container">
              <h4>Urgent Care Clinic is a small establishment with approximately two (2) physicians and nurse. The clinic is managed by 
                Dr. Conchita B. Bergado & Dr. Stephen Paul M. Bergado, who specializes in Family Medicine. Currently, 
                it is located at P Valero Street, Poblacion, Valencia City, Bukidnon.</h4>
            </div>
</div>
<br>
<br>
<br>
<div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-tittle text-center mb-100">
                        <!-- <span>Our Doctors</span> -->
                        <h2>Our Doctors</h2>
                    </div>
                </div>
            </div>
<br>

<div class="container">
<div class="row" style="margin: auto;">
@foreach($doctors as $doctor)
  <div class="column">
    <div class="card">

    @if(!$doctor->user->user_image)
    <center>
        <img src="{{asset("/images/mdavatar.png")}}"  style="width: 250px; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
   </center>
      @else
      <center>
      <img src="{{asset('images')}}/{{$doctor->user->user_image}}" style="width: 250px; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
      </center>
      @endif
      <div class="container">
        <h2>Dr. {{$doctor->user->user_fName}} {{$doctor->user->user_lName}}, {{$doctor->doctor_title}} {{\Carbon\Carbon::parse($doctor->user_birthdate)->age;}}</h2>
        <p class="title">{{$doctor->doctor_department}}</p>
        <p><i class="fas fa-envelope mr-3"></i>{{$doctor->user->email}}</p>
        <p><i class="fas fa-phone mr-3"></i>{{$doctor->user->user_phoneNum}}</p>
        <p><i class="fas fa-home mr-3"></i>{{$doctor->user->user_address}}</p>
      </div>
    </div>
  </div>
@endforeach
</div>

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