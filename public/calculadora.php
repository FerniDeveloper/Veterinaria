<!DOCTYPE html>
<html>
<head>
	<title>Veterinaria - Cálculo de dosis</title>
	<?php require("assets/include/head.php"); ?>
	<link rel="stylesheet" type="text/css" href="assets/css/radio.css">
</head>
<body>
	<?php include("assets/include/preloader.php"); ?>
	
	<?php require("assets/include/header.php"); ?>

	<?php require("assets/include/sidebar.php"); ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Calculadora</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index">Inicio</a></li>
								<li class="breadcrumb-item active" aria-current="page">Calculadora</li>
							</ol>
						</nav>
					</div>
				
				</div>
			</div>


			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
				  <div class="pull-left">
					<h4 class="text-blue h4">Calculadora</h4>
					<p class="mb-30">Por favor llenar los campos</p>
				  </div>
		
				</div>
				

				<div class="row">
					
		            <div class="col-md-3 wrapper col-sm-12">
		             <input type="radio" onclick="cambiaM('mg','kg','Miligramos')" name="select" id="option-1" checked>
		             <input type="radio" onclick="cambiaM('ml','lt','Mililitros')" name="select" id="option-2">
		               <label for="option-1" class="option option-1">
		                 <div class="dot"></div>
		                  <span>Miligramos</span>
		                  </label>
		               <label for="option-2" class="option option-2">
		                 <div class="dot"></div>
		                  <span>Mililitros</span>
		               </label>
		            </div>
					<div class="col-md-2 col-sm-12">
						<div class="form-group">
							<label>Peso <font id="pesoL">(kg)</font></label>
							<input id="peso" type="text" value="" name="demo3">
						</div>
					</div>
					<div class="col-md-2 col-sm-12">
						<div class="form-group">
							<label>Dosis <font id="dosisL">(mg/kg)</font></label>
							<input id="dosis" type="text" value="" name="demo3">
						</div>
					</div>
					<div class="col-md-2 col-sm-12">
						<div class="form-group">
							<label id="concL">Miligramos</label>
							<input id="conc" type="text" value="" name="demo3">
						</div>
					</div>
		            <div class="col-md-1 wrapper col-sm-12">
          				<button type="button" onclick="calcDosis()" class="btn btn-success">Calcular</button>
		            </div>
					<div class="col-md-2 col-sm-12">
		              <div class="form-group">
		                <label>Medicamento (concentrado del producto)</label>
		                <input type="text" class="form-control" id="mediCalc" name="">
		              </div>
		            </div>

				</div>
	
		</div>
	<?php require("assets/include/developby.php"); ?>
		
	</div>
	<?php require("assets/include/jsfooter.php"); ?>
  <!-- bootstrap-tagsinput js -->
  <script src="src/plugins/fancybox/dist/jquery.fancybox.js"></script>
  <script src="src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
  <script src="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
  <script src="vendors/scripts/advanced-components.js"></script>
  <script type="text/javascript">
  	var mm = "mg.";
    function cambiaM(k,p,m) {
      mm = k+".";
      $('#dosisL').html('('+k+'./kg.)');
      $('#concL').html(m+' (concentrado del producto)');
    }
  
    function calcDosis() {
      var peso = $('#peso').val();
      var dosis = $('#dosis').val();
      var conc = $('#conc').val();
      if (isNaN((peso*dosis)/conc)) {
      	alertae('Hay un error al calcular las dosis, revisa los datos registrados');
      }else{
      	$('#mediCalc').val((peso*dosis)/conc+" "+mm);
      }
    }
  </script>
</body>
</html>
