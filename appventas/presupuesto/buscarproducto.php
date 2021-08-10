<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];

	$sql_search = "SELECT * from producto where pro_codigo=:CODIGO";

	$stmt = $PDO->prepare($sql_search);

	$stmt->bindParam(':CODIGO', $codigo);

	if($stmt->execute()) {
		$a=0;
		while($m = $stmt->fetch(PDO::FETCH_OBJ)){
			$datos=array(	"CREATE"=>"OK",
							"cod"=>$m->pro_codigo, 
							"des"=>$m->pro_descripcion,
							"mar"=>$m->mar_codigo,
							"cos"=>$m->pro_costo,
							"pre"=>$m->pro_precio);
			$a=1;
		}

		if($a==0) $datos = array("CREATE"=>"NO EXISTE");

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}

	echo json_encode($datos);
?>