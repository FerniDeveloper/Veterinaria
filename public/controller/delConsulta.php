<?php
include('../db/dss.php');
$db = conecta();
$idC = $_POST['id'];
$sql=dlt("consultas","id = '".$idC."'");
echo json_encode(array("idC"=>$idC));
?>