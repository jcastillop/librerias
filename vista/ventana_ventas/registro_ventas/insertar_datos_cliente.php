<?php
require_once("conexion.php");

$_tip_per=$_POST['tip_per'];
$_rsoc=$_POST['rsoc'];
$_ruc=$_POST['ruc'];
$_direccion=$_POST['direccion'];
$_usuario=$_POST['usuario'];
$fecha_hora_actual =Fechas::mifechagmt(time(),-5);

$query_call_spcabped = "CALL proc_ingresar_cliente('".$_rsoc."',".$_tip_per.",'"
	                                                .$_direccion."','".$_ruc."','"
	                                                .$_usuario."','".$fecha_hora_actual."',@n_Flag, @c_msg, @n_cod)";

$array_flag = mysql_fetch_array(mysql_query("Select @n_Flag",Conectar::con()));
$array_codgen = mysql_fetch_array(mysql_query("Select @n_cod",Conectar::con()));
$array_msg = mysql_fetch_array(mysql_query("Select @c_msg",Conectar::con()));

$codigo_flag = $array_flag["@n_Flag"];
$codigo_gen = $array_codgen["@n_cod"]; 
$codi_msg = $array_codgen["@c_msg"]; 
echo $codi_msg;

?>
