function enterClick(x,y) {
  var input = document.getElementById(x);

  // Execute a function when the user releases a key on the keyboard
  input.addEventListener("keyup", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
      // Cancel the default action, if needed
      event.preventDefault();
      // Trigger the button element with a click
      document.getElementById(y).click();
    }
  });
}




function captchaForm(form,cntrlr) {
  $('#'+form).submit(function(event) {
    event.preventDefault();
    grecaptcha.ready(function() {
      grecaptcha.execute('6LeBKMoUAAAAAI0ds_dFT7wU0xxIToJLpQN3RdIp', {action: 'controller/contact/'+cntrlr}).then(function(token) {
        $('#'+form).prepend('<input type="hidden" name="token" value="' + token + '">');
        $('#'+form).prepend('<input type="hidden" name="action" value="controller/contact/'+cntrlr+'">');
        $('#'+form).unbind('submit').submit();
      });;
    });

  });
}
function captchaFormReg(form,pass,cntrlr,idboton) {
  $( "#"+form ).validate({
      rules: {
          pss: {
              required: true,
              minlength: 8
          },
          pssc: {
              equalTo: "#"+pass
          },
          emailr: "required",
          nom: "required",
          ape: "required",
          pssc: "required"
      },
      submitHandler: function(form,event) {
        $("#"+idboton).val('ESPERE POR FAVOR, REGISTRANDO');
        $("#"+idboton).attr("disabled", true);
        
          event.preventDefault();

          grecaptcha.ready(function() {
            grecaptcha.execute('6LeBKMoUAAAAAI0ds_dFT7wU0xxIToJLpQN3RdIp', {action: 'controller/'+cntrlr}).then(function(token) {
              $('#frmreg').prepend('<input type="hidden" name="token" value="' + token + '">');
              $('#frmreg').prepend('<input type="hidden" name="action" value="controller/'+cntrlr+'">');
              $('#frmreg').unbind('submit').submit();
            });;
          });
      }
  });
}

function maxNumber(input,max) {
  if ($("#"+input).val()>max) {
    $("#"+input).val(max);
  }
}

function chk(){
var val = document.getElementById("ecnf").checked;
if(val == true){
  document.getElementById("ddfdc").style.display= 'block' ;
  
  $("input[id*=fac_razonsocial]").rules("add", { required: true });
  $("input[id*=fac_rfc]").rules("add", { required: true });
  $("select[id*=fac_usocfdi]").rules("add", { required: true });
  $("input[id*=fac_calle]").rules("add", { required: true });
  $("input[id*=fac_ext]").rules("add", { required: true });
  $("input[id*=fac_colonia]").rules("add", { required: true });
  $("input[id*=fac_poblacion]").rules("add", { required: true });
  $("input[id*=fac_ciudad]").rules("add", { required: true });
  $("input[id*=fac_cp]").rules("add", { required: true });
  $("select[id*=fac_edo]").rules("add", { required: true });
}
else{
  document.getElementById("ddfdc").style.display= 'none' ;
}
}

function cpy(){
var val = document.getElementById("cddf").checked;
  if(val == true){
    $("#fac_calle").val($("#billing_calle").val());
    $("#fac_ext").val($("#billing_ext").val());
    $("#fac_inte").val($("#billing_inte").val());
    $("#fac_colonia").val($("#billing_colonia").val());
    $("#fac_poblacion").val($("#billing_municipio").val());
    $("#fac_ciudad").val($("#billing_ciudad").val());
    $("#fac_cp").val($("#billing_cp").val());
    $("#fac_edo").val($("#billing_edo").val());
  }
  else{
    $("#fac_calle").val("");
    $("#fac_ext").val("");
    $("#fac_inte").val("");
    $("#fac_colonia").val("");
    $("#fac_poblacion").val("");
    $("#fac_ciudad").val("");
    $("#fac_cp").val("");
    $("#fac_edo").val("");
  }
}

function limpia(x){
    $('#'+x).css("border", "0px solid #fff"); 
}

function limpiaTex(x,div){
    $('#'+x).css("border", "0px solid #fff"); 
    $('#'+div).empty(); 
}
function textosVal() {
  jQuery.extend(jQuery.validator.messages, {
      required: "Este campo es requerido.",
      remote: "Please fix this field.",
      email: "Please enter a valid email address.",
      url: "Please enter a valid URL.",
      date: "Please enter a valid date.",
      dateISO: "Please enter a valid date (ISO).",
      number: "Please enter a valid number.",
      digits: "Please enter only digits.",
      creditcard: "Please enter a valid credit card number.",
      equalTo: "Please enter the same value again.",
      accept: "Please enter a value with a valid extension.",
      maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
      minlength: jQuery.validator.format("Please enter at least {0} characters."),
      rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
      range: jQuery.validator.format("Please enter a value between {0} and {1}."),
      max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
      min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
  });
}

function alerta2(t) {
  Swal.fire({

    title: '¡Exito!',
    text: t,
    icon: 'success',
    allowOutsideClick: false
  })
}

function alertae(t) {
  Swal.fire({
    icon: 'error',
    title: 'Error...',
    text: t
  })
}

function alertaSes(t) {
  Swal.fire({
    icon: 'error',
    title: 'Error...',
    text: t,
    allowOutsideClick: false
  }).then(function() {
    window.location.href="login";
  })
}

function alertaPermi(t) {
  Swal.fire({
    icon: 'error',
    title: 'Error...',
    text: t,
    allowOutsideClick: false
  }).then(function() {
    history.back();
  })
}


function alertae2(t) {
  Swal.fire({
    icon: 'error',
    title: 'Error...',
    text: t,
    allowOutsideClick: false
  }).then(function() {
    location.reload(true);
  })
}

function simpleAlert(t) {
  Swal.fire(t)
}

function alerta(t) {
  Swal.fire({

    title: '¡Exito!',
    text: t,
    icon: 'success',
    allowOutsideClick: false
  }).then(function() {
    location.reload(true);
  })
}

function alertaNoti(t) {
  Swal.fire({
    position: 'bottom-end',
    icon: 'success',
    title: 'Exito',
    text: t,
    showConfirmButton: false,
    timer: 800,
    allowOutsideClick: true
  })
}

function alertaeNoti(t) {
  Swal.fire({
    position: 'bottom-end',
    icon: 'error',
    title: 'Error...',
    text: t,
    showConfirmButton: false,
    timer: 800,
    allowOutsideClick: true
  })
}
/*FUNCION PARA BORRAR IMAGENES DEL SLIDER*/
function delImgSlider(path) {
  $.post('controller/delImgSlider', { dir: path }, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.path);
        elemento.remove();
        alertaNoti("La imagen se ha eliminado con exito");
  }).fail(function(){
        alertae("error");
  });
}

function delAnyImg(path) {
   Swal.fire({
    title: '¿Estás seguro?',
    text: "No podrás revertir esta acción",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33000',
    confirmButtonText: 'Sí, Elimínar!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('controller/delAnyImg', { dir: path}, 
        function(returnedData){
          var dataResult = JSON.parse(returnedData);
          var elemento = document.getElementById("img-"+dataResult.nombre);
          elemento.remove();
          alertaNoti("La imagen se ha eliminado con exito");
        }).fail(function(){
              alertae("error");
        });
    }
  })
  
}

function delProd(sku) {
   Swal.fire({
    title: '¿Estás seguro?',
    text: "No podrás revertir esta acción",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33000',
    confirmButtonText: 'Sí, Elimínar!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('controller/delProd', { sku: sku}, 
        function(returnedData){
          var dataResult = JSON.parse(returnedData);
          var elemento = document.getElementById(dataResult.sku);
          elemento.remove();
          $('#producto').DataTable().row('#'+dataResult.sku).remove().draw();
          alertaNoti("El producto se ha eliminado con exito");
        }).fail(function(){
            alertae("error");
      });
    }
  })
  
}

function delImgMarca(path) {
  $.post('controller/delImgMarca', { dir: path}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.path);
        elemento.remove();
        alertaNoti("La imagen se ha eliminado con exito");
  }).fail(function(){
        alertae("error");
  });
}

function delImgSecciones(path) {
  $.post('controller/delImgSecciones', { dir: path}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.path);
        elemento.remove();
        alertaNoti("La imagen se ha eliminado con exito");
  }).fail(function(){
        alertae("error");
  });
}

function delCat(idC) {
  $.post('controller/delCat', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);
        elemento.remove();
        alertaNoti("La categoría se ha eliminado con exito");
  }).fail(function(){
        alertae("error");
  });
}

function delPaciente(idC) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "No podrás revertir esta acción",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33000',
    confirmButtonText: 'Sí, Elimínar!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('controller/delPacientes', { id: idC}, 
        function(returnedData){
          var dataResult = JSON.parse(returnedData);
          var elemento = document.getElementById(dataResult.idC);
          elemento.remove();
          var contenido = $('#Contenido').html();
          $('#lista').DataTable().clear();
          $('#lista').DataTable().destroy();
          $('#Contenido').html(contenido);
          $('#lista').DataTable({
            "pageLength": 25
          });
          alertaNoti("El paciente se ha eliminado con exito");
      }).fail(function(){
          alertae("error");
      });
    }
  })
}

function delConsulta(idC) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "No podrás revertir esta acción",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33000',
    confirmButtonText: 'Sí, Elimínar!',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('controller/delConsulta', { id: idC}, 
        function(returnedData){
          var dataResult = JSON.parse(returnedData);
          var elemento = document.getElementById(dataResult.idC);
          elemento.remove();
          var contenido = $('#Contenido').html();
          $('#lista').DataTable().clear();
          $('#lista').DataTable().destroy();
          $('#Contenido').html(contenido);
          $('#lista').DataTable({
            "pageLength": 25
          });
          alertaNoti("La consulta se ha eliminado con exito");
      }).fail(function(){
          alertae("error");
      });
    }
  })
}

function revisaSku(sku) {
  if (idA == "") {
    $.post('controller/revisaSku', { sku: sku}, 
        function(returnedData){
          var dataResult = JSON.parse(returnedData);
          if (dataResult.st == 202) {
            alertae("El SKU que intentas dar de alta ya existe");
            $('#sku').val('');
          }
    }).fail(function(){
          alertae("error");
    });
  }
}

function delLin(idC) {
  $.post('controller/delLin', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);
        elemento.remove();
        alertaNoti("La línea se ha eliminado con exito");
  }).fail(function(){
        alertae("error");
  });
}
function delMarca(idC) {
  $.post('controller/delMarca', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);
        elemento.remove();
        alertaNoti("La marca se ha eliminado con exito");
  }).fail(function(){
        alertae("error");
  });
}

function desbloquear(idC) {
  $.post('controller/desbloquear', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);

        //alert(dataResult.data1);
        alerta("Se ha desbloqueado el usuario con éxito");
  }).fail(function(){
        alertae("error");
  });
}

function aprobarCal(idC) {
  $.post('controller/aprobarCal', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);

        //alert(dataResult.data1);
        alerta("Se ha aprobado la reseña con éxito");
  }).fail(function(){
        alertae("error");
  });
}

function denegarCal(idC) {
  $.post('controller/denegarCal', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);

        //alert(dataResult.data1);
        alerta("Se ha denegado la reseña con éxito");
  }).fail(function(){
        alertae("error");
  });
}

function tktClose(idC) {
  $.post('controller/tktClose', { id: idC}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        var elemento = document.getElementById(dataResult.idC);

        //alert(dataResult.data1);
        alerta("Se ha cerrado el ticket con éxito");
  }).fail(function(){
        alertae("error");
  });
}

function dataModal(id,value) {
  $('#tipo').val(value);
  idA = id;
}

function dataModalUser(username,tipo,nombre) {
  $('#username1').val(username);
  $('#tipo1').val(tipo);
  $('#tipo1').change();
  $('#nombre1').val(nombre);
  idA = username;
}

function dataModalPaciente(id,nombre,tipo,numcontacto,fechanac) {
  $('#nombre1').val(nombre);
  $('#numero1').val(numcontacto);
  $('#date1').val(fechanac);
  $('#tipo1').val(tipo);
  $('#tipo1').change();
  idA = id;
}

function dataModalConsulta(id,fecha,paciente,edad,motivos,pade,observ,medi) {
  $('#fecha').val(fecha);
  $('#paciente').val(paciente);
  $('#paciente').change();
  $('#motivo').val(motivos);
  $('#pade').val(pade);
  $('#observ').val(observ);
  $('#medi').val(medi);
  $('#edad').val(edad);
  editar = id;
}


function guardaGuia(guia,pedido) {
  $.post('controller/guardaGuia', { guia: guia, pedido: pedido }, 
      function(returnedData){

        guias[pedido] = guia;
        alertaNoti("La guía se ha guardado con éxito");
  }).fail(function(){
        alertae("No se pudo guardar la guía, intentalo de nuevo más tarde");
  });
}
function guardaEstado(estado,pedido) {
  
  $.post('controller/guardaEstado', { estado: estado, pedido: pedido }, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        estados[pedido] = estado;
        if (banderaJS > 1) {
          $('#estado'+pedido).html(dataResult.estadoT);
          alertaNoti("El estado se ha guardado con éxito");
        }
        banderaJS++;
  }).fail(function(){
        alertae("No se pudo guardar el estado, intentalo de nuevo más tarde");
  });
}
function dataModalL(id,value) {
  $('#linea').val(value);
  idA = id;
}
function dataModalClient(id,value) {
  $('#motivo').val(value);
  idA = id;
}
function dataModalM(id,value) {
  $('#marca').val(value);
  idA = id;
}
function dataModalSlider(id,enc,sub,des,url) {
  idA = id;
  $('#encabezado').val(enc);
  $('#subencabezado').val(sub);
  $('#destacado').val(des);
  $('#url').val(url);
  $('#imagen').val('');
  $('#imagen1').val('');
}

function dataModalPed(id,ped,datos,fecha,cliNombre,fentrega,fpago,fac,importe,importeE,importeT,estado,facR,facRFC,facCF,facDireccion,guia) {
  $('#loadDivEst').show();
  $("#loadEstado").css("width", "100%");
  $('#productos').append('<tr id="trRemove"><td colspan="9"><div id="loadDivProd" class="progress mb-20"><div class="progress-bar bg-red progress-bar-striped progress-bar-animated" id="loadProds" role="progressbar" style="width: 100%; " aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div></td></tr>');

  idA = ped;


  var fechaSplit = fecha.split(" ");
  $('#pedido').html(ped);
  $('#cliente').html(cliNombre);
  $('#fecha').html(fechaSplit[0]);
  $('#hora').html(fechaSplit[1]);
  $('#pago').html(fpago);
  if(fentrega == "Enviar"){
    $('#entrega').html("Enviar a domicilio");
    $('#datosEnvio').html("<label>Datos envio: <h3 id='denvio'>"+datos+"</h3></label>");
  }else{
    $('#entrega').html("Recoger en tienda");
  }

  if(fac == "1"){
    $('#factura').html("Si");
    $('#datosFac').html("<label>Datos facturación: <h3 id='denvio'>Razón Social: "+facR+" <br>RFC: "+facRFC+"<br>Uso del Cfdi: "+facCF+"<br>Dirección de facturación: "+facDireccion+"</h3></label>");
  }else{
    $('#factura').html("No");
  }
  $('#importe').html(importe);
  $('#importeE').html(importeE);
  $('#importeT').html(importeT);
  if (typeof(guias[ped]) != "undefined" && guias[ped] !== null) {
    $('#guia').val(guias[ped]);
  }else{
    $('#guia').val(guia);
  }

  if (typeof(estados[ped]) != "undefined" && estados[ped] !== null) {
    estado = estados[ped];
  }

  

  $.post('controller/getOptions', { estado: estado }, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        $("#loadDivEst").hide('slow/400/fast', function() {
          $("#estatusDiv").show();
          $('#estatus').val(null).trigger('change');
          $("#estatus").select2('destroy');
          $("#estatus").html('');
          $("#estatus").append(dataResult.output);
          $("#estatus").select2();
          $('#estatus').val(estado);
          $('#estatus').change();
        });

  }).fail(function(){
        alertae("Error al cargar los estados de este pedido");
  });

/*
  for(let x = 0; x < dataOptions.length; x++){
    var newOption = new Option(dataOptions.text, dataOptions.id, false, false);
    $('#estatus').append(newOption).trigger('change');
  }*/
  banderaJS = 0;
  $.post('controller/getProds', { pedido: ped}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);

        $('#loadDivProd').hide('slow/400/fast', function() {
          $('#trRemove').remove();
          $('#prdsPed').DataTable().clear();
          $('#prdsPed').DataTable().destroy();
          $('#productos').html(dataResult.prods);
          $('#prdsPed').DataTable({
            pageLength: '5',
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
          });

        });

  }).fail(function(){
        alertae("Error al cargar los productos de este pedido");
  });
  
}

function dataModalPrds(sku,des,mod,det1,det2,det3,det4,costo,precio,cate,lin,mar,acti,gara,ofe,exi,acc,video,tagsB,tagsS,peso,ancho,alto,largo,etc,detalles,titulos,date) {
  idA = sku;
  var detallesRet = detalles;
  var titulosRet = titulos;

  $('#sku').val(sku);
  $("#sku").attr("disabled", "disabled");
  des = des.replaceAll('APOSTROFE','"');
  $('#descrip').val(des.replaceAll('APOSTROFEMINI','\''));
  $('#destacado').val(des);
  $('#modelo').val(mod);
  det1 = det1.replaceAll('APOSTROFE','"');
  $('#det1').val(det1.replaceAll('APOSTROFEMINI','\''));
  det2 = det2.replaceAll('APOSTROFE','"');
  $('#det2').val(det2.replaceAll('APOSTROFEMINI','\''));
  det3 = det3.replaceAll('APOSTROFE','"');
  $('#det3').val(det3.replaceAll('APOSTROFEMINI','\''));
  det4 = det4.replaceAll('APOSTROFE','"');
  $('#det4').val(det4.replaceAll('APOSTROFEMINI','\''));
  $('#costo').val(costo);
  $('#precio').val(precio);

  $('#utilidad').val((((parseFloat(precio)-parseFloat(costo))*100)/parseFloat(costo)).toFixed(2));
  
  $('#garantia').val(gara);
  $('#oferta').val(ofe);
  $('#exis').val(exi);
  $('#acce').val(acc);
  $('#video').val(video);
  $('#espe').val(etc.replaceAll('SALTO_DE_LINEA','\n'));
  $('#espe').val($('#espe').val().replaceAll('APOSTROFE','"'));
  $('#espe').val($('#espe').val().replaceAll('APOSTROFEMINI','\''));


  var tagsBA = tagsB.split(",");
  $.each(tagsBA, function( index, value ) {
    $('#tagsB').tagsinput('add',value);
  });

  var tagsSA = tagsS.split(",");
  $.each(tagsSA, function( index, value ) {
    $('#tagsS').tagsinput('add',value);
  });

  $('#peso').val(peso);
  $('#ancho').val(ancho);
  $('#alto').val(alto);
  $('#largo').val(largo);

  $('.detDiv').remove();

  $.post('controller/getFiles', { sku: sku}, 
      function(returnedData){
        var dataResult = JSON.parse(returnedData);
        $('#divImgSec').html(dataResult.path);
  }).fail(function(){
        alertae("Error al cargar las imágenes secundarias");
  });
  $('#divImgPri').html('<img style="max-width: 210px;" src="../assets/images/products/'+sku+'.webp?d='+date+'">');

  $.each(detallesRet, function( index, value ) {
    if (index>0) {
      if (value != "") {
        $('.modal-body').append('<div class="row detDiv" id="detDiv'+index+'"><div class="form-group col-4"><label>Título</label><input id="titulo'+index+'" type="text" class="form-control titulos"  placeholder="Título..."></div><div class="form-group col-7"><label>Detalle</label><input id="detalle'+index+'" type="text" value="'+value+'" class="form-control detalles" placeholder="Detalle..."></div><div style="text-align: center; padding-top: 2.35em;" class="form-group col-1"><a href="javascript:void(0)" onclick="eliminaDiv(\'detDiv'+index+'\')"> <i class="icon-copy fa fa-times-circle" aria-hidden="true"></i></a></div></div>');
      }
    }else{
      $('#detalle0').val(value);
    }

  });
  $.each(titulosRet, function( index, value ) {
    $('#titulo'+index).val(value);
  });

  $(".selectdos ").select2("destroy");
  $(".selectdos ").select2();
  $('#cat').val(cate);
  $('#lin').val(lin);
  $('#mar').val(mar);
  $('#acti').val(acti);
  $('#cat').change();
  $('#lin').change();
  $('#mar').change();
  $('#acti').change();
}
