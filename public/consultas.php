<?php
include('db/dss.php');
$db = conecta();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Veterinaria - Consultas</title>
  <?php require("assets/include/head.php"); ?>
  <style type="text/css">
    #modalPro.custom-class {
      z-index: 1029;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="assets/css/radio.css">
</head>

<body>
  <?php include("assets/include/preloader.php"); ?>
  
  <?php require("assets/include/header.php"); ?>

  <?php require("assets/include/sidebar.php"); ?>

  <div class="mobile-menu-overlay"></div>
  <script type="text/javascript">
    var fecha = new Date();
  </script>
  <div class="main-container">
    <div class="pd-ltr-20">
      <div class="page-header">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="title row">
              <div class="col-6">
                <h4>Consultas</h4>
              </div>
              <div class="col-6" style="text-align: right;">
                <a href="#" id="btnNuevo" class="btn btn-primary" data-toggle="modal" onclick="idA = ''" data-target="#modalPro" type="button">Nueva</a>
              </div>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Consultas</li>
              </ol>
            </nav>
          </div>

        </div>

      </div>

      <div class="pd-20 card-box mb-30">
        <div class="clearfix">
          <div class="pull-left">
            <h4 class="text-blue h4">Consultas</h4>
            <p class="mb-30">A continuación verás todas las consultas</p>
          </div>
        </div>
        <div class="col-md-12 ">
          <table id="lista" class="table table-striped table-bordered table-sm" style="width:100%">
            <thead>
              <tr>
                <th>Paciente</th>
                <th>Edad</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Padecimiento</th>
                <th>Observaciones</th>
                <th>Medicamento</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="Contenido">
              <?php  
              $sql="SELECT consultas.*, pacientes.*, tipos.tipo AS tipoT, consultas.id AS idB FROM consultas JOIN pacientes ON pacientes.id = consultas.paciente JOIN tipos ON tipos.id = pacientes.tipo";
              $result = $db->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  
                    ?>
                    <tr id="<?=$row['idB']?>">
                      <td><?=$row['nombre']?> (<?=$row['numcontacto']?>) - <?=$row['tipoT']?></td>
                      <td><?=$row['edadmeses']?> meses</td>
                      <td><?=$row['fecha']?></td>
                      <td><?=$row['motivos']?></td>
                      <td><?=$row['padecimientos']?></td>
                      <td><?=$row['observ']?></td>
                      <td><?=$row['medicamento']?></td>
                      <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modalPro" type="button" onclick="dataModalConsulta('<?=$row['idB']?>','<?=$row['fecha']?>','<?=$row['paciente']?>','<?=$row['edadmeses']?>','<?=$row['motivos']?>','<?=$row['padecimientos']?>','<?=$row['observ']?>','<?=$row['medicamento']?>')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delConsulta('<?=$row['idB']?>')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>
                  
                <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

        <?php require("assets/include/developby.php"); ?>

    </div>
  </div>
  <div style="overflow-y: scroll !important;" class="modal fade bs-example-modal-xl" id="modalPro" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Nueva Consulta</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <div class="col-sm-12 col-md-7">
            </div>
            <label class="col-sm-12 col-md-2 col-form-label">Fecha de la consulta:</label>
            <div class="col-sm-12 col-md-3">
              <input id="fecha" class="form-control date-picker date-now" placeholder="" type="text"  required/>
            </div>
          </div>
          <br>
          <div class="item form-group row">
            <label class="col-form-label col-md-2 col-sm-2 label-align" for="first-name">Paciente</label>
            <div class="col-md-5 col-sm-5">
              <select class="custom-select2 form-control" onchange="calcMeses()" name="paciente" id="paciente" style="width: 100%; height: 38px;">
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
            <label class="col-sm-12 col-md-2 col-form-label">Edad (En meses):</label>
            <div class="col-sm-12 col-md-3">
              <input class="form-control" disabled value="" id="edad" type="number" required />
            </div>
          </div>

          

          <div class="form-group row">
          <div class="col-md-12">
              <label>Motivos de la consulta:</label>
              <textarea id="motivo" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group row">
          <div class="col-md-12">
              <label>Padecimientos:</label>
              <textarea id="pade" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group row">
          <div class="col-md-12">
              <label>Observaciones:</label>
              <textarea id="observ" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <div class="row mb-2">
              <div class="col-6">
                <label>Medicamento suministrado:</label>
              </div>
              <div class="col-6" style="text-align: right;">
                <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" onclick=" $('#modalPro').addClass( 'custom-class' );" data-target="#modalCalc">
                  <i class="icon-copy fa fa-calculator" aria-hidden="true"></i>
                </a>
              </div>
              </div>
              <textarea id="medi" class="form-control"></textarea>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" onclick="generatePDF()" class="btn btn-success">Imprimir</button>
          <button type="button" class="btn save btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade " id="modalCalc" data-backdrop="static"  tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal2">Cálculo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
        <form>
					<div class="row">
            <div class="col-md-12 wrapper col-sm-12">
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
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Peso <font id="pesoL">(kg)</font></label>
								<input id="peso" type="text" value="" name="demo3">
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Dosis <font id="dosisL">(mg/kg)</font></label>
								<input id="dosis" type="text" value="" name="demo3">
							</div>
						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label id="concL">Miligramos (concentrado del producto)</label>
								<input id="conc" type="text" value="" name="demo3">
							</div>
						</div>
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label>Medicamento</label>
                <input type="text" class="form-control" id="mediCalc" name="">
              </div>
            </div>
					</div>
				</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" onclick="calcDosis()" class="btn btn-success">Calcular</button>
          <button type="button" class="btn btn-primary" onclick="agregaDosis()" >Agregar dosis</button>
        </div>
      </div>
    </div>
  </div>


  <?php require("assets/include/jsfooter.php"); ?>
  <!-- bootstrap-tagsinput js -->
  <script src="src/plugins/fancybox/dist/jquery.fancybox.js"></script>
  <script src="src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
  <script src="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
  <script src="vendors/scripts/advanced-components.js"></script>
  <script src="assets/js/jspdf.min.js"></script>
  <script src="assets/js/medical.js"></script>

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

    function agregaDosis() {
      $("#modalCalc").modal('hide');
      $('#medi').val($('#medi').val()+" "+$('#mediCalc').val());
    }

    var day = fecha.getDate();
    var month = fecha.getMonth() + 1;
    if (month<10) {
      month = '0'+month;
    }
    var year = fecha.getFullYear();
    $('#fecha').val(year+'-'+month+'-'+day);
    var editar = '';
 
    function calcMeses() {
      var months;
      var d1 = new Date($('#paciente').find(':selected').data('nac')+'T00:00:00Z');
      var d2 = new Date();
      months = (d2.getFullYear() - d1.getFullYear()) * 12;
      months -= d1.getMonth();
      months += d2.getMonth();
      if (isNaN(months)) {
        months = 0;
      }
      $('#edad').val(months);

    }

    $('#lista').DataTable({
      "pageLength": 25
    });
    $( document ).ready(function() {
     
      $('.selectdos').select2({
        dropdownParent: $('#modalPro')
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
    });

    $('#btnNuevo').on("click", function() {
      editar = '';
    });

    $('#modalCalc').on('hide.bs.modal', function (e) {
      $("#modalPro").removeClass( "custom-class" );
    })


    $("#modalPro").on('hide.bs.modal', function(){
      editar = '';
      $('#paciente').val('');
      $('#paciente').change();
      $('#edad').val('');
      $('#fecha').val('');
      $('#motivo').val('');
      $('#pade').val('');
      $('#observ').val('');
      $('#medi').val('');
      $('#fecha').val(year+'-'+month+'-'+day);
    });
    
    $('.save').on('click', function() {
      $(".save").attr("disabled", "disabled");
        var paciente = $('#paciente').val();
        var edad = $('#edad').val();
        var fecha = $('#fecha').val();
        var motivo = $('#motivo').val();
        var pade = $('#pade').val();
        var observ = $('#observ').val();
        var medi = $('#medi').val();
           
        data = new FormData();
        data.append('paciente', paciente);
        data.append('edad', edad);
        data.append('fecha', fecha);
        data.append('motivo', motivo);
        data.append('pade', pade);
        data.append('observ', observ);
        data.append('medi', medi);
        data.append('editar', editar);

        if(paciente != "" && edad != "" && fecha != "" && motivo != "" && pade != "" && observ != "" && medi != ""){
          $.ajax({
            url: "controller/consulta",
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
                $('#lista').DataTable().clear();
                $('#lista').DataTable().destroy();
                $('#Contenido').html(dataResult.data1);
                $('#lista').DataTable({
                  "pageLength": 25
                });
                $('#modalPro').modal('toggle');
                alerta2("La consulta se ha subido correctamente");
              }else if (dataResult.statusCode==205) {
                $(".save").removeAttr("disabled");
                $("#sku").removeAttr("disabled");
                $('#lista').DataTable().clear();
                $('#lista').DataTable().destroy();
                $('#Contenido').html(dataResult.data1);
                $('#lista').DataTable({
                  "pageLength": 25
                });
                $('#modalPro').modal('toggle');
                alerta2("La consulta se ha actualizado correctamente");
              }else{
                $(".save").removeAttr("disabled");
                alertae('Ha ocurrido un error, intentalo de nuevo más tarde');
              }
            }
          });
        }else{
          if (paciente == "") {
            $('span[aria-labelledby="select2-paciente-container"]').addClass("form-control-danger");
          }
          if (edad == "") {
            $('#edad').addClass("form-control-danger");
          }
          if (fecha == "") {
            $('#fecha').addClass("form-control-danger");
          }
          if (motivo == "" ) {
            $('#motivo').addClass("form-control-danger");
          }
          if (pade == "" ) {
            $('#pade').addClass("form-control-danger");
          }
          if (observ == "" ) {
            $('#observ').addClass("form-control-danger");
          }
          if (medi == "" ) {
            $('#medi').addClass("form-control-danger");
          }
          
          alertae('Revisa todos los campos en rojo, no pueden estar vacios');
          $(".save").removeAttr("disabled");
        }
    });
  </script>

</body>

</html>
