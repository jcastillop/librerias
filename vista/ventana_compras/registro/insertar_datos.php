<?php
	require_once("conexion.php");
	$_cod_emp=$_POST['cod_emp'];
	$_cod_suc=$_POST['cod_suc'];
	$_fec_rec=$_POST['fec_rec'];
	$_fec_emi=$_POST['fec_emi'];
	$_fec_cad=$_POST['fec_cad'];
	$_desc=$_POST['desc'];
	$_ped_usu='JCASTILLO';
	$fecha_actual =Fechas::mifechagmtactual(time(),-5);
	$array = json_decode($_POST['compra_detalle']);
	
	$query_call_spcompcab = "CALL proc_insertar_comp_cab(".$_cod_suc.",".$_cod_emp.",'"
	                                                                   .$_desc."','".$_fec_rec."','".$_fec_emi."','".$_fec_cad."','"
	                                                                   .$_ped_usu."',@n_Flag, @c_msg, @cod_generado)";
	mysql_query($query_call_spcompcab,Conectar::con());
	
	$array_flag_com_cab = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
	$array_codgen_com_cab = mysql_fetch_array(mysql_query("Select @cod_generado",Conectar::con()));
	$codigo_flag_cabecera = $array_flag_com_cab["@n_Flag"];
	$codigo_gen_cabecera = $array_codgen_com_cab["@cod_generado"]; 
		//Ejecucion del Procedimiento Insertar Cabecera
	$contador = 0; 

	for($i=0;$i<count($array);$i++){ 
		$cod_comp_det=$i+1;
		$cantidad = $array[$i]->cantidad_libro_detalle;
		$valor = $array[$i]->precio_libro_detalle;
		$proveedor= $array[$i]->proveedor_libro_detalle;
		$cod_bar=$array[$i]->codigo_barras_detalle;//con esto hallar el codigo de titulo
		
		$moneda = $array[$i]->moneda_libro_detalle;//con esto hallar el codigo de moneda
		//buscar tipo de cambio segun fecha actual
		//datos para registrar nuevo titulo
		$titulo_libro= $array[$i]->titulo_libro_detalle;
		$autor_libro= $array[$i]->autor_libro_detalle;
		$descripcion_libro = $array[$i]->descripcion_libro_detalle;
		$isbn_libro = $array[$i]->isbn_libro_detalle;
		$edicion_libro = $array[$i]->edicion_libro_detalle;
		$nropag_libro = $array[$i]->nropag_libro_detalle;
		$desc_editorial_libro = $array[$i]->editorial_libro_detalle;//Con esto se hallara el id de la editorial
		$desc_genero_libro = $array[$i]->genero_libro_detalle;//Con esto se hallara el id del genero
		$desc_pais = $array[$i]->pais_libro_detalle;//Con esto se hallara el codigo del pais
		//falta codigo de barra del libro
		$query_call_spcompdet = "CALL proc_insertar_comp_det(".$_cod_emp.",".$_cod_suc.",'"
																.$codigo_gen_cabecera."',".$cod_comp_det.",".$cantidad.",".$valor.","
																.$proveedor.",'".$titulo_libro."',".$moneda.",'".$fecha_actual."','"
																.$_ped_usu."','".$autor_libro."','".$descripcion_libro."','".$cod_bar."','"
																.$isbn_libro."',".$edicion_libro.",".$nropag_libro.",'".$desc_editorial_libro."','"
																.$desc_genero_libro."','".$desc_pais."',@n_Flag, @c_msg)";
																

		mysql_query($query_call_spcompdet,Conectar::con());
	
		$array_flag_com_det = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
		$array_mensaje_com_det = mysql_fetch_array(mysql_query("Select @c_msg",Conectar::con()));
		$codigo_flag_detalle = $array_flag_com_det["@n_Flag"];
		
		if ($codigo_flag_detalle==0) {
		$contador=$contador+1; 
		
   		};


	}
	echo "Numero de registros insertados: ".$contador;

		

		
		       
       
      
     



//metodo de busqueda de codigo titulos
//metodo de busqueda de codigo proveedor
//metodo busqueda codigo moneda
//metodo busqueda tipo cambio (segun fecha)
?>