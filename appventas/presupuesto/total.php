<?php
	require_once("../conexion.php");

	$codigo=$_REQUEST['codigo'];

	$sql = "SELECT * FROM presupuesto_detalle WHERE pre_codigo =:CODIGO";
	$stmt1 = $PDO->prepare($sql);

	$stmt1->bindParam(':CODIGO', $codigo);

	if($stmt1->execute()) {
		$a=0;
		while($m = $stmt1->fetch(PDO::FETCH_OBJ)){
			$datos=array(	"CREATE"=>"OK",
							"total"=>$m->total);
			$a=1;
		}

		if($a==0){
				$datos = array("CREATE"=>"0");
		} else {
				$sql_search = "SELECT sum(pdet_subtotal) as total FROM presupuesto_detalle WHERE pre_codigo =:CODIGO";

		$stmt = $PDO->prepare($sql_search);

		$stmt->bindParam(':CODIGO', $codigo);

		if($stmt->execute()) {
			$a=0;
			while($m = $stmt->fetch(PDO::FETCH_OBJ)){
				$datos=array(	"CREATE"=>"OK",
								"total"=>$m->total);
				$a=1;
			}

			if($a==0) $datos = array("CREATE"=>"NO EXISTE");

		} else {
			$datos = array("CREATE"=>"ERROR SQL");
		}
		}

	} else {
		$datos = array("CREATE"=>"ERROR SQL");
	}



	echo json_encode($datos);
?>