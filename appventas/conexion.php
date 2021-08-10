<?php
	try {
		$PDO=new PDO("mysql:host=localhost;dbname=dfactory_utic","root","");
	} catch (PDOException $err){
		echo $err->getMessage();
	}
?>