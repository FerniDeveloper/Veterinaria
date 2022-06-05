<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$cpGlobal = array("CHI", "PSL");
$_SESSION['error'] = "";
//************************************************************************************************************************************
$cfg['lang'] = 'es';
$cfg['collation_connection'] = 'utf8mb4_unicode_ci';

	
function conecta(){
	$servername = "localhost";
	$database = "veterinaria";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);
	mysqli_set_charset($conn, "utf8");
	//mysqli_query("SET SESSION time_zone = '+6:00'"); 
	//qry("SET timezone = '+6:00'"); 

	// Check connection
	$_SESSION['error'] .= "Connected successfully ";
	if (!$conn) {

	    die("Connection failed: " . mysqli_connect_error());
	    $_SESSION['error'] .= "Error de GenerarConexion ";
	}
	return $conn;
	//echo "Connected successfully";
}

function insertLog($tipo, $detalle, $cardCode, $correo, $lugar){
	$resultado=0;
	try{
		$sql = " INSERT INTO webLogCatalogos2(tipo, detalle, cardCode, correo, fecha, lugar) VALUES('".$tipo."','".$detalle."','".$cardCode."','".$correo."', GETDATE(),'".$lugar."') ";
	    $db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
		$dat	=	$q->fetchAll();
		foreach($dat as $row){ 
			$resultado=$row[0];
		}
	} catch ( Exception $e) {
    	//echo 'Error de Insertar log: ' . $e->getMessage(); 
    	$_SESSION['error'] .= "Error de insertLog ";  
    }
    mysqli_close($db);
	return $resultado;
}

function sp($sql){
	//$sql="SELECT [dbo].[RemoverTildes] (".$data.") as res FROM ".$funcion." WHERE ".$condicion;
    $resultado=0;
    try{
    	$db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
		$dat	=	$q->fetchAll();
		foreach($dat as $row){ 
			$resultado=$row[0];
		}
	} catch ( Exception $e) {
    	//echo 'Error de sp: ' . $e->getMessage();  
    	$_SESSION['error'] .= "Error de sp "; 
    }
    mysqli_close($db);
	return $resultado;
}// fin de la funcion buscar

function updateSQL($sql){
	//$sql="SELECT [dbo].[RemoverTildes] (".$data.") as res FROM ".$funcion." WHERE ".$condicion;
    try{
    	$db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
	} catch ( Exception $e) {
   		 //echo 'Error de updateSQL: ' . $e->getMessage();
   		 $_SESSION['error'] .= "Error de updateSQL ";   
    }
    mysqli_close($db);
	//return $resultado;
}// fin de la funcion buscar

//************************************************************************************************************************************
function search($sql){
	//$sql="SELECT [dbo].[RemoverTildes] (".$data.") as res FROM ".$funcion." WHERE ".$condicion;
	try{
	    $db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
		$dat	=	$q->fetchAll();
		foreach($dat as $row){ 
			$resultado=$row[0];
		}
	} catch ( Exception $e) {
    	//echo 'Error de search: ' . $e->getMessage();  
    	$_SESSION['error'] .= "Error de search "; 
    }
    mysqli_close($db);
	return $resultado;
}// fin de la funcion buscar 

function qry($sql){
	try{
	    $db	= conecta();
		$q = $db->prepare(utf8_decode($sql));
		$q->execute();
		$dat	=	$q->fetchAll(); $i=0;
		
	} catch ( Exception $e) {
    	//echo 'Error de qry: ' . $e->getMessage();  
    	$_SESSION['error'] .= "Error de qry "; 
    }
    mysqli_close($db);
	return $tot;
}// fin de la funcion buscar 
/**/
function qry2($funcion,$data,$condicion){
	try{
		$sql="SELECT [dbo].[RemoverTildes] (".$data.") as res FROM ".$funcion." WHERE ".$condicion;
	    $db	= conecta();
		$q = $db->prepare(utf8_decode($sql));
		$q->execute();
		$dat	=	$q->fetchAll();
		foreach($dat as $row){ 
			$resultado=$row['res'];
		}
	} catch ( Exception $e) {
    	//echo 'Error de qry2: ' . $e->getMessage();
    	$_SESSION['error'] .= "Error de qry2 ";   
    }
    mysqli_close($db);
	return $resultado;
}// fin de la funcion buscar 

// funcion para insertar o actualizar o borrar registros.
function put($funcion,$data1,$data2){
	try{
		// INSERT INTO cotiza_web (cliente,email,fecha,pedido) VALUES ('$clent','$email','$fechaH','$chk')
		$sql="set time_zone = '-06:00'" ;
		//echo $sql;
	    $db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();

		$sql="INSERT INTO ".$funcion." (".$data1.") VALUES (".$data2.")" ;
		//echo $sql;
		$q = $db->prepare($sql);
		$q->execute();
		//*************************************************************************
		$s="SELECT MAX(id) from pedidos";
		//$idT = idTable($s);
	} catch ( Exception $e) {
    	//echo 'Error de put: ' . $e->getMessage();  
    	$_SESSION['error'] .= "Error de put "; 
    }
    mysqli_close($db);
	//return $idT;
}// fin de la funcion query

function updt($funcion,$data1,$data2){
	try{
		// INSERT INTO cotiza_web (cliente,email,fecha,pedido) VALUES ('$clent','$email','$fechaH','$chk')
		$sql="UPDATE ".$funcion." SET ".$data1." WHERE ".$data2."" ;
		//echo $sql;
	    $db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
		//*************************************************************************
		$s="SELECT IDENT_CURRENT('".$funcion."')";
		//$idT = idTable($s);
	} catch ( Exception $e) {
    	//echo 'Error de put: ' . $e->getMessage();  
    	$_SESSION['error'] .= "Error de put "; 
    }
    mysqli_close($db);
	//return $idT;
}// fin de la funcion query


function dlt($funcion,$data2){
	try{
		// INSERT INTO cotiza_web (cliente,email,fecha,pedido) VALUES ('$clent','$email','$fechaH','$chk')
		$sql="DELETE FROM ".$funcion." WHERE ".$data2."" ;
		//echo $sql;
	    $db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
		//*************************************************************************
		$s="SELECT IDENT_CURRENT('".$funcion."')";
		//$idT = idTable($s);
	} catch ( Exception $e) {
    	//echo 'Error de put: ' . $e->getMessage();  
    	$_SESSION['error'] .= "Error de put "; 
    }
    mysqli_close($db);
	//return $idT;
}// fin de la funcion query

function idTable($sql){
	try{
	    $db	= conecta();
		$q = $db->query($sql);
		//$q->execute();
		$dat	=	$q->fetch_assoc();
		$i=0;
		foreach($dat as $row){ 
			$tot=$row[0];
		}
	} catch ( Exception $e) {
    	//echo 'Error de idTable: ' . $e->getMessage(); 
    	$_SESSION['error'] .= "Error de idTable ";  
    }
    mysqli_close($db);
	return $tot;
}


function query($funcion,$data,$condicion){
	try{
		if(empty($condicion)){ $where=''; }else{ $where=' WHERE '.$condicion; }
		//SELECT  [dbo].[RemoverTildes] (Producto)as Producto from vw_productos_todos where
		$sql="SELECT ".$data." as reg FROM ".$funcion." ".$where ;
	    $db	= conecta();
		$q = $db->prepare($sql);
		$q->execute();
		$dat	=	$q->fetchAll();
		$i=0;
		foreach($dat as $row){ 
			$tot=$row['reg'];
		}
	} catch ( Exception $e) {
    	//echo 'Error de query: ' . $e->getMessage(); 
    	$_SESSION['error'] .= "Error de query ";  
    }
    mysqli_close($db);
    //$tot=$sql;
	return array('var' => $tot);
	
}// fin de la funcion query

function stripAccents($string){
	    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
	ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
	bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($string);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function normaliza ($cadena){
	    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
	ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
	bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}
function ObtenerNavegador($user_agent) {
     $navegadores = array(
          'Opera' => 'Opera',
          'Mozilla Firefox'=> '(Firebird)|(Firefox)',
          'Galeon' => 'Galeon',
          'Mozilla'=>'Gecko',
          'MyIE'=>'MyIE',
          'Lynx' => 'Lynx',
          'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
          'Konqueror'=>'Konqueror',
/*          'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
          'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
          'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
          'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',*/
);
foreach($navegadores as $navegador=>$pattern){
       if (eregi($pattern, $user_agent))
       return $navegador;
    }
	return 'Desconocido';
}
	

function cutText($string, $limit, $break='.', $pad='...') {
  if(strlen($string) <= $limit){ return $string;}
  if(false !== ($breakpoint = strpos($string, $break, $limit))){
	   if($breakpoint < strlen($string)-1) {
		   $string = substr($string, 0, $breakpoint) . $pad;
	   }
  }
  return $string;
}


function acentos($text) {
    // map based on:
    // http://konfiguracja.c0.pl/iso02vscp1250en.html
    // http://konfiguracja.c0.pl/webpl/index_en.html#examp
    // http://www.htmlentities.com/html/entities/
    $map = array(
        chr(0x8A) => chr(0xA9),
        chr(0x8C) => chr(0xA6),
        chr(0x8D) => chr(0xAB),
        chr(0x8E) => chr(0xAE),
        chr(0x8F) => chr(0xAC),
        chr(0x9C) => chr(0xB6),
        chr(0x9D) => chr(0xBB),
        chr(0xA1) => chr(0xB7),
        chr(0xA5) => chr(0xA1),
        chr(0xBC) => chr(0xA5),
        chr(0x9F) => chr(0xBC),
        chr(0xB9) => chr(0xB1),
        chr(0x9A) => chr(0xB9),
        chr(0xBE) => chr(0xB5),
        chr(0x9E) => chr(0xBE),
        chr(0x80) => '&euro;',
        chr(0x82) => '&sbquo;',
        chr(0x84) => '&bdquo;',
        chr(0x85) => '&hellip;',
        chr(0x86) => '&dagger;',
        chr(0x87) => '&Dagger;',
        chr(0x89) => '&permil;',
        chr(0x8B) => '&lsaquo;',
        chr(0x91) => '&lsquo;',
        chr(0x92) => '&rsquo;',
        chr(0x93) => '&ldquo;',
        chr(0x94) => '&rdquo;',
        chr(0x95) => '&bull;',
        chr(0x96) => '&ndash;',
        chr(0x97) => '&mdash;',
        chr(0x99) => '&trade;',
        chr(0x9B) => '&rsquo;',
        chr(0xA6) => '&brvbar;',
        chr(0xA9) => '&copy;',
        chr(0xAB) => '&laquo;',
        chr(0xAE) => '&reg;',
        chr(0xB1) => '&plusmn;',
        chr(0xB5) => '&micro;',
        chr(0xB6) => '&para;',
        chr(0xB7) => '&middot;',
        chr(0xBB) => '&raquo;',
    );
    return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
}

?>