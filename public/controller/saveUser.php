<?php
$st = 202;
include('../../db/dss.php');
$db = conecta();

$update = $_POST['update'];

$username = $_POST['username'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$pass = $_POST['pass'];

$output = "";
$cadena = "";

$hsh = password_hash($pass, PASSWORD_DEFAULT);

if($update == ""){
	put("net", "username, nombre, tipo, hsh", "'".$username."','".$nombre."', '".$tipo."', '".$hsh."'");
	$st = 200;

}else{

	if($nombre != ""){
		$cadena .= "nombre='".$nombre."',";
	}
	if($tipo != ""){
		$cadena .= "tipo='".$tipo."',";
	}
	if($pass != ""){
		$cadena .= "hsh='".$hsh."',";
	}

	$cadena = substr_replace($cadena ,"",-1);

	updt("net", $cadena, "username='".$update."'");
	$st = 201;
}
$sql="select *, net.nombre as nombreuser, net_tipo.nombre AS nombretipo from net JOIN net_tipo ON net_tipo.id = net.tipo WHERE elim = 0";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	$username = $row['username'];
  	$nombreuser = $row['nombreuser'];
  	$nombretipo = $row['nombretipo'];
  	$tipo = $row['tipo'];
	  $output .= '
	    <tr>
        <td>'.$username.'</td>
        <td>'.$nombreuser.'</td>
        <td>'.$nombretipo.'</td>
        <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal" type="button" onclick="dataModalUser(\''.$username.'\',\''.$tipo.'\',\''.$nombreuser.'\')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delUser(\''.$username.'\')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a></td>
      </tr>
	    ';
	  }
}

echo json_encode(array("statusCode"=>$st,"data1"=>$output));

?>
