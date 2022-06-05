<?php
include('../../db/dss.php');
$db = conecta();
$d = date("h:i:sa");
$st = 203;
$output = '';
$ini = $_POST['ini'];
$fin = $_POST['fin'];
$output .= '
  <table id="ventaXrango" class="table table-striped table-bordered table-sm" style="width:100%">
    <thead>
      <tr>
        <th>No. de Pedido</th>
        <th>Cliente</th>
        <th>Productos</th>
        <th>Fecha</th>
        <th>F. de pago</th>
        <th>Importe</th>
        <th>Importe Envio</th> 
        <th>Importe Total</th> 
      </tr>
    </thead>

    <tbody>
   
  ';
$sql="SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fechacool FROM pedidos JOIN uss ON pedidos.cliente = uss.cliente WHERE (estatus = 3 AND fecha >= '".$ini."' AND fecha <= '".$fin."') OR (estatus = 2 AND fecha >= '".$ini."' AND fecha <= '".$fin."') OR (estatus = 4 AND fecha >= '".$ini."' AND fecha <= '".$fin."') OR (estatus = 6 AND fecha >= '".$ini."' AND fecha <= '".$fin."') OR (estatus = 5 AND fecha >= '".$ini."' AND fecha <= '".$fin."') ORDER BY importe DESC";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  $st = 200;
  while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $num = $row['pedido'];
    $cliente = $row['nombre']." ".$row['ape'];
    $fechacool = $row['fechacool'];
    $fpago = $row['fpago'];
    $importe = $row['importe'];
    $importe_envio = $row['importe_envio'];
    $productos = "";
    $sql1="SELECT * FROM pedidospart WHERE pedido = '".$num."'";
    $result1 = $db->query($sql1);
    if ($result1->num_rows > 0) {
      while($row1 = $result1->fetch_assoc()) {

        $sku = $row1['articulo'];
        $productos .= "<a href='../product?sku=".$sku."' target='_blank'>".$sku."</a>,";
      }
    }
  $output .= '
    <tr id="'.$id.'">
      <td>'.$num.'</td>
      <td>'.$cliente.'</td>
      <td>'.$productos.'</td>
      <td>'.$fechacool.'</td>
      <td>'.$fpago.'</td>
      <td>$'.number_format($importe,2).'</td>
      <td>$'.number_format($importe_envio,2).'</td>
      <td>$'.number_format($importe_envio+$importe,2).'</td>
    </tr>
    ';
  }
}

$output .= '
    </tbody>
  </table>
  ';
echo json_encode(array("statusCode"=>$st,"data1"=>$output));
?>