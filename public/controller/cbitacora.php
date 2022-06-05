<?php
include('../db/dss.php');
$db = conecta();
$d = date("h:i:sa");
$st = 203;
$output = '';
$paciente = $_POST['paciente'];
$ini = $_POST['ini'];
$fin = $_POST['fin'];
if ($ini != "") {
  $ini = " AND fecha >= '".$ini."' ";
}
if ($fin != "") {
  $fin = " AND fecha <= '".$fin."' ";
}
$output .= '
  <table id="ventaXrango" class="table table-striped table-bordered table-sm" style="width:100%">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Edad</th>
        <th>Motivo</th>
        <th>Padecimiento</th>
        <th>Observaciones</th>
        <th>Medicamento</th>
      </tr>
    </thead>

    <tbody>
  ';
  $sql="SELECT * FROM consultas WHERE paciente = '".$paciente."' ".$ini.$fin." ";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
    $st = 200;
    while($row = $result->fetch_assoc()) {
      $id = $row['id'];
      $fecha = $row['fecha'];
      $edadmeses = $row['edadmeses'];
      $motivos = $row['motivos'];
      $padecimientos = $row['padecimientos'];
      $observ = $row['observ'];
      $medicamento = $row['medicamento'];
      
      $output .= '
        <tr id="'.$id.'">
          <td>'.$fecha.'</td>
          <td>'.$edadmeses.'</td>
          <td>'.$motivos.'</td>
          <td>'.$padecimientos.'</td>
          <td>'.$observ.'</td>
          <td>'.$medicamento.'</td>
        </tr>
      ';
    }
  }else{
    $st = 201;
  }

$output .= '
    </tbody>
  </table>
  ';
echo json_encode(array("statusCode"=>$st,"data1"=>$output));
?>