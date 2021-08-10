<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];

	$sql_search = "SELECT * from empleado where emp_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_search);

	$stmt->bindParam(':CODIGO', $codigo);

	if($stmt->execute()) {
		$a=0;
		while($m = $stmt->fetch(PDO::FETCH_OBJ)){
			$datos=array(	"CREATE"=>"OK", 
							"cod"=>$m->emp_codigo, 
							"ci" =>$m->emp_ci,
							"nom"=>$m->emp_nombre,
							"ape"=>$m->emp_apellido,
							"sal"=>$m->emp_salario,
							"tel"=>$m->emp_telefono,
							"usu"=>$m->emp_usuario,
							"pas"=>$m->emp_clave);
			$a=1;
		}

		if($a==0) $datos = array("CREATE"=>"NO EXISTE");

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}

	echo json_encode($datos);
?>