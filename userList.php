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
		<title>Buscar </title>
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
                                <h2 style='margin-bottom: 2%!Important;margin-top: 2%;'>Lista de usuarios</h2>
                            </header>		
							<div class="row gtr-uniform">
								<div class="col-8 col-6-xsmall">
									<input type="text" id="find" placeholder="Ingrese su busqueda"/>	
								</div>
								<div class="col-4 col-2-xsmall">
									<button type="button" class="button primary icon fa-search" style="margin-left: 25%; " id='search'>Buscar</button>										
								</div>	
							
							</div><hr>  
                            <table   >
                                <thead style="border-bottom-color: red;" > 
                                    <tr><th>DNI</th><th>NOMBRE</th><th>ESTADO</th><th cospan="2">OPCIONES</th></tr></thead>
                                    <tbody id='tableUser'> 
                                    </tbody>
                                    
                            </table>
                         						
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
        $('#search').on('click',function(){
            document.getElementById('tableUser').innerHTML = "";
            var find = $('#find').val();
            $.ajax({
                type:'POST',
                url:'modules/usersActions.php',
                dataType: "json",
                data:{find:find,action:"userList"},
                success:function(data){
                    if(data.status){
                        console.log(JSON.parse(JSON.stringify(data.userResult)))
                        data.userResult.forEach(item=>{
                            $("#tableUser").append( `<tr><td> ${item.dni} </td>
                                                        <td> ${item.user_name} </td>
                                                        <td> ${item.user_status}</td>
                                                        <td> <button   id="${item.pkuser}" class="suspend small" title= "cambiar de estado">${item.newStatus} </button></td>
                                                        <td> <button  id="${item.pkuser}" class="delete primary small" title="Eliminar usuario">X</button></td></tr>` ) 
                        })
                    }else{ console.log(data.userResult)
                        alert("Usuarios no encontrado");
                    } 
                }
            });
        });

        $(document).on('click', '.suspend',function(){
            if(confirm("Esta a punto de cambiar el estado del usuario. Continuar?")){
                var find =$(this).prop( "id" )
                $.ajax({
                    type:'POST',
                    url:'modules/usersActions.php',
                    dataType: "json",
                    data:{user:find, action:"userSuspend"},
                    success:function(data){
                        if(data.status){  
                            
                            $('#search').trigger("click")
                        }else{  
                            alert("Error! ");
                            
                        } 
                    }
                });
            }

        })

        $(document).on('click', '.delete',function(){
            if(confirm("Esta a punto de eliminar el usuario. Continuar?")){
                var find =$(this).prop( "id" )
                $.ajax({
                    type:'POST',
                    url:'modules/usersActions.php',
                    dataType: "json",
                    data:{user:find, action:"userDelete"},
                    success:function(data){
                        if(data.status){         
                            $('#search').trigger("click")
                        }else{  
                            alert("Error! ");
                            
                        } 
                    }
                });
            }

        })
	})
</script>