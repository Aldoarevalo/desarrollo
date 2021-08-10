<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];

	$sql_search = "SELECT p.pre_fecha, p.emp_usuario, c.cli_nombre,c.cli_apellido, c.cli_ci FROM presupuesto p, cliente c WHERE p.cli_codigo=c.cli_codigo AND p.pre_codigo =:CODIGO and pre_activo=1";

	$stmt = $PDO->prepare($sql_search);

	$stmt->bindParam(':CODIGO', $codigo);

	if($stmt->execute()) {
		$a=0;
		while($m = $stmt->fetch(PDO::FETCH_OBJ)){
			$datos=array(	"CREATE"=>"OK",
							"fecha"=>$m->pre_fecha, 
							"usuario"=>$m->emp_usuario,
							"nombre"=>$m->cli_nombre,
							"apellido"=>$m->cli_apellido,
							"cedula"=>$m->cli_ci);
			$a=1;
		}

		if($a==0) $datos = array("CREATE"=>"NO EXISTE");

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}

	echo json_encode($datos);
?>