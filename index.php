<?php
	require('includes/functions.php');
	    
	if (!empty($_SESSION['ID'])){
		header("Location: main.php");
	}	
?>
<html>
	<head>
		<title>LOGIN!!</title>
		<meta charset="utf-8" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1" />		
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/loginstyle.css" />
	</head>
	<body>
    	<div id="columna">
			<div class="span4_col">	 
				<form class="login" action="modules/user_log.php" method="POST">
					<div id="login">
						<div id="login_container">
							<!-- Usuario -->
							<img src="images/login_icon.png"  style="margin-left: 35%;width: 25%;">
							<h3 class="login-title" style=" margin-left: 15%;margin-bottom: 5%!important;">ACCESO PRIVADO </h3 >
							<br>
							<span style="margin: 0;color: #8F8F8F;">NOMBRE DE USUARIO</span>
							<input class="login-input" style="width:100%"  name="user" type="text" placeholder="DNI" autofocus="true" >
							<div class="x"></div>
							<!-- Contraseña -->
							<span style="margin: 0;color: #8F8F8F;">CONTRASEÑA</span>
							<input class="login-input" style="width:100%"  name="pass" type="password" placeholder="CONTRASEÑA"/>
							<input class="login-button primary" type="submit" id='acceder'/>
						</div>
					</div>
				</form>	               	 
			</div>     
		</div>	
	</body>
</html>