<?php

	require_once("conexion.php");
		$response = array (
            "nombre_sucursal" => "",
            "direccion_sucursal" => ""
    	);
	$tra=new sucursal();
	$reg=$tra->get_sucursal_por_id($_GET["id"]);
	if($reg){

		$response["nombre_sucursal"]=$reg[0]["var_nom_suc"];
		$response["direccion_sucursal"]=$reg[0]["var_dir_suc"];

		
	}else{

		$response["nombre_sucursal"]="";
		$response["direccion_sucursal"]="";

	}
	echo json_encode($response);	

?>		