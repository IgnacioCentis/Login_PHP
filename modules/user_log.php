<?php
        require("../includes/functions.php");
        session_start();  
        $db = db::connect();
        $estado =false;

        //Posibles Errores
        define('ER1', 'ER1: No existe el usuario.', true);
        define('ER2', 'ER2: La contraseña es invalida.', true);	
        define('ER3', 'ER3: No se pudo establecer la conexión.', true);		
        define('ER5', 'ER5: La cuenta se encuentra deshabilitada.', true);

        $user = trim(@$_POST['user']);  
	    $pass = trim(@$_POST['pass']);

        if (!empty($pass) && !empty($user)){
            $query = "SELECT * FROM `user` WHERE `dni`='%s'";
            $db->execute($query,array($user));
            $userDB =$db->fetch_array();
            $userDB = $userDB[0];
            if($db->num_rows() >0){
                if ($userDB['user_status'] == 1 ){
                    if(password_verify($pass,$userDB['password'])){
                        $loginDate = gmdate('Y-n-j H:i:s');
                        if (getenv("HTTP_X_FORWARDED_FOR")){
                            $ip = getenv("HTTP_X_FORWARDED_FOR");
                        } else {
                            $ip = $_SERVER['REMOTE_ADDR'];
                        }
                        $holas = 'aca';   
                        $localhost = gethostbyaddr($ip);
                        $browser = $_SERVER['HTTP_USER_AGENT'];                     
                        $query = "INSERT INTO `user_log` (`fkuser` ,`ip` ,`localhost` ,`browser`  ,`logout`)
                                     VALUES ('%s', '%s', '%s', '%s', '%s');";
                        $db->execute($query,array($userDB['pkuser'],$ip,$localhost,$browser,'0000-00-00 00:00:00'));
                        $estado = $db->estado();
                        if ($estado){
                            $_SESSION['ID']        		 = $userDB['pkuser'];
                            $_SESSION['USERNAME']	  	 = $userDB['user_name'];
                        }else{$error = ER3;}
                        
                    }else{
                        //LA PASS NO COINCIDE
                        $error=ER2;
                    }
                }else{
                //CUENTA SUSPENDIDA
                $error=ER5;
            }
        }else{
            //USUARIO NO EXISTE
            $error=ER1;
        }
    }

    if($estado){
        
        header("Location: ../main.php");
    }else{
        
        header("Location: ../index.php?error=".$error);
    }
?>