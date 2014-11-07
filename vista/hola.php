<?php
function misolofechagmt($fecha_timestamp,$gmt=0)
{
    $timestamp=$fecha_timestamp; //puedes poner aqui la hora en formato "Unix timestamp" obtenida de una tabla
    $diferenciahorasgmt = (date('Z', time()) / 3600 - $gmt) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
    $timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
    $fecha_hora = date("Y-m-d", $timestamp_ajuste); //mostramos la fecha/hora
    return $fecha_hora;
}
$fecha = date("Y-m-d"); 
echo $fecha."\n";
echo misolofechagmt(time(),-5);
?>		