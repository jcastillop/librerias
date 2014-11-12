<?php
 @session_start();
 $user=$_SESSION['usuario'];/*captura la variable de session del usuario que ingresa al sistema*/
 $fecha_actual= date("Y-m-d");
require_once("../../../conexiones/class_genero.php");
require_once("../../../conexiones/conexion.php");
//print_r($_POST);nick_usu
$tra=new genero();

$tra->add_generos(	$_POST["var_nom_gen"],
					$_POST["var_des_gen"],
					$_POST["int_est_gen"],					
					$user,
					$fecha_actual,
					$user,
					$fecha_actual);
?>
