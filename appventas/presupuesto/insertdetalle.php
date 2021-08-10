<?php
	require_once("../conexion.php");

	$presupuesto=$_REQUEST['presupuesto'];
	$producto=$_REQUEST['producto'];
	$cantidad=$_REQUEST['cantidad'];
	$precio=$_REQUEST['precio'];
	$subtotal=$_REQUEST['subtotal'];

	$sql_insert = "INSERT INTO presupuesto_detalle(pre_codigo,pro_codigo,pdet_cantidad,pdet_precio,pdet_subtotal) 
				   values (:PRESUPUESTO,:PRODUCTO,:CANTIDAD,:PRECIO,:SUBTOTAL)";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':PRESUPUESTO', $presupuesto);
	$stmt->bindParam(':PRODUCTO', $producto);
	$stmt->bindParam(':CANTIDAD', $cantidad);
	$stmt->bindParam(':PRECIO', $precio);
	$stmt->bindParam(':SUBTOTAL', $subtotal);

	if($stmt->execute()) {
		$id = $PDO->lastInsertID();
		$datos = array("CREATE"=>"OK", "ID"=>$id);
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);

	?>