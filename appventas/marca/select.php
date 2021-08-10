<?php
	require_once("../conexion.php");

	$sql_read = "SELECT * from marca ORDER BY mar_codigo";

	$datos = $PDO->query($sql_read);

	$resultado = array();

	while($m = $datos->fetch(PDO::FETCH_OBJ)){
		$resultado[]=array("cod"=>$m->mar_codigo, "des"=>$m->mar_descripcion);
	}

	echo json_encode($resultado);
?>