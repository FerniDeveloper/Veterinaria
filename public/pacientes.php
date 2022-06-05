<?php
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Veterinaria - Pacientes</title>
	
	<?php require("assets/include/head.php"); ?>
</head>
<body>
	
	<?php require("assets/include/preloader.php"); ?>
	
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
							<h4 style="color: #C90B34;" class="text-blue h4">Pacientes</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index">Inicio</a></li>
								<li class="breadcrumb-item active" aria-current="page">Pacientes</li>
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
		              <h4 class="text-blue h4">Pacientes</h4>
		              <p class="mb-0">Da de alta un nuevo paciente</p>
		          	</div>
		            <div class="col-md-12">
		              <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del paciente</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
		              </div>
                  <div class="item form-group row">
	                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Número de contacto</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="tel" id="numero" name="numero" class="form-control">
                    </div>
		              </div>
                  
		              <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de animal</label>
	                  <div class="col-md-9 col-sm-9">
                    	<select class="custom-select2 form-control" name="tipo" id="tipo" style="width: 100%; height: 38px;">
												<option value="">Selecciona</option>
                    	<?php
	                      $sql="SELECT * FROM tipos WHERE elim = 0";
	                      $result = $db->query($sql);
	                      if ($result->num_rows > 0) {
	                        while($row = $result->fetch_assoc()) {
	                          ?>
															<option value="<?=$row['id']?>"><?=$row['tipo']?></option>
	                          <?php
	                        } 
	                      }
	                    ?>
											</select>
                    </div>
		              </div>
                  <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha de nacimiento</label>
	                  <div class="col-md-9 col-sm-9">
	                  	<input class="form-control date-picker" id="date" name="date" placeholder="Seleccionar fecha" type="text">
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
								<h4 class="text-blue h4">Lista de pacientes</h4>
		            <p class="mb-0">Revisa y edita los pacientes existentes</p>
							</div>
							<div class="col-md-12">
								<table id="lista" class="table hover ">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Número de contacto</th>
                      <th>Tipo</th>
                      <th>Acci&oacute;n</th>
                    </tr>
                  </thead>

                  <tbody id="Contenido">
                    <?php
                      $sql="SELECT pacientes.*, tipos.tipo AS tipoT FROM pacientes JOIN tipos ON tipos.id = pacientes.tipo WHERE pacientes.elim = 0";
                      $result = $db->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          ?>
                            <tr id="<?=$row['id']?>">
                              <td><?=$row['nombre']?></td>
                              <td><?=$row['numcontacto']?></td>
                              <td><?=$row['tipoT']?></td>
                              <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal" type="button" onclick="dataModalPaciente('<?=$row['id']?>','<?=$row['nombre']?>','<?=$row['tipo']?>','<?=$row['numcontacto']?>','<?=$row['fechanac']?>')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delPaciente('<?=$row['id']?>')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a></td>
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
							<h4 class="modal-title" id="Large">Editar paciente</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
							<div class="row">
			          <div class="col-md-12">
	                <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del paciente</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" id="nombre1" name="nombre1" class="form-control">
                    </div>
		              </div>
                  <div class="item form-group row">
	                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Número de contacto</label>
	                  <div class="col-md-9 col-sm-9">
                    	<input type="text" id="numero1" name="numero1" class="form-control">
                    </div>
		              </div>
                  
		              <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo de animal</label>
	                  <div class="col-md-9 col-sm-9">
                    	<select class="custom-select2 form-control" name="tipo1" id="tipo1" style="width: 100%; height: 38px;">
												<option value="">Selecciona</option>
                    	<?php
	                      $sql="SELECT * FROM tipos WHERE elim = 0";
	                      $result = $db->query($sql);
	                      if ($result->num_rows > 0) {
	                        while($row = $result->fetch_assoc()) {
	                          ?>
															<option value="<?=$row['id']?>"><?=$row['tipo']?></option>
	                          <?php
	                        } 
	                      }
	                    ?>
											</select>
                    </div>
		              </div>
                  <div class="item form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha de nacimiento</label>
	                  <div class="col-md-9 col-sm-9">
	                  	<input class="form-control date-picker" id="date1" name="date1" placeholder="Seleccionar fecha" value="" type="text">
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
					$('#nombre1').val('');
				  $('#tipo1').val('');
				  $('#tipo1').change();
				  $('#nombre1').val('');
				  $('#date1').val('');
				  $('#numero1').val('');
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
				enterClick('date','save');
				enterClick('date1','save');
          $('.save').on('click', function() {
            $(".save").attr("disabled", "disabled");
            var edit = "";
            if (idA != "") {
            	edit = "1";
            }
               
            var nombre = $('#nombre'+edit).val();
            var numero = $('#numero'+edit).val();
            var tipo = $('#tipo'+edit).val();
            var date = $('#date'+edit).val();


            data = new FormData();
            data.append('nombre', nombre);
            data.append('numero', numero);
            data.append('tipo', tipo);
            data.append('date', date);
            data.append('update', idA);
            


	          if(((nombre != "") && (numero != "") && (tipo != "")  && (date != "")) || edit == "1"){
            	
	              $.ajax({
	                url: "controller/pacientes",
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
                     	$('#nombre').val('');
					           	$('#numero').val('');
					           	$('#tipo').val('');
					           	$('#date').val('');
     									alerta2("El paciente se ha subido correctamente");
     									$('#lista').DataTable().clear();
              				$('#lista').DataTable().destroy();
     									$('#Contenido').html(dataResult.data1);
              				$('#lista').DataTable({
												"pageLength": 25
											});
	                    
	                  }else if (dataResult.statusCode==201) {
	                    $(".save").removeAttr("disabled");
                    	$('#modal').modal('toggle');
                      alerta2("El paciente se ha actualizado correctamente");
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
            	if (nombre == "") {
            		$('#nombre'+edit).addClass("form-control-danger");
            	}
            	if (numero == "") {
            		$('#numero'+edit).addClass("form-control-danger");
            	}
            
            	if (date == "") {
            		$('#date'+edit).addClass("form-control-danger");
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