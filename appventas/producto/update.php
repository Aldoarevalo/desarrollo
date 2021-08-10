<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];
	$descripcion=$_REQUEST['descripcion'];
	$marca=$_REQUEST['marca'];
	$costo=$_REQUEST['costo'];
	$precio=$_REQUEST['precio'];

	
	$sql_insert = "UPDATE producto set pro_descripcion=:DESCRIPCION, mar_codigo=:MARCA, pro_costo=:COSTO, pro_precio=:PRECIO 
					WHERE pro_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CODIGO', $codigo);
	$stmt->bindParam(':DESCRIPCION', $descripcion);
	$stmt->bindParam(':MARCA', $marca);
	$stmt->bindParam(':COSTO', $costo);
	$stmt->bindParam(':PRECIO', $precio);
	
	if($stmt->execute()) {
			$datos=array("CREATE"=>"OK");
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);
	?>