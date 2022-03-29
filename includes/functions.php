<?php	
	session_start();
	require('class.db.php');
	require_once('config.php');

	function db_connect($db=''){	
		//Conectar a base de datos			
		$connect = @mysql_connect(DB_HOST,DB_USER,DB_PASS);
		if($connect === false){
			return $connect;
		}else{
			if ($db != ''){
				return $selectdb = @mysql_select_db($db,$connect);
			} else {
				return $connect;
			}
		}
	}

	 
?>