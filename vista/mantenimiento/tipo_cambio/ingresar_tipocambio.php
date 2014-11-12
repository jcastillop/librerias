<?php
 @session_start();
 $user=$_SESSION['usuario'];/*captura la variable de session del usuario que ingresa al sistema*/
 $fecha_actual= date("Y-m-d");
 require_once("../../../conexiones/class_tipocambio.php");
require_once("../../../conexiones/conexion.php");
//print_r($_POST);nick_usu
$tra=new tipocambio();

$tra->add_tipocambio($_POST["int_cod_mon"],
					$_POST["var_fec_tc"],
					$_POST["dec_val_tc"],
					$_POST["var_desc_tc"],	
					$user,
					$fecha_actual,					
					$user,
					$fecha_actual
					);
?>
