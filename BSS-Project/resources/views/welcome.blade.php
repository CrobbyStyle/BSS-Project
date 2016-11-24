@extends('layout')

@section('otherDependencies')
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
@endsection

@section('content')
	<div class="waves">
		<img id="waves" class="waves" src="{{asset('/waves.gif')}}" />
	</div>
    <div class="container">
    	<div id="background-shape">
        	<p class="right-top-corner">&#9698</p>
        	<p class="right-top">&#9646</p>
        	<p class="right-mid">&#9646</p>
        	<p class="right-bot">&#9646</p>
        	<p class="right-bot-corner">&#9701</p>

        	<p class="left-top-corner">&#9699</p>
        	<p class="left-top" >&#9646</p>
        	<p class="left-mid" >&#9646</p>
        	<p class="left-bot" >&#9646</p>
        	<p class="left-bot-corner">&#9700</p>
    	</div>
        <div class="content">
            <div class="title">Breaktime Sensing System</div>
        </div>
		<div class="content2">
			<img src="{{ asset('/clock.ico') }}" style="width:150px;height:150px;">
		</div>
		<div class="content2">
			<a class="button" style="vertical-align:middle" href="{{url('/admin')}}"><span>Dar click para continuar</span></a>
		</div>		
    </div>
    <footer>
		<div class="content3">
			<P class="parrafo" >Breaktime Sensing System (BSS) fué creado para sensar el ambiente de trabajo y sugerir un receso mediante alertas a los dispositivos conectados a la red. BSS es una propuesta para poder incrementar el desarrollo de una organización mediante el crecimiento de las relaciones interpersonales de los ocupantes del espacio laboral y disminución de estrés al ceder el tiempo a otras actividades recreativas.</P>
		</div>
	</footer>
@endsection
