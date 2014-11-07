<?php
/*Este metodo debe ser cambiado para guardar en las tablas guia detalle, producto detalle*/
require_once("conexion.php");

/*
$descuento_produto = 1.2;
*/

$_cod_emp=$_POST['cod_emp'];
$_cod_suc=$_POST['cod_suc'];
$_cod_cli=$_POST['cod_cli'];
$_fec_pedido=$_POST['fec_pedido'];
$_ped_usu=$_POST['ped_usu'];    
$_cod_ser=$_POST['cod_ser'];
$_cod_usu=$_POST['cod_usu'];
$_tipo_doc=$_POST['tipo_doc'];
$_tip_ven=$_POST['tip_ven'];
$_con_ven=$_POST['con_ven'];

$fecha_hora_actual =Fechas::mifechagmt(time(),-5);

$array = json_decode($_POST['pedido_detalle']);
//creando query del PA insertar pedido cabecera
$query_call_spcabped = "CALL proc_insertar_pedi_cab(".$_cod_emp.",".$_cod_suc.","
	                                                                   .$_cod_cli.",'".$_fec_pedido."','"
	                                                                   .$_ped_usu."',@n_Flag, @c_msg, @cod_generado)";



//Ejecucion del Procedimiento Insertar Cabecera
mysql_query($query_call_spcabped,Conectar::con());


$array_flag = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
$array_codgen = mysql_fetch_array(mysql_query("Select @cod_generado",Conectar::con()));
$codigo_flag = $array_flag["@n_Flag"];
$codigo_gen = $array_codgen["@cod_generado"]; 

//creando query del PA insertar guia cabecera
$query_call_spcabgui = "CALL proc_insertar_guia_cab(".$_cod_suc.",".$_cod_emp.",'',"
                                                                       .$_cod_cli.",'".$codigo_gen."', 2, 1,'','',"
                                                                       .$_cod_usu.",'',0,'','','','','','','','"
                                                                       .$_fec_pedido."','".$_ped_usu."',@n_Flag1, @c_msg1, @cod_generado1, @c_serie)";

mysql_query($query_call_spcabgui,Conectar::con());

$codigo_msg1 = "";
$array_flag1 = mysql_fetch_array(mysql_query("Select @n_Flag1",Conectar::con()));
$array_codgen1 = mysql_fetch_array(mysql_query("Select @cod_generado1",Conectar::con()));
$array_codsergui = mysql_fetch_array(mysql_query("Select @c_serie",Conectar::con()));
$codigo_flag1 = $array_flag1["@n_Flag1"];
$codigo_gen1 = $array_codgen1["@cod_generado1"]; 
$cod_sergui = $array_codsergui["@c_serie"];


//creando query del PA insertar Factura cabecera
$query_call_spfact = "CALL proc_insertar_fact_cab(".$_cod_suc.",".$_cod_emp.",".$_cod_cli.",'".$codigo_gen1."',"
                                                                       .$_cod_usu.",'"
                                                                       .$_fec_pedido."',".$_tipo_doc.",".$_tip_ven.","
                                                                       .$_con_ven.",'".$_ped_usu.
                                                                       "',@n_Flag3, @c_msg3, @cod_generado3,@cod_ser)";

mysql_query($query_call_spfact,Conectar::con());

$codigo_msg3 = "";
$array_flag3 = mysql_fetch_array(mysql_query("Select @n_Flag3",Conectar::con()));
$array_codgen3 = mysql_fetch_array(mysql_query("Select @cod_generado3",Conectar::con()));
$array_codser = mysql_fetch_array(mysql_query("Select @cod_ser",Conectar::con()));
$codigo_flag3 = $array_flag3["@n_Flag3"];
$codigo_gen3 = $array_codgen3["@cod_generado3"];
$_cod_ser = $array_codser["@cod_ser"];

if ($codigo_flag==0) {
   $var_ped_detalle="'";
   for($i=0;$i<count($array);$i++){ 
       $var_cod_ped_det=$i+1;
	   $codigo_libro=$array[$i]->codigo_libro;
       $cantidad_libro = $array[$i]->cantidad_libro;
       $valor_impuesto = number_format($array[$i]->valor_impuesto, 2, '.', '');
       $valor_descuento = number_format($array[$i]->valor_descuento, 2, '.', '');
       $porcentaje_impuesto = number_format($array[$i]->porcentaje_impuesto, 2, '.', '');
       $porcentaje_descuento = number_format($array[$i]->porcentaje_descuento, 2, '.', '');
       $costo_total_libro = number_format($array[$i]->costo_total_libro, 2, '.', '');
$var_ped_detalle=$var_ped_detalle.'(lpad("'.$var_cod_ped_det.'",6,"0"),'
       										  .'"'.$codigo_gen.'"'.", ".$_cod_suc.", ".$_cod_emp.", ". 
       	                                       $codigo_libro.", ".$cantidad_libro.", ".$porcentaje_impuesto.", ".$valor_impuesto. ", ".
       	                                       $costo_total_libro. ", ".$porcentaje_descuento.",".$valor_descuento.", ".$costo_total_libro.
       	                                       ',"'.$_ped_usu.'","'.$fecha_hora_actual.'")';

       if ($i==count($array)-1){
          $var_ped_detalle = $var_ped_detalle . "'";
       }else{
          $var_ped_detalle = $var_ped_detalle . ','; 
       }  
   }
   $query_call_sppedd = "CALL proc_insertar_pedi_det(".$var_ped_detalle.", @n_Flag, @c_msg)";
   //Ejecucion del Procedimiento Insertar Detalle

   mysql_query($query_call_sppedd,Conectar::con());
   $array_flag = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
   $array_msg = mysql_fetch_array(mysql_query("Select @c_msg",Conectar::con()));
   $codigo_msg = $array_msg["@c_msg"];}

if ($codigo_flag1==0) {
   $var_guia_detalle="'";
   for($i=0;$i<count($array);$i++){ 
       $var_cod_guia_det=$i+1;
	   $codigo_libro=$array[$i]->codigo_libro;
       $cantidad_libro = $array[$i]->cantidad_libro;
       $valor_pvent = 0.00;
       $valor_impuesto = number_format($array[$i]->valor_impuesto, 2, '.', '');
       $valor_descuento = number_format($array[$i]->valor_descuento, 2, '.', '');
       $porcentaje_impuesto = number_format($array[$i]->porcentaje_impuesto, 2, '.', '');
       $porcentaje_descuento = number_format($array[$i]->porcentaje_descuento, 2, '.', '');
       $costo_total_libro = number_format($array[$i]->costo_total_libro, 2, '.', '');
       $costo_final_libro = number_format(($array[$i]->costo_total_libro+$array[$i]->valor_impuesto-$array[$i]->valor_descuento), 2, '.', '');
$var_guia_detalle=$var_guia_detalle.'(lpad("'.$var_cod_guia_det.'",6,"0"),'
       										  .'"'.$codigo_gen1.'"'.", ".'"'.$cod_sergui.'"'.", ".$_cod_suc.", ".
                                               $_cod_emp.", ". $codigo_libro.", ".$cantidad_libro.",".$valor_pvent.", ".
                                               $costo_total_libro. ", ".$porcentaje_impuesto.", ".$valor_impuesto. ", ".
                                               $porcentaje_descuento.",".$valor_descuento.", ".$costo_final_libro.',"'.$_ped_usu.'","'.$fecha_hora_actual.'")';

       if ($i==count($array)-1){
          $var_guia_detalle = $var_guia_detalle . "'";
       }else{
          $var_guia_detalle = $var_guia_detalle . ','; 
       }  
   }
    $query_call_spguid = "CALL proc_insertar_guia_det(".$var_guia_detalle.", @n_Flag, @c_msg)";
   //Ejecucion del Procedimiento Insertar Detalle

   mysql_query($query_call_spguid,Conectar::con());
   $array_flag = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
   $array_msg = mysql_fetch_array(mysql_query("Select @c_msg",Conectar::con()));
   $codigo_msg = $array_msg["@c_msg"];}
   
      if ($codigo_flag3==0) {
   $var_fact_detalle="'";
   for($i=0;$i<count($array);$i++){ 
       $var_cod_fact_det=$i+1;
       $int_tip_doc_fact=1;
	   $codigo_libro=$array[$i]->codigo_libro;
       $cantidad_libro = $array[$i]->cantidad_libro;
       $valor_impuesto = number_format($array[$i]->valor_impuesto, 2, '.', '');
       $valor_descuento = number_format($array[$i]->valor_descuento, 2, '.', '');
       $porcentaje_impuesto = number_format($array[$i]->porcentaje_impuesto, 2, '.', '');
       $porcentaje_descuento = number_format($array[$i]->porcentaje_descuento, 2, '.', '');
       $costo_total_libro = number_format($array[$i]->costo_total_libro, 2, '.', '');
$var_fact_detalle=$var_fact_detalle.'(lpad("'.$var_cod_fact_det.'",6,"0"),'
       										  .'"'.$codigo_gen3.'"'.", ".$int_tip_doc_fact.",".'"'.$_cod_ser.'"'.", ".$_cod_suc.", ".$_cod_emp.", ". 
       	                                       $codigo_libro.", ".$cantidad_libro.", ".$porcentaje_impuesto.", ".$valor_impuesto. ", ".
       	                                       $costo_total_libro. ", ".$porcentaje_descuento.",".$valor_descuento.", ".$costo_total_libro.
       	                                       ',"'.$_ped_usu.'","'.$fecha_hora_actual.'")';

       if ($i==count($array)-1){
          $var_fact_detalle = $var_fact_detalle . "'";
       }else{
          $var_fact_detalle = $var_fact_detalle . ','; 
       }  
   }
   $query_call_spfactd = "CALL proc_insertar_fact_det(".$var_fact_detalle.", @n_Flag, @c_msg)";
   //Ejecucion del Procedimiento Insertar Detalle

   mysql_query($query_call_spfactd,Conectar::con());
   
   $array_flag = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
   $array_msg = mysql_fetch_array(mysql_query("Select @c_msg",Conectar::con()));
   $codigo_msg1 = $array_msg["@c_msg"];}
 
   
    $response = array ("codigo" => "", "mensaje" => "");
    $response["mensaje"]=$codigo_msg1;
    $response["codigo"]=$codigo_gen3;
    echo json_encode($response);
?> 

