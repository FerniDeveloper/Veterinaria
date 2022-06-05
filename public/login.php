<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Proyecto Veterinaria</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/veterinario32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/veterinario16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/Servicios-vectores-consulta-integral.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Iniciar sesión</h2>
						</div>
							
							<div class="input-group custom">
								<input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Nombre de usuario">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" id="pss" name="pss" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button class="btn btn-primary btn-lg btn-block" id="ingresar" >Iniciar sesion</button>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="assets/js/funciones.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
	enterClick('username','ingresar');
		enterClick('pss','ingresar');
        $(document).ready(function() {

          $('#ingresar').on('click', function() {
            $("#ingresar").attr("disabled", "disabled");
            var username = $('input[name="username"]').val();
            var pss = $('input[name="pss"]').val();
               
            data = new FormData();
            data.append('username', username);
            data.append('pss', pss);


            if((username!="") && (pss!="")){
              $.ajax({
                url: "controller/login",
                type: "POST",
                data:data,
                enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,
                cache: false,
                success: function(dataResult){
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                      $("#ingresar").removeAttr("disabled");
                        window.location.href="index";
                        
                      
                    
                  }else if (dataResult.statusCode==201) {
                    $("#ingresar").removeAttr("disabled");
                    
                        alertae('Hubo un error, reintentalo de nuevo más tarde');
                  }else if (dataResult.statusCode==202) {
                    $("#ingresar").removeAttr("disabled");
                    
                        alertae('La contraseña que ingresaste no es la correcta');
                        
                  }else if (dataResult.statusCode==203) {
                    $("#ingresar").removeAttr("disabled");
                        alertae('No existe el usuario que ingresaste');
                  }
                }
              });
            }else{
              alertae('Todos los campos son obligatorios');
              $("#ingresar").removeAttr("disabled");
            }
          });
        });
  	</script>
</body>
</html>