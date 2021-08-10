<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];
	$cedula=$_REQUEST['cedula'];
	$nombre=$_REQUEST['nombre'];
	$apellido=$_REQUEST['apellido'];
	$ruc=$_REQUEST['ruc'];
	$telefono=$_REQUEST['telefono'];
	
	$sql_insert = "UPDATE cliente set cli_ci=:CEDULA, cli_nombre=:NOMBRE, cli_apellido=:APELLIDO, cli_ruc=:RUC, cli_telefono=:TELEFONO WHERE cli_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CODIGO', $codigo);
	$stmt->bindParam(':CEDULA', $cedula);
	$stmt->bindParam(':NOMBRE', $nombre);
	$stmt->bindParam(':APELLIDO', $apellido);
	$stmt->bindParam(':RUC', $ruc);
	$stmt->bindParam(':TELEFONO', $telefono);

	$stmt->execute();
	$arr = $stmt->errorCode();
	
	if ($arr==23000) {
		$datos = array("CREATE"=>"EXISTE");
	} else {
		$datos = array("CREATE"=>"OK");	
	}

	echo json_encode($datos);
?>