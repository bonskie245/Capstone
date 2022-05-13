@component('mail::message')

Dear {{$mailData['fName']}} {{$mailData['lName']}} ,
<p>Thank you for your booking your appointment with Urgent care Medical Clinic</p>

<p>The details of your appointment:</p>
Date & Time:{{$mailData['app_date']}}, {{$mailData['time_start']}} - {{$mailData['time_end']}} <br>
with: Dr. {{$mailData['doctor_fName']}} {{$mailData['doctor_lName']}}
<br>
Where: Urgent Care Clinic. Valencia City, Bukidnon.
@endcomponent