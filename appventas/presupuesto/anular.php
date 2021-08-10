<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];

	$sql_insert = "UPDATE presupuesto set pre_activo=0 where pre_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CODIGO', $codigo);
	
	if($stmt->execute()) {
		$datos = array("CREATE"=>"OK");
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);

	?>