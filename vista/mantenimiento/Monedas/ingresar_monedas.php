<?php
 @session_start();
 $user=$_SESSION['usuario'];/*captura la variable de session del usuario que ingresa al sistema*/
 $fecha_actual= date("Y-m-d");
require_once("../../../conexiones/class_monedas.php");
require_once("../../../conexiones/conexion.php");
//print_r($_POST);nick_usu
$tra=new monedas();

$tra->add_monedas($_POST["var_nom_mon"],
					$_POST["var_des_mon"],
					$_POST["int_est_mon"],					
					$user,
					$fecha_actual,
					$user,
					$fecha_actual);
?>
