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
if(!isset($_POST['dir_env'])){$_dir_env=$_POST['dir_env'];}else{$_dir_env='';};
$_pun_part=$_POST['pun_part'];
$_pun_lleg=$_POST['pun_lleg'];
$_cod_usu=$_POST['cod_usu'];
if(!isset($_POST['dist_gui'])){$_dist_gui=$_POST['dist_gui'];}else{$_dist_gui='';};
if(!isset($_POST['turn_gui'])){$_turn_gui=$_POST['turn_gui'];}else{$_turn_gui='0';};
if(!isset($_POST['telef_gui'])){$_telef_gui=$_POST['telef_gui'];}else{$_telef_gui='';};
$_tran_mn=$_POST['tran_mn'];
$_tran_c=$_POST['tran_c'];
$_tran_l=$_POST['tran_l'];
$_trans_rs=$_POST['trans_rs'];
$_trans_ruc=$_POST['trans_ruc'];
$_trans_dir=$_POST['trans_dir'];
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
$query_call_spcabgui = "CALL proc_insertar_guia_cab(".$_cod_suc.",".$_cod_emp.",'".$_dir_env."',"
                                                                       .$_cod_cli.",'".$codigo_gen."', 1, 1,'".$_pun_part."','".$_pun_lleg."',"
                                                                       .$_cod_usu.",'".$_dist_gui."',".$_turn_gui.",'".$_telef_gui."','"
                                                                       .$_tran_mn."','".$_tran_c."','".$_tran_l."','".$_trans_rs."','".$_trans_ruc."','".$_trans_dir."','"
                                                                       .$_fec_pedido."','".$_ped_usu."',@n_Flag, @c_msg, @cod_generado1,@c_serie)";
mysql_query($query_call_spcabgui,Conectar::con());

$codigo_msg = "";
$array_codgen1 = mysql_fetch_array(mysql_query("Select @cod_generado1",Conectar::con()));
$array_codser = mysql_fetch_array(mysql_query("Select @c_serie",Conectar::con()));
$codigo_gen1 = $array_codgen1["@cod_generado1"]; 
$codigo_ser = $array_codser["@c_serie"];

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
       $costo_total_libro = $array[$i]->costo_total_libro;
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

if ($codigo_flag==0) {
   $var_guia_detalle="'";
   for($i=0;$i<count($array);$i++){ 
       $var_cod_guia_det=$i+1;
	     $codigo_libro=$array[$i]->codigo_libro;
       $precio_libro=number_format($array[$i]->precio_libro, 2, '.', '');
       $cantidad_libro = $array[$i]->cantidad_libro;
       $valor_impuesto = number_format($array[$i]->valor_impuesto, 2, '.', '');
       $valor_descuento = number_format($array[$i]->valor_descuento, 2, '.', '');
       $porcentaje_impuesto = number_format($array[$i]->porcentaje_impuesto, 2, '.', '');
       $porcentaje_descuento = number_format($array[$i]->porcentaje_descuento, 2, '.', '');
       $costo_total_libro = number_format($array[$i]->costo_total_libro, 2, '.', '');
$var_guia_detalle=$var_guia_detalle.'(lpad("'.$var_cod_guia_det.'",6,"0"),'
       										  .'"'.$codigo_gen1.'"'.", ".'"'.$codigo_ser.'"'.", ".$_cod_suc.", ".$_cod_emp.", ". 
       	                                       $codigo_libro.", ".$cantidad_libro.", ".$precio_libro.", ".$porcentaje_impuesto.", ".$valor_impuesto. ", ".
       	                                       $costo_total_libro. ", ".$porcentaje_descuento.",".$valor_descuento.", ".$costo_total_libro.
       	                                       ',"'.$_ped_usu.'","'.$fecha_hora_actual.'")';

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
   


    $response = array ("codigo" => "", "mensaje" => "");
    $response["mensaje"]=$codigo_msg;
    $response["codigo"]=$codigo_gen1;
    echo json_encode($response);
?> 

