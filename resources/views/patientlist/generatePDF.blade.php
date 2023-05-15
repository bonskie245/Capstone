
<! DOCTYPE html>
          <html>
          <head>
            <title></title>
            <link rel="stylesheet" href="{{asset('template/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
          </head>
          <body>
            <style>table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #89CFF0;
  color: white;
}</style>
              <h1>Appointment History</h1>
              <table class="table">
              <thead>
                <tr>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Date</th>
                  <th scope="col">Findings</th>
                  <th scope="col">Charge</th>
                  <th scope="col">Doctor</th>
                </tr>
              </thead>
            <tbody>
              @forelse($bookings as $booking)
              <tr>
                <td>{{$booking->user->user_fName}} {{$booking->user->user_lName}}</td>
                <td>{{date('F j, Y', strtotime($booking->app_date))}}</td>
                <td>{{$booking->pres_findings}}</td>
                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{number_format($booking->charge, 2)}}</td>
                <td>Dr. {{$booking->doctor->user->user_fName}} {{$booking->doctor->user->user_lName}}</td>
              </tr>
              @empty
              <tr>
                <td>No data</td>
              </tr>
              @endforelse
              <tr>
                <td>Total Charge: </td>
                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{number_format($total, 2)}}</td>
              </tr>
            </tbody>
          </table>
          </body>
        <script src="{{asset('template/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</html>
