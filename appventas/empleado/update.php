<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];
	$cedula=$_REQUEST['cedula'];
	$nombre=$_REQUEST['nombre'];
	$apellido=$_REQUEST['apellido'];
	$salario=$_REQUEST['salario'];
	$telefono=$_REQUEST['telefono'];
	$usuario=$_REQUEST['usuario'];
	$clave=$_REQUEST['clave'];

	
	$sql_insert = "UPDATE empleado set emp_ci=:CEDULA, emp_nombre=:NOMBRE, emp_apellido=:APELLIDO, emp_salario=:SALARIO, emp_telefono=:TELEFONO, emp_usuario=:USUARIO, emp_clave=:CLAVE WHERE emp_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_insert);

	$stmt->bindParam(':CODIGO', $codigo);
	$stmt->bindParam(':CEDULA', $cedula);
	$stmt->bindParam(':NOMBRE', $nombre);
	$stmt->bindParam(':APELLIDO', $apellido);
	$stmt->bindParam(':SALARIO', $salario);
	$stmt->bindParam(':TELEFONO', $telefono);
	$stmt->bindParam(':USUARIO', $usuario);
	$stmt->bindParam(':CLAVE', $clave);
	
	if($stmt->execute()) {
			$datos=array("CREATE"=>"OK");
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);
	?>