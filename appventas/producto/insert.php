<?php
	require_once("../conexion.php");

	$descripcion=$_REQUEST['descripcion'];
	$marca=$_REQUEST['marca'];
	$costo=$_REQUEST['costo'];
	$precio=$_REQUEST['precio'];
	
	$sql_insert = "INSERT INTO producto(pro_descripcion,mar_codigo,pro_costo,pro_precio) 
				   values (:DESCRIPCION, :MARCA, :COSTO, :PRECIO)";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':DESCRIPCION', $descripcion);
	$stmt->bindParam(':MARCA', $marca);
	$stmt->bindParam(':COSTO', $costo);
	$stmt->bindParam(':PRECIO', $precio);

	if($stmt->execute()) {
		$id = $PDO->lastInsertID();
		$datos = array("CREATE"=>"OK", "ID"=>$id);
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);

	?>