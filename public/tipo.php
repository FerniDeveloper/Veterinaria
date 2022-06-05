<?php
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Veterinaria - Tipos</title>
	<?php require("assets/include/head.php"); ?>
</head>
<body>
	
	<?php require("assets/include/preloader.php"); ?>
	
	<?php require("assets/include/header.php"); ?>

	<?php require("assets/include/sidebar.php"); ?>
	
	<div class="mobile-menu-overlay"></div>


<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- MINI NAVEGACIÓN -->
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4 style="color: #C90B34;" class="text-blue h4">Tipos de animales</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Inicio</a></li>
									<li class="breadcrumb-item active" aria-current="page">Tipos de animales</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- FIN MINI NAVEGACIÓN -->
        
        <script type="text/javascript">
        	var idA = '';
        </script>
         

        <!-- page content -->
        
        	<div class="right_col" role="main">
        		<div class="row">
        			<div class="col-md-6">
								<div class="pd-20 card-box mb-30">
				          <div class="x_panel">
				            <div class="pd-20 col-md-12">
				              <h4 class="text-blue h4">Tipos de animales</h4>
				              <p class="mb-0">Da de alta un nuevo tipo de animal</p>
				          	</div>
				            <div class="col-md-12">
				              <br />
		                  <div class="item form-group row">
				                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del tipo de animal 
				                  </label>
				                  <div class="col-md-9 col-sm-9 ">
			                      <input type="text" id="tipo1" name="tipo" class="form-control " >
			                    </div>
				               </div>
				                
				                <div class="ln_solid"></div>
				                <div class="item form-group row">
				                  <div class="col-md-9 col-sm-9 offset-md-3">
				                    <button type="button" id="save1" class="btn save btn-success">Guardar</button>
				                  </div>
				                </div>

				           
				            </div>

				          </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="pd-20 card-box mb-30">
									<div class="pd-20 col-md-12">
										<h4 class="text-blue h4">Tipos de animales</h4>
				            <p class="mb-0">Revisa y edita los tipos de animales</p>
									</div>
									<div class="col-md-12">
										<table id="" class="table table-striped table-bordered table-sm" style="width:100%">
                        <thead>
                          <tr>
                            <th>Tipo</th>
                            <th style="width: 15%;">Acci&oacute;n</th>  
                          </tr>
                        </thead>

                        <tbody id="Contenido">
                          <?php
                            $sql="select * from tipos WHERE elim = '0' order by tipo";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                ?>
                                <tr id="<?=$row['id']?>">
                                  <td><?=$row['tipo']?></td>
                                  <!--<td><a href="tipos?id=<?=$row['id']?>"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delCat('<?=$row['id']?>')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a> </td>-->
                                  <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal" type="button" onclick="dataModal('<?=$row['id']?>','<?=$row['tipo']?>')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delCat('<?=$row['id']?>')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a> </td>
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
							<div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="Large" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="Large">Editar tipo de animal</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<div class="row">
							            <div class="col-md-12">
					                  <div class="item form-group row">
							                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del tipo de animal 
							                  </label>
							                  <div class="col-md-9 col-sm-9 ">
						                      <input type="text" name="tipo" id="tipo" class="form-control ">
						                    </div>
							               </div>
							   
							            </div>
						            </div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="button" id="save" class="btn save btn-success">Actualizar datos</button>
										</div>
									</div>
								</div>
							</div>
        		</div>
        			<?php require("assets/include/developby.php"); ?>

       	 </div>

        <!-- /page content -->
      </div>
      </div>
      </div>

	<?php require("assets/include/jsfooter.php"); ?>
	<script type="text/javascript">
			$(document).ready(function() {
				$("#modal").on('hide.bs.modal', function(){
					$('#tipo').val('');
					idA = '';
				});
				enterClick('tipo','save');
				enterClick('tipo1','save1');
          $('.save').on('click', function() {
            $(".save").attr("disabled", "disabled");
            var tipo = $('input[name="tipo"]').val();
            var tipoUpd = $('#tipo').val();
               
            data = new FormData();
            data.append('tipo', tipo);
            data.append('tipoUpd', tipoUpd);
            data.append('update', idA);
            


            if((tipo != "")|| (tipoUpd != "")){
              $.ajax({
                url: "controller/tipo",
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
     									$('#tipo1').val('');
     									alerta2("El tipo de animal se ha subido correctamente");
     									$('#Contenido').html(dataResult.data1);
                    
                  }else if (dataResult.statusCode==202) {
                    $(".save").removeAttr("disabled");
                    	$('#modal').modal('toggle');
                      alerta2("El tipo de animal se ha actualizado correctamente");
     									$('#Contenido').html(dataResult.data1);
                        
                  }else if (dataResult.statusCode==203) {
                    $(".save").removeAttr("disabled");
                      alertae('Ha ocurrido un error intentalo de nuevo más tarde');
                  }
                }
              });
            }else{
              alertae('Escribe el nombre de tipo para continuar');
              $(".save").removeAttr("disabled");
            }
          });
        });

	</script>
</body>
</html>