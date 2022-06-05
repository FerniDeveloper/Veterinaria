<?php
session_start();
session_unset();
session_destroy();

$_SESSION['VSPINT']	=	null;
$_SESSION['LAST_ACTIVITY']	=	null;

unset($_SESSION['VSPINT']);
unset($_SESSION['LAST_ACTIVITY']);



?>

<script>window.location.href = '../login'; </script>