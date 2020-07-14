<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title', 'Admin')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body @yield('body_class')>
</body>
@yield('contents')
@yield('scripts')
</html>