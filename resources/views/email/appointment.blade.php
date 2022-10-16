<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Accepted</title>
</head>
<body>
        <h2>Dear {{$mailData['fName']}} {{$mailData['lName']}} ,</h2>
        <p>Thank you for your booking your appointment with Urgent care Medical Clinic</p>

        <p>The details of your appointment:</p>
            <p><strong>Date & Time:</strong>  {{$mailData['app_date']}},  {{date('h:i A', strtotime($mailData['time_start']))}} - {{date('h:i A', strtotime($mailData['time_end']))}} <br>
            <strong>Doctor:</strong> Dr. {{$mailData['doctor_fName']}} {{$mailData['doctor_lName']}}
        <br>
        <strong>Where:</strong> Urgent Care Clinic. Valencia City, Bukidnon.</p>

</body>
</html>