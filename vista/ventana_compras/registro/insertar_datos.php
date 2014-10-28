<?php
	require_once("conexion.php");
	$_cod_emp=$_POST['cod_emp'];
	$_cod_suc=$_POST['cod_suc'];
	$_fec_reg=$_POST['fec_reg'];
	$_fec_emi=$_POST['fec_emi'];
	$_fec_cad=$_POST['fec_cad'];
	$_desc=$_POST['desc'];
	$fecha_hora_actual =Fechas::mifechagmt(time(),-5);
	$array = json_decode($_POST['compra_detalle']);

	echo $_cod_emp."\n";
	echo count($array)."\n";

	for($i=0;$i<count($array);$i++){ 
		$cantidad = $array[$i]->cantidad_libro_detalle;
		$valor = $array[$i]->precio_libro_detalle;
		$desc_proveedor= $array[$i]->proveedor_libro_detalle;
		$cod_bar=$array[$i]->codigo_barras_detalle;//con esto hallar el codigo de titulo
		
		$desc_moneda = $array[$i]->moneda_libro_detalle;//con esto hallar el codigo de moneda
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
		echo $cantidad."\n";
	}
		

		
		       
       
      
     



//metodo de busqueda de codigo titulos
//metodo de busqueda de codigo proveedor
//metodo busqueda codigo moneda
//metodo busqueda tipo cambio (segun fecha)
?>