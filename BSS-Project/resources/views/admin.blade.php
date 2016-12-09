@extends('layout')

@section('otherDependencies')
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
@endsection

@section('content')
<script>
    $(function(){
        $("#tempSlider").slider({animate:"slow", min:-50, max: 50}).slider("float").slider("pips",{first:"pip",last:"pip"});
        $("#humiSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"});
        $("#noisSlider").slider({animate:"slow", max: 180, step: 5}).slider("float").slider("pips",{first:"pip",last:"pip"});
        $("#voicSlider").slider({animate:"slow", min: 250, max: 3000, step: 50}).slider("float").slider("pips",{first:"pip",last:"pip"});
		$("#clockSlider").slider({animate:"slow", max: 60}).slider("float").slider("pips",{first:"pip",last:"pip"});
    });
	window.onload = 
	  function move() {
		var elem1 = document.getElementById("myBar1"); 
		var elem2 = document.getElementById("myBar2"); 
		var elem3 = document.getElementById("myBar3"); 
		var elem4 = document.getElementById("myBar4"); 
		var width = 1;
		var id = setInterval(frame1, 1);
		function frame1() {
			if (width >= 57) {
				clearInterval(id);
			}else {
				width++; 
				elem1.style.width = width + '%'; 
				document.getElementById("label1").innerHTML = width * 1 + '';
			}
		}
		
		var width2 = 1;
		var id2 = setInterval(frame2, 1);
		function frame2() {
			if (width >= 23) {
				clearInterval(id2);
			}else {
				width++; 
				elem2.style.width = width + '%'; 
			}
		}
		
		var width3 = 1;
		var id3 = setInterval(frame3, 1);
		function frame3() {
			if (width >= 71) {
				clearInterval(id3);
			}else {
				width++; 
				elem3.style.width = width + '%'; 
			}
		}
		
		var width4 = 1;
		var id4 = setInterval(frame4, 1);
		function frame4() {
			if (width >= 45) {
				clearInterval(id4);
			}else {
				width++; 
				elem4.style.width = width + '%'; 
			}
		}
		
	};
	
</script>
<script>
            //instantiate a Pusher object with our Credential's key
            var pusher = new Pusher('{{env("PUSHER_KEY")}}');

            //Subscribe to the channel we specified in our Laravel Event
            var channel = pusher.subscribe('my-channel');

            //Bind a function to a Event (the full Laravel class)
            channel.bind('App\\Events\\HelloPusherEvent', addMessage);

            function addMessage(data)
            {

                var listItem = $("<li class='list-group-item'></li>");

                var val1 = data.message.split(",")[0];
                var val2 = data.message.split(",")[1];
                var val3 = data.message.split(",")[2];
                var val4 = data.message.split(",")[3];

                var elem1 = document.getElementById("myBar1"); 
                var elem2 = document.getElementById("myBar2"); 
                var elem3 = document.getElementById("myBar3"); 
                var elem4 = document.getElementById("myBar4");

                var label1 = document.getElementById("label1");				
				var label2 = document.getElementById("label2");
				var label3 = document.getElementById("label3");				 
				var label4 = document.getElementById("label4");
				

				elem1.style.width = val1 + '%';
				elem2.style.width = val2 + '%';
				elem3.style.width = val3 + '%';
				elem4.style.width = val4 + '%';

				label1.innerHTML = val1;
				label2.innerHTML = val2;
				label3.innerHTML = val3;
				label4.innerHTML = val4;

                // listItem.html(data.message);
                // $('#messages').prepend(listItem);
            }
        </script>
	
    <div  class="container">
        <div class="cabecera">
			<div class="logo">
				<img src="{{ asset('/clock.ico') }}" style="max-width:70px; height:auto;">
			</div>
			<div class="content">
				<div class="title">Breaktime Sensing System - BSS</div>
			</div>
		</div>
		<table width="100%" style="padding-top: 3%;padding-left: 5%;padding-right: 5%;">
			<tr>
				<td rowspan="2" class="controls" >
				<h5 style="text-align: center; color: green;">Default Initial Parameters</h5>
				
				<div style="border: 1px solid green;" width="100%" >
				
				<table width="100%" style="padding-top: 5%;padding-left: 3%;padding-right: 3%;padding-bottom: 5%;">	
					<td>				
						<tr>
							<td style="width:10%;" >
								<img  src="{{ asset('/1.png') }}" style="width:100% ; height:auto;">
							</td>
							<td style="width:85%;" >
								<div  id="tempControl" style="padding-top: 2%; padding-left: 5%; padding-right: 5%;">
									<div id="tempSlider"></div>
								</div>
							</td>
							<td style="width:5%; color:green;"> ºC
							</td>
						</tr>
						<tr>
							<td style="width:10%;" >
								<img  src="{{ asset('/3.png') }}" style="width:100% ; height:auto;">
							</td>
							<td style="width:85%;" >
								<div id="humiControl" style=" padding-top: 3%; padding-left: 5%; padding-right: 5%;">
									<div id="humiSlider"></div>
								</div>
							</td>
							<td style="width:5%; color:green;"> %
							</td>
						</tr>
						<tr>
							<td style="width:10%;" >
								<img  src="{{ asset('/2.png') }}" style="width:100% ; height:auto;">
							</td>
							<td style="width:85%;" >
								<div id="noisControl" style="padding-top: 3%; padding-left: 5%; padding-right: 5%;">
									<div id="noisSlider"></div>
								</div>
							</td>
							<td style="width:5%; color:green;"> Db
							</td>
						</tr>
						<tr>
							<td style="width:10%;" >
								<img  src="{{ asset('/4.png') }}" style="width:100% ; height:auto;">
							</td>
							<td style="width:85%;" >
								<div id="voicControl" style="padding-top: 3%; padding-left: 5%; padding-right: 5%;">
									<div id="voicSlider"></div>
								</div>
							</td>
							<td style="width:5%; color:green;"> Hz
							</td>
						</tr>
					 </td>					 
				</table>
				</div>
				</td>
				<td class="status" >
				<h5 style="text-align: center; color: green;">Environmental Status</h5>
				<div style="border: 1px solid green;" width="100%" >
					<table width="100%" style="padding-top: 5%;padding-left: 3%;padding-right: 3%;padding-bottom: 5%;">	
						<td>
							<tr>
								<td style="width:95%;" >
									<div id="myProgress">
									  <div id="myBar1"> <div id="label1">32</div></div>
									 
									</div>
								</td>
								<td style="width:5%; color:green;"> ºC
								</td>
							</tr>
							<tr>
								<td style="width:95%;" >
									<div id="myProgress">
									  <div id="myBar2"><div id="label2">22</div></div>
									  
									</div>
								</td>
								<td style="width:5%; color:green;"> %
								
								</td>
							</tr>
							<tr>
								<td style="width:95%;" >
									<div id="myProgress">
									  <div id="myBar3"> <div id="label3">60</div></div>
									 
									</div>
								</td>
								<td style="width:5%; color:green;"> Db
								</td>
							</tr>
							<tr>
								<td style="width:95%;" >
									<div id="myProgress">
									  <div id="myBar4"><div id="label4">45</div></div>
									  
									</div>
								</td>
								<td style="width:5%; color:green;"> Hz
								</td>
							</tr>
						</td>
					</table>
				</div>
				
				</td>
			</tr>
			<tr>
			<td class="status" >
				<div style="border: 1px solid green;" width="100%" >
				<h5 style="text-align: center; color: green;">Period time sensing</h5>
					<table width="100%" style="padding-top: 5%;padding-left: 3%;padding-right: 3%;padding-bottom: 5%;">	
						<td>
							<td style="width:10%;" >
								<img  src="{{ asset('/5.png') }}" style="width:100% ; height:auto;">
							</td>
							<td style="width:85%;" >
								<div id="clockControl" style=" padding-top: 8%; padding-left: 5%; padding-right: 5%;">
									<div id="clockSlider"></div>
								</div>
							</td>
							<td style="width:5%; color:green;"> min
							</td>
						</td>
					</table>
				</div>
			</tr>
		</table>
<!-- 		<ul id="messages" class="list-group"> -->

		</br>
		
        
    </div>
@endsection