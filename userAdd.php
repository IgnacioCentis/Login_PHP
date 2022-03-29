<?php
	session_start();   
	require('includes/menu.php');
	if (empty($_SESSION['ID'])){
		header("Location: index.php");
	}	
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Agregar </title>
		<link rel="icon" type="image/png" href="images/house.png" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script> 
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/skel-viewport.min.js"></script>
		<script src="assets/js/util.js"></script>	
		<script src="assets/js/main.js"></script> 

	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">
				<div id="main">
					<div class="inner">
							<?php listaHeader(); ?>
                            <header class="main">
                                <h2 style='margin-bottom: 2%!Important;margin-top: 2%;'>Registrar nuevo usuario</h2>
                            </header>		
							<form id="formSave" method="post">
                                <div class="row gtr-uniform">
                                    <div class="col-6 col-8-xsmall">
                                        <input type="text" name="dni" id="dni" placeholder="DNI"/>	
                                    </div>
                                    <div class="col-6 col-8-xsmall">
                                        <input type="text" name="user_name" id="user_name" placeholder="NOMBRE"/>	
                                    </div>
                                    <div class="col-6 col-8-xsmall">
                                        <input type="password" name="password" id="password" placeholder="PASSWORD" />	
                                    </div>
                                    <div class="col-6 col-8-xsmall">
                                        <select type="text" name="status" id="user_status" />
                                            <option value="1"> ACTIVO</option>
                                            <option value="2"> SUSPENDIDO</option>
                                        </select>	
                                    </div>
                                    <div class="col-12">
                                           <button type="submit" id="send" class="primary large" title="Agregar nuevo usuario!">REGISTRAR</button>
                                    </div>
                                </div>   
                            </form>					
					</div>
				</div>

				<!-- Sidebar -->
                <div id="sidebar">
                    <div class="inner">		
                        <!-- Menu -->
                        <?php listaMenu(); ?>						
                    </div>
                </div>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/jquery-ui.js"></script>
 			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){	
        $('#formSave').submit(function(e){
            
            if (confirm("Desea registrar el usuario?")){
                e.preventDefault();
                $.ajax({
                    type:"POST",
                    url:"modules/usersActions.php",
                    dataType: "json",
                    data: {
                            dni:$('#dni').val(),
                            user_name:$('#user_name').val(),
                            password:$('#password').val(),
                            user_status:$('#user_status').val(),
                            action:"userAdd"},
                    success: function(data)
                    {
                       // var data = JSON.parse(response);
                        if(data.status){  
                            alert("Registro de usuario exitoso!")
                            location. reload()
                        }else{ console.log(data.status)
                            alert("Error! No se pudo registra, verifique los campos cargados.");
                        } 
                    }
                })
            }
        })
	})
</script>