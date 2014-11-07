
<?php
require_once("../../../../conexiones/conexion.php");
require_once("../../../../conexiones/class_cliente_autocompletado.php");



 if (!$_GET["q"]) return;
$tra=new cliente();
$reg=$tra->get_cliente_like(strtolower($_GET["q"]));
for ($i=0;$i<count($reg);$i++)
{
       

$cid = $reg[$i]["int_cod_cli"];
	$cname = $reg[$i]["var_rsoc_cli"];
	$ruc = $reg[$i]["var_ruc_cli"];
	$dir = $reg[$i]["var_dir_cli"];
	$dis = $reg[$i]["var_dist_cli"];
	
		echo "$cname|$cid|$ruc|$dir|$dis\n";

}
?>
