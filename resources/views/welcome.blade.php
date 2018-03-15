<!doctype html>
<html lang="vi VN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel + VueJS</title>
	<base href="{{ asset('') }}">
    <link rel="icon" href="public/favicon.png" type="image/gif">

    <link href="public/css/app.css" rel="stylesheet">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/custom.css" rel="stylesheet">
    <meta id="csrf-token" name="csrf-token" value="{{ csrf_token() }}">

    <script src="public/js/jquery-3.2.1.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bootstrap-notify.min.js"></script>
</head>
<body>
    <div id="app"></div>

    <script src="public/js/app.js"></script>
</body>
</html>
