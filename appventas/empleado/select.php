<?php
    require_once("../conexion.php");

	$sql_read = "SELECT * from empleado ORDER BY emp_codigo";

	$datos = $PDO->query($sql_read);

	$resultado = array();

	while($m = $datos->fetch(PDO::FETCH_OBJ)){
		$resultado[]=array(	"cod"=>$m->emp_codigo, 
							"ci"=>$m->emp_ci,
							"nom"=>$m->emp_nombre,
							"ape"=>$m->emp_apellido,
							"sal"=>$m->emp_salario,
							"tel"=>$m->emp_telefono,
							"usu"=>$m->emp_usuario,
							"pas"=>$m->emp_clave
						);
	}

	echo json_encode($resultado);
?>