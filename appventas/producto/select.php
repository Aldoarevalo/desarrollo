<?php
    require_once("../conexion.php");

	$sql_read = "SELECT * from producto,marca where marca.mar_codigo=producto.mar_codigo ORDER BY pro_codigo";

	$datos = $PDO->query($sql_read);

	$resultado = array();

	while($m = $datos->fetch(PDO::FETCH_OBJ)){
		$resultado[]=array(	"cod"=>$m->pro_codigo, 
							"des"=>$m->pro_descripcion,
							"mar"=>$m->mar_descripcion,
							"marcod"=>$m->mar_codigo,
							"cos"=>$m->pro_costo,
							"pre"=>$m->pro_precio
						);
	}
	
	echo json_encode($resultado);
?>