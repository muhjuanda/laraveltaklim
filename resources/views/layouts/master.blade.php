<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
</head>
<body>
	<header>
		<nav>
			<a href="/">Home</a>
			<a href="/blog">Blog</a>
		</nav>
	</header>
	<br>
	@yield('content')
	<br>
	<footer>
		<p>
			&copy; Laravel 2016
		</p>
	</footer>
</body>
</html>