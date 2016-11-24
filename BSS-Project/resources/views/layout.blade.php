<!DOCTYPE html>
<html>
    <head>
        <title>BSS Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
        <style src="{{ asset('/fonts/font-awesome/css/font-awesome.css') }}"></style>
        <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}">
        <script src="{{ asset('/js/jquery-ui.js') }}"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="{{ asset('/css/jquery-ui-slider-pips.css')}}">
        <script src="{{ asset('/js/jquery-ui-slider-pips.js')}}"></script>
        <style type="text/css">
        	@font-face {
        		font-family: 'PlayRegular'; 
        		src: url('{{asset('/fonts/Play-Regular.ttf') }}'), url('{{asset('/fonts/Play-Regular.woff') }}'); 
        	}
        </style>
        @yield('otherDependencies')
    </head>
    <body>
        <div id="wrapper">
            @yield('content')
        </div>
    </body>
</html>