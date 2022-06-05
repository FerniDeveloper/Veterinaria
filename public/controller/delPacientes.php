<?php
include('../db/dss.php');
$db = conecta();
$idC = $_POST['id'];
$sql=updt("pacientes","elim=1","id = '".$idC."'");

echo json_encode(array("idC"=>$idC));
?>