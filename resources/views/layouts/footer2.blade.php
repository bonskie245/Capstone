 <br>

 <footer data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-4">
                         <div class="footer-thumb"> 
                              <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                              <p>Below is the Urgent Care Clinics Contact info incase you need something from us.</p>

                              <div class="contact-info">
                                   <p><i class="fa fa-phone"></i> +63 919 523 5111 </p>
                                   <p><i class="fa fa-envelope-o"></i> <a href="#">info@company.com</a></p>
                              </div>
                         </div>
                    </div>



                    <div class="col-md-4 col-sm-4"> 
                         <div class="footer-thumb">
                              <div class="opening-hours">
                                   <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                                   <p>Monday - Saturday <span>08:00 AM - 5:00 PM</span></p>
                                   <!-- <p>Saturday <span>08:00 AM - 12:00 PM</span></p> -->
                                   <p>Sunday <span>Closed</span></p>
                              </div> 

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-20 col-sm-12 border-top">
                         <div class="col-md-4 col-sm-6">
                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2022 Urgent Care Clinic 
                              </div>
                         </div>
                         <div class="col-md-6 col-sm-6">
                         </div>
                         <div class="col-md-2 col-sm-2 text-align-center">
                              <div class="angle-up-btn"> 
                                  <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                              </div>
                         </div>   
                    </div>
                    
               </div>
          </div>

     </footer>




     @if(isset($dates))
    <script>
        $(document).ready(function(){
            $.ajaxSetup(
            {
                    headers: 
                    {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            var dates= @json($dates);
                    // Select Doctor
        $("#Id").click(function()
        { 
            var doctorId = $("input[name='doctorId']:checked").val();
            var title = $('#doctorName').val();

            console.log(title)
            // Ajax Start
            $.ajax({
                type: 'GET',
                url: "{{route('users.create')}}",
                data: {doctorId},
                success: function(data) 
                {
                    var op = data.map(function(item)
                    {
                        return item.app_date;
                    });
                
                    
                    console.log(op)
                    $('#myModal').modal({backdrop: 'static', keyboard: false});
                    $('#myModal').find('#title').text(title);
                    $("#myModal").modal('show');

                    $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd',
                    showButtonPanel: true,
                    altField: "#alternate",
                    altFormat: "mm-dd-yy",
                    minDate: new Date(),
                    beforeShowDay: function(date)
                    {
                        var sdate = moment(date).format('YYYY-MM-DD');

                        if ($.inArray(sdate, op) !== -1) {
                            return [true];
                        }
                        else{
                            return [false,'red']; 
                        }
                    },
                    onSelect: function (date) 
                    {                                   
                        // start ajax
                        $.ajax({
                            type: 'GET',
                            url: "{{route('users.create')}}",
                            data: {date, doctorId},
                            success: function(data) 
                            {
                                console.log(data)
                                var result = " ";
                                for(var i = 0; i < data.length; i++)
                                {
                                    result += "<div class='form-group col-md-6'> <label class='btn btn-outline-primary'> <input type='radio' id='app_id' class='form-control is-invalid' id='validationServer03'  name='app_id' value='"
                                    + data[i].id +"'required> <span>"
                                    + moment(data[i].time_start, 'HH:mm A').format('hh:mm A') +" - " 
                                    + moment(data[i].time_end, 'HH:mm A').format('hh:mm A')+"</span></label> </div>";
                                }
                                    $('#result').html(result);
                            },
                        });
                        // end ajax
                    },
                    // End Onselect
                    });
            // end datepicker    
                },
            });
            // End Ajax

        });                     
            // end datepicker
        });

      
            //Others
        function yesnoCheck(that)
        {
            if (that.value == "other") {
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }
        // end others

        // CheckBox
        var expanded = false;

            function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
            }
        // End CheckBox
        </script>  
        @endif          
        <!-- @if (count($errors) > 0)
            <script type="text/javascript">
                $( document ).ready(function() {
                    $('#myModal').modal('show');
                });
            </script>
            @endif -->
        <script>
             $(function()
            {
                    $("#close").on('click', function() 
                    {
                        $('#myModal').modal('hide');
                        window.location.reload();
                    });

                    $("#closeX").on('click', function() 
                    {
                        $('#myModal').modal('hide');
                        window.location.reload();
                    });
            
            });
        // <!-- Last Checkpoint March 29, 2023 For Update Time -->
        $(function()
        {
            $("#yes").on('click', function()
            {
                $('#doctor').toggle();
                $('#option').hide();
            }); 
            
            $("#no").on('click', function()
            {
                var doctorId = $("input[name='doctorId']").val();
                var title = $('#doctorName').val();
                // ..Start of Ajax GET
                $.ajax({
                    type: 'GET',
                    url: "{{route('booking.editTime')}}",
                    data: {doctorId},
                    success:function(data)
                    {
                        var op = data.map(function(item)
                        {
                        return item.app_date;
                        });
        
                        console.log(op)
                        // console.log(available)
                        $('#myModal').modal({backdrop: 'static', keyboard: false});
                        $('#myModal').find('#title').text(title);
                        $("#myModal").modal('show');

                        $("#datepicker").datepicker({
                        dateFormat: 'yy-mm-dd',
                        showButtonPanel: true,
                        altField: "#alternate",
                        altFormat: "mm-dd-yy",
                        minDate: new Date(),
                        beforeShowDay: function(date)
                        {
                            var sdate = moment(date).format('YYYY-MM-DD');

                            if ($.inArray(sdate, op) !== -1) {
                                return [true];
                            }
                            else{
                                return [false,'red']; 
                            }
                        },
                        onSelect: function (date) 
                        {  
                            // start ajax
                        $.ajax({
                            type: 'GET',
                            url: "{{route('booking.editTime')}}",
                            data: {date, doctorId},
                            success: function(data) 
                            {
                                console.log(data)
                                var result = " ";
                                for(var i = 0; i < data.length; i++)
                                {
                                    result += "<div class='form-group col-md-6'> <label class='btn btn-outline-primary'> <input type='radio' id='app_id' class='form-control is-invalid' id='validationServer03'  name='app_id' value='"
                                    + data[i].id +"'required> <span>"
                                    + moment(data[i].time_start, 'HH:mm A').format('hh:mm A') +" - " 
                                    + moment(data[i].time_end, 'HH:mm A').format('hh:mm A')+"</span></label> </div>";
                                }
                                    $('#result').html(result);
                            },
                        });
                        // end ajax                                                         
                        },
                        // End Onselect
                        });
                        // End Date

                    },
                    error:function(error)
                    {

                    }
                });
                // End Of ajax Query GET
                
            }); 
        });
    </script>