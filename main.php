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
		<title>Bienvenido</title>
		<link rel="icon" type="image/png" href="images/login_icon.png" />
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
		<div id="wrapper">
			<!-- Main -->
				<div id="main">
					<div class="inner">
						<!-- Header -->
							<?php listaHeader(); ?>
						<!-- Banner -->
							<section id="banner">
								<div class="content">
									<header>
										<h2>Bienvenido <?php echo $_SESSION['USERNAME'];?><h2>
										<img class="image object" src="images/intranet.jpg" alt="" />
									</header>
								</div>
							</section>								
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

	</body>
</html>
