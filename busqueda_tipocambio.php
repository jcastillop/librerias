<?php
require_once("conexiones/conexion.php");
mysql_query('SET @cadena = "";',Conectar::con());
mysql_query('SET @flag = 0;',Conectar::con());
$query_call_spconsulta = "CALL proc_consulta_tipo_cambio(@cadena,@flag);";
mysql_query($query_call_spconsulta,Conectar::con());
$array_flag = mysql_fetch_array(mysql_query("Select @cadena,@flag;",Conectar::con()));
$cadena=$array_flag["@cadena"];
$flag=$array_flag["@flag"];

$response = array (
            "mensaje" => "",
            "indicador" => 0);
$response["mensaje"]=$cadena;
$response["indicador"]=$flag;
echo json_encode($response);	
?>		