<?php

function listaHeader(){
	echo '<header id="header" style="padding-bottom: 0!Important;">
				<div >
					 <strong>PRUEBA TECNICA</strong> Login | CRUD Usuarios</a>
				</div>
				<div >
					<label style= " float: right;margin-bottom: 0;">'.$_SESSION["NOMBRE"].'</label>								
				</div>
			</header>';
}


function listaMenu(){
	echo '<nav id="menu">
			<header class="major">
				<h2>Menu</h2>
			</header>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li>
					<span class="opener">Usuarios</span>
					<ul>
						<li><a href="userAdd.php">ALTA</a></li>		
						
						<li><a href="userList.php">LISTADO</a></li>					
					</ul>
				</li>
				<li style="font-style: italic;"><strong><a href="modules/user_logout.php">Cerrar Sesion</a></strong></li>
			</ul>
		</nav>';	
}

?>