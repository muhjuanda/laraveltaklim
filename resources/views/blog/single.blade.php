<!DOCTYPE html>
<html>
<head>
	<title>Single</title>
</head>
<body>
		<h1>Selamat Datang di Halaman Blog</h1>
		<h2>{{$blog}}</h2>
		@foreach($users as $user)

		<li> {{$user}} </li>

			
		@endforeach

</body>
</html>