
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
        <link rel="stylesheet" href="{{asset('template/plugins/bootstrap/dist/css/bootstrap.min.css')}}">

        <title>Prescription</title>
    </head>
    <body>
    
        <a href="{{ url()->previous() }}" class="btn btn-primary hidden-back">Back</a>
        @if(auth()->user()->role->name == "doctor")
        <button id="btnPrint" class="hidden-print" >Print</button>
        @endif
        <div class="container" style=" align-content: center;">
            <div class="ticket" style="width: 150mm; height: 215mm; margin-bottom: 0;">
                <!-- <div class="card-body"> -->
                    <h4 class="centered">Dr. {{$prescription1->doctor->user->user_fName}} {{$prescription1->doctor->user->user_lName}}, {{$prescription1->doctor->doctor_title}}</h4>
                        <h5 class="centered">{!!$prescription1->doctor->description!!}
                        </h5  ></span>
                        <div class="second-header" style="font-size: 12px; margin-bottom:-25px;">
                            <strong><p>Urgent Care Clinic
                            <span style="float: right; margin-right: 30px;">Cellphone #: 09195235111</span>
                            <br>4019* P-16 Valero St.<span style="float: right; margin-right: 30px;">Telephone #: 828-3280</span> 
                            <br>Poblacion, Valencia City</p></strong>
                            <hr style=" width: 100%; background-color: black; height:1px;"/>  
                            <p style="font-size: 15px;"> Patient Name: {{$prescription1->user->user_fName}} {{$prescription1->user->user_lName}}<span style="float: right; margin-right: 30px;">Age: {{\Carbon\Carbon::parse($prescription1->user->user_birthdate)->age}} &emsp; Gender: {{$prescription1->user->user_gender}} </span></p> 
                            <p style="font-size: 15px;">Address: {{$prescription1->user->user_address}} <span style="float: right; margin-right: 30px;">Date: {{$prescription1->app_date}} </span></p>    
                            <hr style=" width: 100%; background-color: black; height:1px;" />  
                        </div>
                    <p><span class="rx" style="font-size: 55px;">&#8478;  </span> Findings: {{$prescription1->pres_findings}}</p>
                    <div class="prescription-box" style="margin-left: 30px;">     
                        @foreach($prescriptions as $prescription)
                        <p class="pres-text"><span style="font-weight: bold;">Medication: </span>{{$prescription->medicine_name}}
                        <br><span style="font-weight: bold;">Sig:</span> {{$prescription->medicine_frequency}}
                        <br><span style="font-weight: bold;">Duration:</span> {{$prescription->medicine_duration}}</p>             
                        @endforeach            
                        <br>
                        <div class="divFooter"> <h6>M.D_______________________<br> .
                            PRC Lic No. {{$prescription1->doctor->license}} </h6>
                        </div>
                    </div>             
                </div>         
            </div>
        </div>
    </body>
    
    <style>
          @page {
                size: A6 portrait;
                margin: 12.6px 19.2px 29.4px 8.4px;
                /* margin-top: 4in; */
            }
      * {
            font-family: 'Cambria';
        }

    td,
    th,
    tr,
    table {
        border-top: 2px solid black;
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 200mm;
        max-width: 250mm;
    }
    span.rx {
    content: "\211E";
    }

    .pres-text{
    font-size: 12px;
    }
    
    /* td.quantity,
    th.quantity {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.price,

    th.price {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    } */

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    padding:2mm;
    margin:none;
    width: 130mm;
    height: 210mm;
    background: #FFF;
    }

    img {
        max-width: inherit;
        width: inherit;
    }
    @media screen {
    div.divFooter {
        display: none;
    }
    }

    @media print {
        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
        .hidden-back{
            display: none !important;
        }
        .card {
            border: 1px;
        }
        @page {
                size: A6 portrait;
                margin: 0;
            }
            div.divFooter {
            position: fixed;
            bottom: 5%;
        }    
    }
    </style>
    <script>
            const $btnPrint = document.querySelector("#btnPrint");
      $btnPrint.addEventListener("click", () => {
          window.print();
      });

    </script>
</html>
