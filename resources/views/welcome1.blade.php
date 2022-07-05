<html>
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     
     <link rel="stylesheet" href="{{asset('welcome/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/font-awesome.min.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/animate.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/owl.carousel.css')}}">
     <link rel="stylesheet" href="{{asset('welcome/css/owl.theme.default.min.css')}}">
     <!-- MAIN CSS -->
     <link rel="stylesheet" href="{{asset('welcome/css/tooplate-style.css')}}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
     
     <!-- Datepicker -->
     
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"defer></script>
       <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<section id="appointment">
          <div class="container">
                         <!-- Search Doctor -->
                    <!-- <form action="{{url('/')}}" method="GET"> -->
                    <div class="card">
                         <div class="card-body">
                              <div class="card-header"><h2>Find Doctors by Date</h2></div>
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-md-8">
                                             <input type="text"  autocomplete="off"  name="app_date" class="form-control" id="datepicker" onkeyup="getdata();">
                                        </div>
                                        <div class="col-md-4">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               <!-- </form> -->
<section>
<div id="res">  </div>
<!-- <div class="card">
        <div class="card-body">
            <div class="card-header"> <h2>List of Doctors on <strong>{{date('F j, Y', strtotime($date))}}</strong></h2></div>
            <div class="card-body">
           
                <table class="table table-bordered table-light">
                      <thead class ="thead-light">
                        <tr>
                          <th scope="col" style="font-size: 20px;">Doctor Picture</th>
                          <th scope="col" style="font-size: 20px;">Doctor Name</th>
                          <th scope="col" style="font-size: 20px;">Specialize</th>
                          <th scope="col" style="font-size: 20px;">Booking</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse($doctors as $doctor)
                        <tr>
                          @if(!$doctor->doctor->user->user_image)
                            <td><img src="{{asset("/images/mdavatar.png")}}" width="90px" style="border-radius: 80px;"></td>
                        @else
                          <td>
                              <img src="{{asset('images')}}/{{$doctor->doctor->user->user_image}}"
                              width="90px" style="border-radius: 80px;">
                          </td>
                          @endif
                          <td style="font-size: 20px;">Dr. {{$doctor->doctor->user->user_fName}} {{$doctor->doctor->user->user_lName}}, {{$doctor->doctor->doctor_title}}</td>
                          <td style="font-size: 20px;">{{$doctor->doctor->doctor_department}}</td>
                          <td>
                              <a href="{{route('create.appointment',[$doctor->doctor_id,$doctor->app_date])}}"><button class="btn btn-primary">Book an appointment</button></a>
                          </td>
                        @empty
                        <tr>
                           <td> <strong style="font-size: 20px;">No Doctors Available for today / Or this paritcular date</strong></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        <tr>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                        </tr>
                        @endforelse 
                        </tr>
                      </tbody>
                </table>
          </div>
        </div>
    </div> -->
    </style>

     <script>
          var dateToday = new Date();
          $( function() {
          $("#datepicker").datepicker({
               dateFormat:"yy-mm-dd",
               showButtonPanel:true,
               numberOfMonths:2,
               minDate:dateToday,
          });
          });

 function getdata()
{
   var name = document.getElementById("datepicker");
    
   console.log(name)
   if(name)
   {
    $.ajax({
      type: 'post',
      url: '{{route('welcome')}}',
      data: {
         app_date:name,
      },
      success: function (response) {
         $('#res').html(response);
      }
    });
   }
   else
   {
    $('#res').html("Enter the user's name");
   }
}
    </script>
    </body>
</html>