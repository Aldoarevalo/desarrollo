<?php
	include("conexion.php");

	$usuario=$_REQUEST['usuario'];
	$clave=$_REQUEST['clave'];

	$sql_search = "SELECT * from empleado where emp_usuario=:USUARIO and emp_clave=:CLAVE";
	

	$stmt = $PDO->prepare($sql_search);

	$stmt->bindParam(':USUARIO', $usuario);
	$stmt->bindParam(':CLAVE', $clave);

	if($stmt->execute()) {
		$a=0;
		while($m = $stmt->fetch(PDO::FETCH_OBJ)){
			$datos=array(	"CREATE"=>"OK", 
							"nom"=>$m->emp_nombre,
							"ape"=>$m->emp_apellido,
						    "cod"=>$m->emp_codigo);
			$a=1;
		}

		if($a==0) $datos = array("CREATE"=>"NO EXISTE");

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}

	echo json_encode($datos);
?>