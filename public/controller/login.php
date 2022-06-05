<?php
$st = 201;
include('../db/dss.php');
$db = conecta();
  if ((isset($_POST["username"]) && !empty($_POST["username"])) && (isset($_POST["pss"]) && !empty($_POST["pss"])) ) {
    $username = $_POST['username'];
    $pss = $_POST['pss'];

    $sql="SELECT nombre, username, tipo, hsh, nombre as nombreagente FROM net where username = '".$username."'";
        
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if (password_verify($pss, $row['hsh'])) {
          $_SESSION['VSPINT']['nombre'] = $row['nombreagente'];
          $_SESSION['VSPINT']['username'] = $row['username'];
          $_SESSION['VSPINT']['tipo'] = $row['tipo'];
          $time = $_SERVER['REQUEST_TIME'];
          $_SESSION['LAST_ACTIVITY'] = $time;
          $st = 200;
        }else{
          $st = 202;
        }
      }
    }else{
      $st = 203;
    }
  } 

  echo json_encode(array("statusCode"=>$st));
  ?>