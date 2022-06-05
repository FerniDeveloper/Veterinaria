<?php
include('../db/dss.php');
$db = conecta();
$d = date("h:i:sa");
$st = 203;
$output = '';
$tipo = $_POST['tipo'];
$tipoUpd = $_POST['tipoUpd'];
$update = $_POST['update'];

if($update == ""){
	$sql= put("tipos", "tipo, elim","'".$tipo."','0'");
	$st = 200;
}else{
	$sql= updt("tipos", "tipo = '".$tipoUpd."'","id = '".$update."'");
	$st = 202;
}

$sql="select * from tipos WHERE elim = '0' order by tipo";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	$id = $row['id'];
  	$tipoOut = $row['tipo'];
  $output .= '
    <tr id="'.$id.'">
      <td>'.$tipoOut.'</td>
      <td><a href="javascript:void(0)" data-toggle="modal" data-target="#modal" type="button" onclick="dataModal(\''.$id.'\',\''.$tipoOut.'\')"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delCat(\''.$id.'\')"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a> </td>
    </tr>
    ';
  }
}

echo json_encode(array("statusCode"=>$st,"data1"=>$output));
?>