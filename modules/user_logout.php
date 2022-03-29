<?php

	session_start();
	include_once('../includes/functions.php');
	
	if (isset($_SESSION['KEY']) && isset($_SESSION['ID'])){
	
		$key    = $_SESSION['KEY'];
		$userid = $_SESSION['ID'];
	
		session_destroy();
	
		$fecha    = gmdate('Y-n-j H:i:s');
		$connect  = db_connect('mlogin');
			
		//Si se conecto a la db
		if ($connect === true){					
			$logoutquery = sprintf("UPDATE `user_log` SET `logout` = '".$fecha."' WHERE `pkuser_log` = (SELECT `fkuser_log`
										FROM `user_sess` WHERE `fkusuario` = '%s' );" , mysql_real_escape_string($userid));							 
			$logout = @mysql_query($logoutquery);	
			$keysess = sprintf("DELETE FROM `usuarios_sess` WHERE `fkusuario` = '%s';", mysql_real_escape_string($userid));
			$keyout = @mysql_query($keysess);		
			mysql_close();
		}
	}
	header("Location: ../index.php");
	
?>
<html>
	<body>
	</body>
</html>
