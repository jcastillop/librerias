<?php
/*Este metodo debe ser cambiado para guardar en las tablas guia detalle, producto detalle*/
require_once("conexion.php");


$fecha_hora_actual =Fechas::mifechagmt(time(),-5);

echo $fecha_hora_actual;
?> 

