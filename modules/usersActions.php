<?php

    require("../includes/functions.php");
    session_start();  

        $db = db::connect();	
        
        switch($_POST['action']){
            case 'userList':
                $query = "SELECT pkuser,dni,user_name, 
                            CASE WHEN user_status = 0 THEN 'ELIMINADO' 
                                WHEN user_status = 1 THEN 'ACTIVO' 
                                ELSE 'SUSPENDIDO' END as user_status,
                            CASE WHEN user_status = 0 THEN 'ACTIVAR' 
                                WHEN user_status = 1 THEN 'SUSPENDER' 
                                ELSE 'ACTIVAR' END as newStatus
                            FROM `user` WHERE ".($_POST['find'] !=''?" `user_name` = '%s' OR dni = '%s'":"1");
                $db->execute($query,array($_POST['find'],$_POST['find']));
                $userResult =$db->fetch_array();    
                $status = $db->estado();
                echo json_encode(array('userResult'=>$userResult,'status'=>$status));

                break;

            case 'userSuspend':
              
                $query = "SELECT pkuser,dni,user_name, CASE WHEN user_status = 1 THEN 2 ELSE 1 END as newStatus 
                            FROM `user` WHERE pkuser ='%s'";
                $db->execute($query,array($_POST['user']));   
                $userResult =$db->fetch_array(); 
               
                $status =true;
                $query = "UPDATE `user` SET  `user_status`='".$userResult[0]['newStatus']."'  WHERE pkuser = '%s'";
                $db->execute($query,array($_POST['user']));
                $status = $status  && $db->estado();
                echo json_encode(array('status'=>$status));

                break;

            case 'userDelete':
                $status =true;
                $query = "DELETE FROM `user` WHERE `pkuser` = '%s'";
                $db->execute($query,array($_POST['user']));  
                $status = $status  && $db->estado(); 
                echo json_encode(array('status'=>$status));
                break;

            case 'userAdd':

                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $status =true;
                $query = "INSERT INTO `user`(`dni`, `password`, `user_name`, `user_status`)
                            VALUES ('%s','%s','%s','%s')";
                $db->execute($query,array($_POST['dni'],$password,$_POST['user_name'],$_POST['user_status']));
                $status = $status  && $db->estado();
                echo json_encode(array('status'=>$status));
                break;
        }
       
?>