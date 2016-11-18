<!DOCTYPE html>
<html>
    <head>
        <title>BSS Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
        <link rel="stylesheet" href="{{ asset('/fonts/font-awesome/css/font-awesome.css') }}">
        <style type="text/css">
        	@font-face {
        		font-family: 'PlayRegular'; 
        		src: url('{{asset('/fonts/Play-Regular.ttf') }}'), url('{{asset('/fonts/Play-Regular.woff') }}'); 
        	}
        </style>
    </head>
    <body>
    	<div class="waves">
    		<img id="waves" class="waves" src="{{asset('/waves.gif')}}" />
    	</div>
        <div class="container">
        	<div id="background-shape">
	        	<p style="position:absolute; right:15%; color:#C8f7C5; font-size: 100px; top:-5%">&#9698</p>
	        	<p style="position:absolute; right:13.8%; color:#C8f7C5; font-size: 210px; top:-16%">&#9646</p>
	        	<p style="position:absolute; right:13.8%; color:#C8f7C5; font-size: 210px; top: 4%">&#9646</p>
	        	<p style="position:absolute; right:13.8%; color:#C8f7C5; font-size: 210px; top: 14%">&#9646</p>
	        	<p style="position:absolute; right:15%; color:#C8f7C5; font-size: 100px; top: 55%">&#9701</p>

	        	<p style="position:absolute; left:15%; color:#C8f7C5; font-size: 100px; top:-5%">&#9699</p>
	        	<p style="position:absolute; left:13.8%; color:#C8f7C5; font-size: 210px; top:-16%">&#9646</p>
	        	<p style="position:absolute; left:13.8%; color:#C8f7C5; font-size: 210px; top: 4%">&#9646</p>
	        	<p style="position:absolute; left:13.8%; color:#C8f7C5; font-size: 210px; top: 14%">&#9646</p>
	        	<p style="position:absolute; left:15%; color:#C8f7C5; font-size: 100px; top: 55%">&#9700</p>
        	</div>
            <div class="content">
                <div class="title">Breaktime Sensing System</div>
            </div>
			<div class="content2">
				<img src="{{ asset('/clock.ico') }}" style="width:150px;height:150px;">
			</div>
			<div class="content2">
				<button class="button" style="vertical-align:middle"><span>Dar click para continuar</span></button>
			</div>		
        </div>
        <footer>
    		<div class="content3">
				<P class="parrafo" >Breaktime Sensing System (BSS) fué creado para sensar el ambiente de trabajo y sugerir un receso mediante alertas a los dispositivos conectados a la red. BSS es una propuesta para poder incrementar el desarrollo de una organización mediante el crecimiento de las relaciones interpersonales de los ocupantes del espacio laboral y disminución de estrés al ceder el tiempo a otras actividades recreativas.</P>
			</div>
    	</footer>
    </body>
</html>
