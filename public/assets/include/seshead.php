<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$time = $_SERVER['REQUEST_TIME'];

$timeout_duration = 1800;
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
  session_unset();
  session_destroy();
  session_start();
  ?><script type="text/javascript">window.location.href = 'login';</script><?php
}else if(isset($_SESSION['LAST_ACTIVITY'])){
  $time = $_SERVER['REQUEST_TIME'];
  $_SESSION['LAST_ACTIVITY'] = $time;
}else if(!isset($_SESSION['VSPINT'])){

  ?><script type="text/javascript">
      window.stop();
      alertaSes("Debes iniciar sesión");
  </script><?php
}

//$d = date("h:i:sa");
?>
