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
	
	//$sql_insert = "INSERT INTO empleado(emp_ci,emp_nombre,emp_apellido,emp_salario,emp_telefono,emp_usuario,emp_clave) 
	//			   values (:CEDULA, :NOMBRE, :APELLIDO, :SALARIO, :TELEFONO, :USUARIO, :CLAVE)";

	$sql_insert = "INSERT INTO empleado(emp_ci,emp_nombre,emp_apellido,emp_salario,emp_telefono,emp_usuario,emp_clave) 
				   values ($cedula,'$nombre','$apellido',$salario,$telefono,'$usuario','$clave')";

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
		$id = $PDO->lastInsertID();
		$datos = array("CREATE"=>"OK", "ID"=>$id);
	} else {
		$datos = array("CREATE"=>"ERROR");
	}

	echo json_encode($datos);

	?>