<!DOCTYPE html>
<html>
    <head>
        <title>BSS Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
				background-color: #C8f7C5;
            }

            .container {
                text-align: center;
                vertical-align: middle;
				background-color: #A2DED0;
				width: 70%;
				margin-left: 15%;
				display: inline-block;
				  flex-wrap: nowrap;
				  justify-content: flex-start;
				  align-items: stretch;
				  align-content: stretch;
				height: 100%;
            }

            .content {
                text-align: center;                
            }
			.content2 {
                text-align: center;    
				margin-top: 3%;				
            }
			.content3 {
                text-align: center;    
				margin-top: 7%;	
				background-color: #52D3C2;	
				font-family:"Comic Sans MS", cursive, sans-serif;		
				text-align : justify;		
				
            }
			.parrafo{
				padding-top: 2%;	
				margin-left: 7%;	
				margin-right: 7%;	
				padding-bottom: 2%;	
			}
            .title {
                font-size: 62px;
				margin-top: 3%;
				font-family:"Comic Sans MS", cursive, sans-serif;
				color:#C8f7A0;
				text-shadow: -2px 0 black, 0 2px black, 2px 0 black, 0 -2px black;
				
            }
			
			.button {
			  display: inline-block;
			  border-radius: 8px;
			  background-color: #C8f7A0;
			  border: none;
			  color: #000000;
			  text-align: center;
			  font-family:"Comic Sans MS", cursive, sans-serif;
			  font-size: 28px;
			  padding: 20px;
			  width: 400px;
			  transition: all 0.5s;
			  cursor: pointer;
			  margin: 5px;
			}

			.button span {
			  cursor: pointer;
			  display: inline-block;
			  position: relative;
			  transition: 0.5s;
			}

			.button span:after {
			  content: '>';
			  position: absolute;
			  opacity: 0;
			  top: 0;
			  right: -20px;
			  transition: 0.5s;
			}

			.button:hover span {
			  padding-right: 25px;
			}

			.button:hover span:after {
			  opacity: 1;
			  right: 0;
			}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Breaktime Sensing System</div>
            </div>
			<div class="content2">
				<img src="clock.ico" style="width:150px;height:150px;">
			</div>
			<div class="content2">
				<button class="button" style="vertical-align:middle"><span>Dar click para continuar</span></button>
			</div>
			<div class="content3">
				<P class="parrafo" >Breaktime Sensing System (BSS) fué creado para sensar el ambiente de trabajo y sugerir un receso mediante alertas a los dispositivos conectados a la red. BSS es una propuesta para poder incrementar el desarrollo de una organización mediante el crecimiento de las relaciones interpersonales de los ocupantes del espacio laboral y disminución de estrés al ceder el tiempo a otras actividades recreativas.</P>
			</div>
			
        </div>
    </body>
</html>
