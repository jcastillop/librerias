<?php
 @session_start();
 $user=$_SESSION['usuario'];
 $fecha_actual= date("Y-m-d");
require_once("../../../conexiones/class_cliente.php");
require_once("../../../conexiones/conexion.php");
//print_r($_POST);nick_usu
$tra=new cliente();
if($_POST['pais']==999)
{
	$pais=184;
	$departamento=15;
	$provincia=128;
}
else
{
	$pais= $_POST['pais'];
	$departamento= $_POST['departamento'];
	$provincia= $_POST['provincia'];
}

					 
$tra->add_cliente($_POST['rsoc'],
				 $_POST['estado'],
				 $ide_suc,
				 $_POST['tip_per'],
				 $_POST['ruc'],
				 $_POST['direccion'],
				 $_POST['refdom'],
				 $pais,
				 $departamento,
				 $provincia,
				 $_POST['distrito'],
				 $_POST['telefono'],
				 $_POST['fax'],
				 $_POST['dni'],
				 $_POST['correo'],
				 $user,
				 $fecha_actual,
				 $user,
				 $fecha_actual);
?>
