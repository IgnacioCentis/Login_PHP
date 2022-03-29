<?php
     require("../includes/functions.php");
     $db = db::connect();	
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
     $status =true;
     $query = "INSERT INTO `user`(`dni`, `password`, `user_name`, `status`)
                 VALUES ('%s','%s','%s','%s')";
    $db->execute($query,array($_POST['dni'],$password,$_POST['user_name'],$_POST['status']));
    $status = $status  && $db->estado();

   
    echo json_encode(array('status'=>$status));
?>