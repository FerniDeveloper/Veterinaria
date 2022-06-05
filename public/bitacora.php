<?php
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Veterinaria - Bitácora</title>
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
                <h4 style="color: #C90B34;" class="text-blue h4">Bitacora</h4>
              </div>
              <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Bitacora </li>
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
              <div class="col-md-12">
                <div class="pd-20 card-box mb-30">
                  <div class="pd-20 col-md-12">
                    <h4 class="text-blue h4">Selecciona el paciente</h4>
                    <p class="mb-0">Revisa las consultas del paciente que desees en un rango de fechas</p>
                  </div>
                  <div class="col-md-12 row">
                    <div class="form-group col-4">
                      <label>Paciente:</label>
                      <select class="custom-select2 form-control" name="paciente" id="paciente" style="width: 100%; height: 38px;">
                        <option value="">Selecciona</option>
                        <?php
                          $sql="SELECT pacientes.*, tipos.tipo AS tipoT FROM pacientes JOIN tipos ON tipos.id = pacientes.tipo WHERE pacientes.elim = 0";
                          $result = $db->query($sql);
                          if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              ?>
                                <option data-nac="<?=$row['fechanac']?>" value="<?=$row['id']?>"><?=$row['nombre']?> (<?=$row['numcontacto']?>) - <?=$row['tipoT']?></option>
                              <?php
                            } 
                          }
                        ?>
                      </select>
                    </div>
                   
                    <div class="form-group col-2">
                      <label>Fecha de Inicio:</label>
                      <input class="form-control date-picker1" id="ini" autocomplete="off" placeholder="Selecciona una fecha..." type="text">
                    </div>
                    <div class="form-group col-2">
                      <label>Fecha de Fin:</label>
                      <input class="form-control date-picker1" id="fin" autocomplete="off" placeholder="Selecciona una fecha..." type="text">
                    </div>
                    <div class="form-group col-2">
                      <input style="margin-top: 2em;" class="btn btn-success" value="Consultar" id="consulta" type="button">
                    </div>
                  </div>
                </div>
              </div>
            </div>

         </div>

         <div style="display: none;" class="right_col" id="Second" role="main">
            <div class="row">
              <div class="col-md-12">
                <div class="pd-20 card-box mb-30">
                  <div class="col-md-12" id="Contenido">
                    
                  </div>
                </div>
              </div>
            </div>
         </div>

        <!-- /page content -->
      </div>
      </div>
        <?php require("assets/include/developby.php"); ?>

      </div>

  <?php require("assets/include/jsfooter.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.9.1/jszip.min.js" integrity="sha512-amNoSoOK3jIKx6qlDrv36P4M/h7vc6CHwiBU3XG9/1LW0ZSNe8E3iZL1tPG/VnfCrVrZc2Zv47FIJ7fyDX4DMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="vendors/scripts/datepicker-es.js"></script>
  <script type="text/javascript">

    $( "#consulta" ).click(function() {
      var paciente = $('#paciente').val();
      var ini = $('#ini').val();
      var fin = $('#fin').val();

      $("#consulta").attr("disabled", "disabled");
         
      data = new FormData();
      data.append('paciente', paciente);
      data.append('ini', ini);
      data.append('fin', fin);
      


      if(paciente != ""){
        $.ajax({
          url: "controller/cbitacora",
          type: "POST",
          data:data,
          enctype: 'multipart/form-data',
          processData: false,  // tell jQuery not to process the data
          contentType: false,
          cache: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
                $("#consulta").removeAttr("disabled");
                  $('#Second').show();
                  $('#ventaXrango').DataTable().clear();
                  $('#ventaXrango').DataTable().destroy();
                  $('#Contenido').html(dataResult.data1);
                  $('#ventaXrango').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'pdfHtml5'
                    ]
                  });
              
            }else if (dataResult.statusCode==201) {
              $("#consulta").removeAttr("disabled");
                alertae('No hay consultas que cumplan con tu criterio de búsqueda');
            }else if (dataResult.statusCode==203) {
              $("#consulta").removeAttr("disabled");
                alertae('Ha ocurrido un error intentalo de nuevo más tarde');
            }
          }
        });
      }else{
        alertae('Selecciona el paciente antes de continuar');
        $("#consulta").removeAttr("disabled");
      }
    });

    $('.date-picker1').datepicker({
      language: 'es',
      autoClose: true,
      dateFormat: 'yyyy-mm-dd',
    });
  </script>
</body>
</html>
