<?php
 @session_start();
 $user=$_SESSION['usuario'];
 $fecha_actual= date("Y-m-d");
require_once("../../conexiones/class_cliente.php");
require_once("../../conexiones/conexion.php");
//print_r($_POST);nick_usu
$tra=new cliente();
if(isset($_POST['ide_suc'])){$ide_suc=$_POST['ide_suc'];
					 }else
					 {$ide_suc=0;
					 };				 
					 
$tra->add_cliente($_POST['rsoc'],
				 $_POST['estado'],
				 $ide_suc,
				 $_POST['tip_per'],
				 $_POST['ruc'],
				 $_POST['direccion'],
				 $_POST['refdom'],
				 $_POST['pais'],
				 $_POST['departamento'],
				 $_POST['provincia'],
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
