<?php
	require_once("../conexion.php");

	$fecha=$_REQUEST['fecha'];
	$usuario=$_REQUEST['usuario'];
	$cliente=$_REQUEST['cliente'];

	$sql_insert = "INSERT INTO presupuesto(pre_fecha,emp_usuario,cli_codigo,pre_activo) 
				   values (:FECHA,:USUARIO,:CLIENTE,1)";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':FECHA', $fecha);
	$stmt->bindParam(':USUARIO', $usuario);
	$stmt->bindParam(':CLIENTE', $cliente);

	if($stmt->execute()) {
		$id = $PDO->lastInsertID();
		$datos = array("CREATE"=>"OK", "ID"=>$id);
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);

	?>