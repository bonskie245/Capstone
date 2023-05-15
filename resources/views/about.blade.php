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
              <div class="card" style="width: 100%">
              <div class="card-header" style="text-align: center;"><h1>Valencia City, Bukidnon <br> Philippines</h1></div>
                <div class="card-body" style="color: black;">
                @if(isset($about))
                {!!$about->description!!}
                
                @else
                        <h1>Mission & Vision</h1>
                        <br>
                        <h2>The UCC WAY</h2>
                        <br>
                        <h2>The URGENT CARE CLINIC VISION:</h2>
                        <p>The Urgent care Clinic is commited to be a leading provider of preventive health care services by delivering
                           high quality outcomes for clients and ensuring long term patient friendly relatioship.</p>
                        <p>	&emsp;• We are caring, progressive, enjoying our work and use positive spirit to succeed.</p>
                        <p>	&emsp;• We take pride in our achievements and actively seek new ways of doing things better.</p>
                        <p>	&emsp;• We value Integrity credibility and respect for the individual & family.</p>
                        <p>	&emsp;• We built constructive relationships to achieve positive outcomes for all.</p>
                        <p>	&emsp;• We believe that success comes through recognizing and encouraging the value of people and teams.</p>
                        <p>	&emsp;• We aim to grow & improve our medical services while closely maintaing our patient care.</p>

                        <br>
                        <h2>The URGENT CARE CLINIC Mission:</h2>
                        <p>	&emsp;• To participate in the creation of a healther lives within the community.</p>
                        <p>	&emsp;• To provide health care services in a responsible manner which contribute to the physical. psychological, social & spirital well being of the patients 
                          & <br> &emsp;&emsp;community which it serves.</p>
                        <p>	&emsp;• To provide assistance to the whole person in a christian spirit of equality & interfaith serving all regardless of age, color, creed or gender.</p>
                    @endif
                </div>
            </div>
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

<div class="flex-container">
<div class="row" style="margin: auto;">
@foreach($doctors as $doctor)
<div class="col-md-6">
    <div class="card" style="height: 100%; width: 75%">
    @if(!$doctor->user->user_image)
    <center>
        <img src="{{asset("/images/mdavatar.png")}}"  style="width: 30%; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
   </center>
      @else
      <center>
      <img src="{{asset('images')}}/{{$doctor->user->user_image}}" style="width: 30%; border-radius: 100%; margin-top: 20px; margin-bottom: 20px;">
      </center>
      @endif
      <div class="container">
        <h2>Dr. {{$doctor->user->user_fName}} {{$doctor->user->user_lName}}, {{$doctor->doctor_title}}</h2>
        <p class="title">{{$doctor->doctor_department}}</p>
        <p><i class="fas fa-envelope mr-3"></i>{{$doctor->user->email}}</p>
        <p><i class="fas fa-phone mr-3"></i>{{$doctor->user->user_phoneNum}}</p>
        <p><i class="fas fa-home mr-3"></i>{{$doctor->user->user_address}}</p>
      </div>
    </div>
  </div>
@endforeach
</div>

<style>
    .flex-container{display: flex;justify-content: space-around;background:#fff;}
</style>
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