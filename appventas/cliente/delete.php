<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];
	
	$sql_insert = "DELETE from cliente where cli_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CODIGO', $codigo);
	//$stmt->bindParam(':APELLIDO', $apellido);


	if($stmt->execute()) {
		//$id = $PDO->lastInsertID();
		$datos = array("CREATE"=>"OK");
	} else {
		$datos = array("CREATE"=>"ERRO");
	}

	echo json_encode($datos);

	?>