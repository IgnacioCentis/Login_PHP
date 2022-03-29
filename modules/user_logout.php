<?php
	session_start();
	include_once('../includes/functions.php');
	
	if ( isset($_SESSION['ID'])){
		session_destroy();
		$db = db::connect();	
	
		$query = "SELECT `pkuser_log` FROM  `user_log` WHERE `fkuser`= '%s' ORDER BY pkuser_log DESC LIMIT 1";
		$db->execute($query,array($_SESSION['ID']));   
		$userLog =$db->fetch_array();
		$query = "UPDATE `user_log` SET `logout` = NOW() WHERE `pkuser_log` ='%s'";
		$db->execute($query,array($userLog[0]['pkuser_log'])); 						
		mysql_close();
	 
	}
	header("Location: ../index.php");
	
?>
