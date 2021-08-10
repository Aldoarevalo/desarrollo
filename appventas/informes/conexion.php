<?php
$servidor  ="localhost";
$usuario   ="root";
$clave     ="";
$basedatos ="appventas";

$conexion = mysql_connect($servidor, $usuario, $clave) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");
mysql_select_db($basedatos, $conexion) or die(mysql_error());

setlocale(LC_ALL,"es_ES.UTF-8");
date_default_timezone_set('America/Asuncion');
?>