<?php
	require_once("../conexion.php");

	$cedula=$_REQUEST['cedula'];
	$nombre=$_REQUEST['nombre'];
	$apellido=$_REQUEST['apellido'];
	$ruc=$_REQUEST['ruc'];
	$telefono=$_REQUEST['telefono'];
	
	$sql_insert = "INSERT INTO cliente(cli_ci,cli_nombre,cli_apellido,cli_ruc,cli_telefono) values (:CEDULA, :NOMBRE, :APELLIDO, :RUC, :TELEFONO)";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CEDULA', $cedula);
	$stmt->bindParam(':NOMBRE', $nombre);
	$stmt->bindParam(':APELLIDO', $apellido);
	$stmt->bindParam(':RUC', $ruc);
	$stmt->bindParam(':TELEFONO', $telefono);

	$stmt->execute();
	$id = $PDO->lastInsertID();
	$arr = $stmt->errorCode();
	
	if ($arr==23000) {
		$datos = array("CREATE"=>"EXISTE");
	} else {
		$datos = array("CREATE"=>"OK", "ID"=>$id);	
	}
   
	echo json_encode($datos);
?>