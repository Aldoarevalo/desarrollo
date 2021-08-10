<?php
	require_once("../conexion.php");

	$sql_read = "SELECT * from cliente ORDER BY cli_codigo";

	$datos = $PDO->query($sql_read);

	$resultado = array();

	while($m = $datos->fetch(PDO::FETCH_OBJ)){
		$resultado[]=array(	"cod"=>$m->cli_codigo,
							"ced"=>$m->cli_ci, 
							"nom"=>$m->cli_nombre,
							"ape"=>$m->cli_apellido,
							"ruc"=>$m->cli_ruc,
							"tel"=>$m->cli_telefono);
	}

	echo json_encode($resultado);
?>