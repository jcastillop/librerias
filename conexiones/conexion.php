<?php

//$servidor="localhost";
//$user_conexion='root';
//$clave='';

$servidor="sbcc-peru.com";
$user_conexion='sbccperu_sbcc';
$clave='sbcc2014';
$bd_server_libreria='sbccperu_libreria';

//$servidor="192.168.1.200";
//$user_conexion='grupo1';
//$clave='123456';
//$bd_server_libreria='bd_libreria_test';

class Conectar 
{
	public static function con()
	{
		$conexion=mysql_connect("sbcc-peru.com","sbccperu_sbcc","sbcc2014");
		//$conexion=mysql_connect("192.168.1.200","grupo1","123456");
		
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db("sbccperu_libreria");
		//mysql_select_db("bd_libreria_test");
		
		return $conexion;
	}
}
?>