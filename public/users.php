<?php
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Veterinaria - Usuarios</title>
	
	<?php require("assets/include/head.php"); ?>
</head>
<body>
	



	<?php require("assets/include/preloader1.php"); ?>

	
	<?php require("assets/include/header.php"); ?>

	<?php require("assets/include/sidebar.php"); ?>
	
	<div class="mobile-menu-overlay"></div>

<script type="text/javascript">
	var idA = '';
</script>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<!-- MINI NAVEGACIÓN -->
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4  class="text-blue h4">Usuarios</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index">Inicio</a></li>
								<li class="breadcrumb-item active" aria-current="page">Usuarios</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
        	<div class="col-6">
						<div class="pd-20 card-box mb-30">
		          <div class="x_panel">
		            <div class="pd-20 col-md-12">
		              <h4 class="text-blue h4">Usuarios</h4>
		              <p class="mb-0">Da de alta un nuevo usuario</p>
		          	</div>
		            <div class="col-md-12">
		              <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Username</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" id="username" name="username" class="form-control">
                    </div>
		              </div>
                  <div class="item form-group row">
	                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre completo</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
		              </div>
                  
		              <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo</label>
	                  <div class="col-md-9 col-sm-9">
                    	<select class="custom-select2 form-control" name="tipo" id="tipo" style="width: 100%; height: 38px;">
												<option value="">Selecciona</option>
                    	<?php
	                      $sql="SELECT * FROM net_tipo";
	                      $result = $db->query($sql);
	                      if ($result->num_rows > 0) {
	                        while($row = $result->fetch_assoc()) {
	                          ?>
															<option value="<?=$row['id']?>"><?=$row['nombre']?></option>
	                          <?php
	                        } 
	                      }
	                    ?>
											</select>
                    </div>
		              </div>
                  <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Contraseña</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="password" id="pass" name="pass" class="form-control">
                    </div>
                  </div>

                  <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Repite la contraseña</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="password" id="passc" name="passc" class="form-control">
                    </div>
                  </div>
	                <div class="ln_solid"></div>
	                <div class="item form-group row">
	                  <div class="col-md-9 col-sm-9 offset-md-3">
	                    <button type="button" id="save" class="btn save btn-success">Guardar</button>
	                  </div>
	                </div>
		            </div>
							</div>
						</div>
        	</div>
        	<div class="col-6">
        		<div class="pd-20 card-box mb-30">
							<div class="pd-20 col-md-12">
								<h4 class="text-blue h4">Lista de usuarios</h4>
		            <p class="mb-0">Revisa y edita los usuarios existentes</p>
							</div>
							<div class="col-md-12">
								<table id="lista" class="table hover ">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Nombre completo</th>
                      <th>Tipo</th>
                      <th>Acci&oacute;n</th>
                    </tr>
                  </thead>

                  <tbody id="Contenido">
                    <?php
                      $sql="select *, net.nombre as nombreuser, net_tipo.nombre AS nombretipo from net JOIN net_tipo ON net_tipo.id = net.tipo WHERE elim = 0";
                      $result = $db->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          ?>
                            <tr>
                              <td><?=$row['username']?></td>
                              <td><?=$row['nombreuser']?></td>
                              <td><?=$row['nombretipo']?></td>
                              <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal" type="button" onclick="dataModalUser('<?=$row['username']?>','<?=$row['tipo']?>','<?=$row['nombreuser']?>')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delUser('<?=$row['username']?>')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a></td>
                            </tr>
                          <?php
                        } 
                      }
                    ?>
                  </tbody>
                </table>
							</div>
						</div>
        	</div>
        </div>
      </div>

      <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="Large" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="Large">Editar usuario</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="row">
			          <div class="col-md-12">
	                <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Username</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" disabled id="username1" name="username1" class="form-control">
                    </div>
		              </div>
                  <div class="item form-group row">
	                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre completo</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" id="nombre1" name="nombre1" class="form-control">
                    </div>
		              </div>
                  
		              <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo</label>
	                  <div class="col-md-9 col-sm-9">
                    	<select class="custom-select2 form-control" name="tipo1" id="tipo1" style="width: 100%; height: 38px;">
												<option value="">Selecciona</option>
                    	<?php
	                      $sql="SELECT * FROM net_tipo";
	                      $result = $db->query($sql);
	                      if ($result->num_rows > 0) {
	                        while($row = $result->fetch_assoc()) {
	                          ?>
															<option value="<?=$row['id']?>"><?=$row['nombre']?></option>
	                          <?php
	                        } 
	                      }
	                    ?>
											</select>
                    </div>
		              </div>
                  <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Contraseña</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="password" id="pass1" name="pass1" class="form-control">
                    </div>
                  </div>

                  <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Repite la contraseña</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="password" id="passc1" name="passc1" class="form-control">
                    </div>
                  </div>
		            </div>
	            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="button" id="savee" class="btn save btn-success">Actualizar datos</button>
						</div>
					</div>
				</div>
			</div>

      <!-- /page content -->
    </div>
    <?php include("assets/include/developby.php"); ?>
  </div>
</div>

	<?php require("assets/include/jsfooter.php"); ?>
	<script type="text/javascript">
			$(document).ready(function() {
				$('#lista').DataTable({
					"pageLength": 25
				});
				$("#modal").on('hide.bs.modal', function(){
					$('#username1').val('');
				  $('#tipo1').val('');
				  $('#tipo1').change();
				  $('#nombre1').val('');
				  $('#pass1').val('');
				  $('#passc1').val('');
					idA = '';
				});
				$(".form-control").on('input', function() {
					if ($(this).hasClass('form-control-danger')) {
				    	$(this).removeClass('form-control-danger');
					}
				});
				$(".select2-selection").on('click', function() {
					if ($(this).hasClass('form-control-danger')) {
				    	$(this).removeClass('form-control-danger');
					}
				});
				enterClick('passc','save');
				enterClick('passc1','save');
				enterClick('nombre1','save');
				enterClick('pass1','save');
          $('.save').on('click', function() {
            $(".save").attr("disabled", "disabled");
            var edit = "";
            if (idA != "") {
            	edit = "1";
            }
               
            var username = $('#username'+edit).val();
            var nombre = $('#nombre'+edit).val();
            var tipo = $('#tipo'+edit).val();
            var pass = $('#pass'+edit).val();
            var passc = $('#passc'+edit).val();


            data = new FormData();
            data.append('username', username);
            data.append('nombre', nombre);
            data.append('tipo', tipo);
            data.append('pass', pass);
            data.append('update', idA);
            


	          if(((username != "") && (nombre != "") && (tipo != "") && (pass != "") && (passc != "")) || edit == "1"){
            	if(pass === passc){
	              $.ajax({
	                url: "controller/saveUser",
	                type: "POST",
	                data:data,
	                enctype: 'multipart/form-data',
	                processData: false,  // tell jQuery not to process the data
	                contentType: false,
	                cache: false,
	                success: function(dataResult){
	                  var dataResult = JSON.parse(dataResult);
	                  if(dataResult.statusCode==200){
                      $(".save").removeAttr("disabled");
     									alerta2("El usuario se ha subido correctamente");
     									$('#lista').DataTable().clear();
              				$('#lista').DataTable().destroy();
     									$('#Contenido').html(dataResult.data1);
              				$('#lista').DataTable({
												"pageLength": 25
											});
	                    
	                  }else if (dataResult.statusCode==201) {
	                    $(".save").removeAttr("disabled");
                    	$('#modal').modal('toggle');
                      alerta2("El usuario se ha actualizado correctamente");
     									$('#lista').DataTable().clear();
              				$('#lista').DataTable().destroy();
     									$('#Contenido').html(dataResult.data1);
              				$('#lista').DataTable({
												"pageLength": 25
											});
	                        
	                  }else if (dataResult.statusCode==202) {
	                    $(".save").removeAttr("disabled");
	                    alertae('Ha ocurrido un error intentalo de nuevo más tarde');
	                  }
	                }
	              });
	            }else{
	            	$('#pass').addClass("form-control-danger");
								$('#passc').addClass("form-control-danger");
	              alertae('Las contraseñas que ingresaste no coinciden');
	              $(".save").removeAttr("disabled");
	            }
            }else{
            	if (username == "") {
            		$('#username'+edit).addClass("form-control-danger");
            	}
            	if (nombre == "") {
            		$('#nombre'+edit).addClass("form-control-danger");
            	}
            	if (pass == "") {
            		$('#pass'+edit).addClass("form-control-danger");
            	}
            	if (passc == "") {
            		$('#passc'+edit).addClass("form-control-danger");
            	}
							if (tipo == "") {
            		$('span[aria-labelledby="select2-tipo'+edit+'-container"]').addClass("form-control-danger");
            	}
              alertae('Rellena los campos en rojo antes de continuar');
              $(".save").removeAttr("disabled");
            }
          });
        });

	</script>
</body>
</html>