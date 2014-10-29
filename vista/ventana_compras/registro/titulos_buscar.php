<?php
	require_once("conexion.php");
		$response = array (
            "nombre" => "",
            "precio" => 0,
            "codigo" => 0,
            "autor" => "",
            "isbn" => "",
            "edicion" => "",
            "nropag" => 0,
            "editorial" => "",
            "genero" => "",
            "pais" => "",
            "descripcion" => ""
    	);
	$tra=new titulos();
	$reg=$tra->get_titulo_por_id($_GET["id"]);
	if($reg){


		$response["codigo"]=$reg[0]["int_cod_tit"];
		$response["nombre"]=$reg[0]["var_nom_tit"];


		$response["autor"]=$reg[0]["var_autor_tit"];
		$response["isbn"]=$reg[0]["var_isbn_tit"];
		$response["edicion"]=$reg[0]["var_edic_tit"];
		$response["nropag"]=$reg[0]["int_numpag_tit"];
		$response["editorial"]=$reg[0]["var_nom_edit"];
		$response["genero"]=$reg[0]["var_nom_gen"];
		$response["pais"]=$reg[0]["var_nom_pais"];
		$response["descripcion"]=$reg[0]["var_des_tit"];

		if($reg[0]["dec_preven_def_tit"]===0){
		$response["precio"]=$reg[0]["dec_preven_sug_tit"];
		}else{
		$response["precio"]=$reg[0]["dec_preven_def_tit"];			
		}
		

	}else{

		$response["nombre"]="";
		$response["precio"]=0;
		$response["titulo_codigo"]=0;
		$response["autor"]="";
		$response["isbn"]="";
		$response["edicion"]="";
		$response["nropag"]=0;
		$response["editorial"]="";
		$response["genero"]="";
		$response["pais"]="";
		$response["descripcion"]="";
	}
	echo json_encode($response);	

?>		