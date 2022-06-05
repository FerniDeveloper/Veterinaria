<?php
$st = 202;
include('../db/dss.php');
$db = conecta();

$update = $_POST['update'];

$nombre = $_POST['nombre'];
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$date = $_POST['date'];

$output = "";


if($update == ""){
	put("pacientes", "nombre, numcontacto, tipo, fechanac", "'".$nombre."','".$numero."', '".$tipo."', '".$date."'");
	$st = 200;

}else{
	updt("pacientes", "nombre = '".$nombre."', numcontacto = '".$numero."', tipo = '".$tipo."', fechanac = '".$date."'", "id='".$update."'");
	$st = 201;
}
$sql="SELECT pacientes.*, tipos.tipo AS tipoT FROM pacientes JOIN tipos ON tipos.id = pacientes.tipo WHERE pacientes.elim = 0";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	$id = $row['id'];
  	$nombre = $row['nombre'];
  	$tipo = $row['tipo'];
  	$tipoT = $row['tipoT'];
  	$numcontacto = $row['numcontacto'];
  	$fechanac = $row['fechanac'];
	  $output .= '
	    <tr>
        <td>'.$nombre.'</td>
        <td>'.$numcontacto.'</td>
        <td>'.$tipoT.'</td>
        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal" type="button" onclick="dataModalPaciente(\''.$id.'\',\''.$nombre.'\',\''.$tipo.'\',\''.$numcontacto.'\',\''.$fechanac.'\')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delPaciente(\''.$id.'\')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a></td>
      </tr>
	    ';
	  }
}

echo json_encode(array("statusCode"=>$st,"data1"=>$output));

?>
