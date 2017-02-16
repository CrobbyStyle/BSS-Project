@extends('layout')

@section('otherDependencies')
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
@endsection

@section('content')
<script>
	console.log('<?php echo $valTemp ?>');
    $(function(){
        // $("#tempSlider").slider({animate:"slow", min:-50, max: 50})
        $("#tempSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"}).slider("option", "value", '<?php echo $valTemp ?>');
        $("#humiSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"}).slider("option", "value", '<?php echo $valHumi ?>');
        // $("#noisSlider").slider({animate:"slow", max: 180, step: 5})
        $("#noisSlider").slider({animate:"slow"}).slider("float").slider("pips",{first:"pip",last:"pip"}).slider("option", "value", '<?php echo $valNois ?>');
        // $("#voicSlider").slider({animate:"slow", min: 250, max: 3000, step: 50})

		$("#clockSlider").slider({animate:"slow", max: 60}).slider("float").slider("pips",{first:"pip",last:"pip"}).slider("option", "value", '<?php echo $valClock ?>');
    });
	window.onload = 
	  function move() {
		var elem1 = document.getElementById("myBar1"); 
		var elem2 = document.getElementById("myBar2"); 
		var elem3 = document.getElementById("myBar3"); 
		//var elem4 = document.getElementById("myBar4"); 
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
		
		//var width4 = 1;
		//var id4 = setInterval(frame4, 1);
		function frame4() {
			if (width >= 45) {
				//clearInterval(id4);
			}else {
				width++; 
				//elem4.style.width = width + '%'; 
			}
		}

		
	};

	$(document).ready(function(){
    	document.getElementById("defaultOpen").click();
    });

    function openTab(evt, tabID) {
	    // Declare all variables
	    var i, tabcontent, tablinks;

	    // Get all elements with class="tabcontent" and hide them
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	        tabcontent[i].style.display = "none";
	    }

	    // Get all elements with class="tablinks" and remove the class "active"
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	        tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }

	    // Show the current tab, and add an "active" class to the link that opened the tab
	    document.getElementById(tabID).style.display = "block";
	    evt.currentTarget.className += " active";
	}
	
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
        //var val4 = data.message.split(",")[3];

        var elem1 = document.getElementById("myBar1"); 
        var elem2 = document.getElementById("myBar2"); 
        var elem3 = document.getElementById("myBar3"); 
        //var elem4 = document.getElementById("myBar4");

        var label1 = document.getElementById("label1");				
		var label2 = document.getElementById("label2");
		var label3 = document.getElementById("label3");				 
		//var label4 = document.getElementById("label4");
		

		elem1.style.width = val1 + '%';
		elem2.style.width = val2 + '%';
		elem3.style.width = val3 + '%';
		//elem4.style.width = val4 + '%';

		label1.innerHTML = val1;
		label2.innerHTML = val2;
		label3.innerHTML = val3;
		//abel4.innerHTML = val4;
		console.log(val2);

		$.ajax({
			type: "POST",
			url: "/recibirMensajePush",
			data: { 
				"valorTemp": val1,
				"valorHumi": val2,
				"valorNois": val3
			},
			success: function(){
				console.log("Pusher Event Triggered");
			},
			error: function(xhr){
				console.log(xhr.responseText);
			}
		})

        // listItem.html(data.message);
        // $('#messages').prepend(listItem);
    }

</script>
	
    <div  class="container">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="cabecera">
			<div class="logo">
				<img src="{{ asset('/bss.png') }}" style="padding-top:10px;max-width:70px; height:auto;">
			</div>
			<div class="content">
				<div class="title">Breaktime Sensing System - BSS</div>
			</div>
		</div>
		<ul class="tab">
		  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'Main')" id="defaultOpen">Main</a></li>
		  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'Controls')">Controls</a></li>
		  <li><a href="javascript:void(0)" class="tablinks" onclick="openTab(event, 'About')">About</a></li>
		</ul>
		<div id="Main" class="tabcontent">
			<table width="100%" style="padding-top: 3%;padding-left: 5%;padding-right: 5%;">
				<tr>
					<td class="status" >
						<h5 style="text-align: center; color: #065a54;">Office Status</h5>
						<div style="border: 1px solid #065a54;" width="100%" >
							<table width="100%" style="padding-top: 5%;padding-left: 3%;padding-right: 3%;padding-bottom: 5%;">	
								<td>
									<tr style="height:5%">
										<td style="width:95%; padding-bottom:10px" >
											<div id="myProgress" style="height:20px">
											  <div id="myBar1"> <div id="label1" style="height:20px; text-align:center; line-height:20px">32</div></div>
											 
											</div>
										</td>
										<td style="width:5%; color:#065a54;"> ºC
										</td>
									</tr>
									<tr>
										<td style="width:95%; padding-bottom:10px" >
											<div id="myProgress" style="height:20px">
											  <div id="myBar2"><div id="label2" style="height:20px; text-align:center; line-height:20px">22</div></div>
											  
											</div>
										</td>
										<td style="width:5%; color:#065a54;"> %
										
										</td>
									</tr>
									<tr>
										<td style="width:95%; padding-bottom:10px" >
											<div id="myProgress" style="height:20px">
											  <div id="myBar3"> <div id="label3" style="height:20px; text-align:center; line-height:20px">60</div></div>
											 
											</div>
										</td>
										<td style="width:5%; color:#065a54;"> Db
										</td>
									</tr>
									<!-- <tr>
										<td style="width:95%; padding-bottom:10px" >
											<div id="myProgress" style="height:20px">
											  <div id="myBar4"><div id="label4" style="height:20px; text-align:center; line-height:20px">45</div></div>
											  
											</div>
										</td>
										<td style="width:5%; color:green;"> Hz
										</td>
									</tr> -->
								</td>
							</table>
						</div>
						
					</td>
				
			</table>
		</div>
		<div id="Controls" class="tabcontent">
			<table width="70%" style="padding-top: 3%; padding-left: 5%; padding-right: 5%;">
				<tr>
				<td rowspan="2" class="controls" >
				<h5 style="text-align: center; color: #065a54;">Default Initial Parameters</h5>
				
				<div style="border: 1px solid #065a54;" width="100%" >
				
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
							<td style="width:5%; color:#065a54;"> ºC
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
							<td style="width:5%; color:#065a54;"> %
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
							<td style="width:5%; color:#065a54;"> Db
							</td>
						</tr>
						<!-- <tr>
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
						</tr> -->
						<tr>
							<td style="width:10%;" >
								<img  src="{{ asset('/5.png') }}" style="width:100% ; height:auto;">
							</td>
							<td style="width:85%;" >
								<div id="clockControl" style=" padding-top: 3%; padding-left: 5%; padding-right: 5%;">
									<div id="clockSlider"></div>
								</div>
							</td>
							<td style="width:5%; color:#065a54;"> min
							</td>
						</tr>
					 </td>		 
				</table>
				</div>
				</td>
				
			</tr>
			</table>
		</div>
<!-- 		<ul id="messages" class="list-group"> -->

		</br>
		
        <script>
        $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('input[name="_token"]').val()
	        }
	    });
	    var temp;
	    var humi;
	    var nois;
	    //var voic;
	    var clock;

        	$(document).ready(function(){
        		
        		
			    
				$("#tempSlider").slider({ change: function(event, ui){
					humi = $('#humiSlider').slider("option", "value");
				    nois = $('#noisSlider').slider("option", "value");
				    //voic = $('#voicSlider').slider("option", "value");
				    clock = $('#clockSlider').slider("option", "value");
					console.log(ui.value);
					$.ajax({
						type: "POST",
						url: "/guardarConfiguracion",
						data: { 
							"valorTemp": ui.value,
							"valorHumi": humi,
							"valorNois": nois,
							"valorClock": clock
						},
						success: function(){
							console.log("Se grabo");
						}
					})
				} });
		        $("#humiSlider").slider({ change: function(event, ui){
		        	temp = $('#tempSlider').slider("option", "value");
				    nois = $('#noisSlider').slider("option", "value");
				    //voic = $('#voicSlider').slider("option", "value");
				    clock = $('#clockSlider').slider("option", "value");
					console.log(ui.value);
					$.ajax({
						type: "POST",
						url: "/guardarConfiguracion",
						data: { 
							"valorTemp": temp,
							"valorHumi": ui.value,
							"valorNois": nois,
							"valorClock": clock
						},
						success: function(){
							console.log("Se grabo");
						}
					})
		        }});
		        $("#noisSlider").slider({ change: function(event, ui){
		        	temp = $('#tempSlider').slider("option", "value");
				    humi = $('#humiSlider').slider("option", "value");
				    //voic = $('#voicSlider').slider("option", "value");
				    clock = $('#clockSlider').slider("option", "value");
					console.log(ui.value);
					$.ajax({
						type: "POST",
						url: "/guardarConfiguracion",
						data: { 
							"valorTemp": temp,
							"valorHumi": humi,
							"valorNois": ui.value,
							"valorClock": clock
						},
						success: function(){
							console.log("Se grabo");
						}
					})
		        }});
		   //      $("#voicSlider").slider({ change: function(event, ui){
		   //      	temp = $('#tempSlider').slider("option", "value");
				 //    nois = $('#noisSlider').slider("option", "value");
				 //    humi = $('#humiSlider').slider("option", "value");
				 //    clock = $('#clockSlider').slider("option", "value");
					// console.log(ui.value);
					// $.ajax({
					// 	type: "POST",
					// 	url: "/guardarConfiguracion",
					// 	data: { 
					// 		"valorTemp": temp,
					// 		"valorHumi": humi,
					// 		"valorNois": nois,
					// 		"valorVoic": ui.value,
					// 		"valorClock": clock
					// 	},
					// 	success: function(){
					// 		console.log("Se grabo");
					// 	}
					// })
		   //      }});
				$("#clockSlider").slider({ change: function(event, ui){
		        	temp = $('#tempSlider').slider("option", "value");
				    nois = $('#noisSlider').slider("option", "value");
				    //voic = $('#voicSlider').slider("option", "value");
				    humi = $('#humiSlider').slider("option", "value");
					console.log(ui.value);
					$.ajax({
						type: "POST",
						url: "/guardarConfiguracion",
						data: { 
							"valorTemp": temp,
							"valorHumi": humi,
							"valorNois": nois,
							"valorClock": ui.value
						},
						success: function(){
							console.log("Se grabo");
						}
					})
		        }});

			});
        </script>
    </div>
@endsection