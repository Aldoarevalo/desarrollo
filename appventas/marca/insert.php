<?php
	require_once("../conexion.php");

	$descripcion=$_REQUEST['descripcion'];
	
	$sql_insert = "INSERT INTO marca(mar_descripcion) values (:DESCRIPCION)";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':DESCRIPCION', $descripcion);

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