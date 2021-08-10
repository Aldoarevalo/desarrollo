<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];
	
	$sql_insert = "DELETE from presupuesto_detalle where pdet_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CODIGO', $codigo);


	if($stmt->execute()) {
		//$id = $PDO->lastInsertID();
		$datos = array("CREATE"=>"OK");
	} else {
		$datos = array("CREATE"=>"ERRO");
	}

	echo json_encode($datos);

	?>