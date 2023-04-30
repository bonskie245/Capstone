<! DOCTYPE html>
<html>
<head>
	<title>Laravel 7 Generate PDF From View Example Tutorial - NiceSnippets</title>
</head>
<body>
    <h1>Welcome to Nicesnippets.com</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    @foreach($bookings as $booking)
    <tr>
      <td>{{$booking->id}}</th>
      <td>{{$booking->user->user_fName}} {{$booking->user->user_lName}}</td>
      <td>{{$booking->app_date}}</td>
      <td>{{$booking->book_reason}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>