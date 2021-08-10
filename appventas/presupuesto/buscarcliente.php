<?php
	require_once("../conexion.php");

	$cedula=$_REQUEST['cedula'];

	$sql_search = "SELECT * from cliente where cli_ci=:CEDULA";

	$stmt = $PDO->prepare($sql_search);

	$stmt->bindParam(':CEDULA', $cedula);

	if($stmt->execute()) {
		$a=0;
		while($m = $stmt->fetch(PDO::FETCH_OBJ)){
			$datos=array("CREATE"=>"OK", 
							"cod"=>$m->cli_codigo, 
							"ced"=>$m->cli_ci, 
							"nom"=>$m->cli_nombre,
							"ape"=>$m->cli_apellido,
							"ruc"=>$m->cli_ruc,
							"tel"=>$m->cli_telefono);
			$a=1;
		}

		if($a==0) $datos = array("CREATE"=>"NO EXISTE");

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}

	echo json_encode($datos);
?>