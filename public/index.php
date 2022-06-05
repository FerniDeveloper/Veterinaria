<?php
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Proyecto Veterinaria</title>
	<?php require("assets/include/head.php"); ?>
</head>
<body>
	<?php include("assets/include/preloader.php"); ?>
	
	<?php require("assets/include/header.php"); ?>

	<?php require("assets/include/sidebar.php"); ?>
	
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Bienvenido de vuelta <div class="weight-600 font-30 text-blue"><?=$_SESSION['VSPINT']['nombre']?></div>
						</h4>
						<p class="font-18 ">Desde aquí podrás administrar tus pacientes.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-wrap pd-20 mb-20 card-box">
			Pagina para Veterinaria hecho por <a href="https://github.com/Proyecto-Veterinaria-SSPIS22A" target="_blank">Proyecto Veterinaria</a>
		</div>
	</div>
	
	<!-- js -->
	<?php require("assets/include/jsfooter.php"); ?>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
	
</body>
</html>
