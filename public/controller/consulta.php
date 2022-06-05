<?php
include('../db/dss.php');
$db = conecta();
$st = 200;
$output = '';
$paciente = $_POST['paciente'];
$edad = $_POST['edad'];
$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$pade = $_POST['pade'];
$observ = $_POST['observ'];
$medi = $_POST['medi'];

$update = $_POST['editar'];

if ($update == "") {
  
  $sql= put("consultas", "paciente, edadmeses, fecha, motivos, padecimientos, observ, medicamento","'".$paciente."','".$edad."','".$fecha."','".$motivo."','".$pade."','".$observ."','".$medi."'");
  $st = 200;
}else{
  
  $sql= updt("consultas", "paciente = '".$paciente."', edadmeses = '".$edad."', fecha = '".$fecha."', motivos = '".$motivo."', padecimientos = '".$pade."', observ = '".$observ."', medicamento = '".$medi."'","id = '".$update."'");
  $st = 205;
}

  
  $sql="SELECT consultas.*, pacientes.*, tipos.tipo AS tipoT, consultas.id AS idB FROM consultas JOIN pacientes ON pacientes.id = consultas.paciente JOIN tipos ON tipos.id = pacientes.tipo";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $idOut = $row['idB'];
      $nomOut = $row['nombre'];
      $pacOut = $row['paciente'];
      $numOut = $row['numcontacto'];
      $tipoOut = $row['tipoT'];
      $edadOut = $row['edadmeses'];
      $fechaOut = $row['fecha'];
      $motOut = $row['motivos'];
      $padeOut = $row['padecimientos'];
      $obsOut = $row['observ'];
      $medOut = $row['medicamento'];
      $output .= '
        <tr id="'.$idOut.'">
          <td>'.$nomOut." (".$numOut.") - ".$tipoOut.'</td>
          <td>'.$edadOut.' meses</td>
          <td>'.$fechaOut.'</td>
          <td>'.$motOut.'</td>
          <td>'.$padeOut.'</td>
          <td>'.$obsOut.'</td>
          <td>'.$medOut.'</td>
          <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modalPro" type="button" onclick="dataModalConsulta(\''.$idOut.'\',\''.$fechaOut.'\',\''.$pacOut.'\',\''.$edadOut.'\',\''.$motOut.'\',\''.$padeOut.'\',\''.$obsOut.'\',\''.$medOut.'\')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delConsulta(\''.$idOut.'\')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a></td>
        </tr>
      ';
    }
  }
echo json_encode(array("statusCode"=>$st,"data1"=>$output));
?>