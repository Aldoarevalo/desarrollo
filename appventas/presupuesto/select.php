<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];

	$sql_search = "SELECT pd.pdet_codigo, p.pro_descripcion, pd.pdet_precio, pd.pdet_cantidad, pd.pdet_subtotal FROM presupuesto_detalle pd, producto p WHERE pd.pro_codigo=p.pro_codigo AND pd.pre_codigo =:CODIGO";

	$stmt = $PDO->prepare($sql_search);

	$stmt->bindParam(':CODIGO', $codigo);

	if($stmt->execute()) {
		$a=0;
		while($m = $stmt->fetch(PDO::FETCH_OBJ)){
			$datos[]=array(	"CREATE"=>"OK",
							"coddet"=>$m->pdet_codigo, 
							"des"=>$m->pro_descripcion,
							"pre"=>$m->pdet_precio,
							"can"=>$m->pdet_cantidad,
							"sub"=>$m->pdet_subtotal);
			$a=1;
		}

		if($a==0) $datos = array("CREATE"=>"NO EXISTE");

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}

	echo json_encode($datos);
?>