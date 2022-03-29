<?php

	session_start(); 
	//Posibles Errores
	define('ER1', 'ER1: No existe el usuario.', true);
	
	// ER2: La contraseña es invalida.
	define('ER2', 'ER2: La contraseña es invalida.', true);
	
	// ER3: No se puede conectar,contacte un administrador.
	define('ER3', 'ER3: No se pudo establecer la conexión.', true);
		
	// ER5: La cuenta se encuentra deshabilitada.
	define('ER5', 'ER5: La cuenta se encuentra deshabilitada.', true);
	
	//HABILITAR LAS SESSIONES
	
	require('../includes/functions.php');

	$respuesta = 2;
	$error  = '';
	
	$user = trim(@$_POST['user']);  
	$pass = trim(@$_POST['pass']); 

	// VALIDAMOS QUE LOS CAMPOS ESTEN COMPLETOS
	if (!empty($user) && (preg_match("/^([a-zA-Z0-9áéíóúÁÉÍÓÚ])+/", $user) === 0) && (strlen($user)> 50) && (strlen($user)< 5)){ 
		$error =ER1;
	}else{
		if (!empty($pass) && (preg_match("/^([a-zA-Z0-9áéíóúÁÉÍÓÚ])+/", $pass) === 0) && (strlen($pass)>= 32) && (strlen($user)<= 6)){	
			$error =ER2;
		}else{	
			// CONECTAMOS A LA DB 
			$connect = db_connect(DB_NAME);
			if ($connect === false){
				$error =ER3;
			}else{
				//CONSULTAMOS SI EXISTE EL USUARIO
				$login_query = sprintf("SELECT * FROM `user` WHERE `dni`='%s';",mysql_real_escape_string($user));		
				$login = @mysql_query($login_query);
				
				if (($login === false) || (mysql_num_rows($login) != 1)){
					$error =ER1;
				}else{
					//SI EXISTE EL USUARIO, VERIFICO LA PASS SEA CORRECTA
					$userDB = mysql_fetch_array($login);
					
					if (!password_verify($pass,$userDB['password'])){
						$error =ER2;
					}else{
						if ($userDB['user_status'] != 1 ){
							$error =ER5;
						}else{
							$loginDate = gmdate('Y-n-j H:i:s');
							if (getenv("HTTP_X_FORWARDED_FOR")){
								$ip = getenv("HTTP_X_FORWARDED_FOR");
							} else {
								$ip = $_SERVER['REMOTE_ADDR'];
							}
							if (substr($ip,0,10)=='192.168.1.'){
								$_SESSION['LOCAL'] =  true;
							}
							$localhost = gethostbyaddr($ip);
							$browser = $_SERVER['HTTP_USER_AGENT'];
							
							//ALMACENAMOS AUDITORIA DE LOGIN
							$logs = sprintf("INSERT INTO `user_log` (`fkuser` ,`ip` ,`localhost` ,`browser` ,`login` ,`logout`)
												VALUES ('%s', '%s', '%s', '%s', '%s', '%s');",
													mysql_real_escape_string($userDB['pkuser']),
													mysql_real_escape_string($ip),
													mysql_real_escape_string($localhost),
													mysql_real_escape_string($browser),
													mysql_real_escape_string($loginDate),
													mysql_real_escape_string('0000-00-00 00:00:00')
													);								
							$saveLogs = @mysql_query($logs);	
							$idlogs = mysql_insert_id();
						
							//BORRAMOS LAS SESSIONES EXISTENTES DE USUARIO
							@mysql_query("DELETE FROM `user_sess` WHERE `fkusuario` = '".$userDB['pkuser']."';");
							
							//GENERAMOS UNA KEY UNICA DE USUARIO
							$key = md5($userDB['pkuser'].$ip.$loginDate);
							
							//entonces alamacenamos los nuevos keys	
							$keylogs = "INSERT INTO `user_sess`(`KEY` ,`fkusuario` ,`fkusuario_log`)
										VALUES ('".$key."', '".$userDB['pkuser']."', '".$idlogs."');";
													
							$saveKeyLog = @mysql_query($keylogs);
							
							if (($saveLogs === false) && ($saveKeyLog === false)){
								$error =ER3;
							}else{								
								$respuesta = 1;	
								$error  = 'Redireccionando...';
								$_SESSION['KEY']     		 = $key;
								$_SESSION['ID']        		 = $userDB['pkuser'];
								$_SESSION['USERNAME']	  	 = $userDB['user_name'];
								$_SESSION['LOG']      		 = $idlogs;
								$_SESSION['DIRECCION'] 		 = $userDB['fkdireccion'];
								//mysql_close();
							}
						}
					}
				}
			}
		}
	}

	
	if ($respuesta == 1){ 
	mysql_close();
		header("Location: ../main.php");

	}else{
	mysql_close();
		header("Location: ../index.php?error=".$error);
	}
?>
