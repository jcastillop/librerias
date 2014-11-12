
<?php
require_once("../../../conexiones/class_guia.php");
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>
<head>
  <p id="deHijo"></p>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>GUÍA</title>
	<link rel="stylesheet" type="text/css" href="../../../paquetes/media/css/jquery.dataTables.css">
    	<link rel="stylesheet" type="text/css" href="../../../paquetes/media/css/dataTables.tableTools.css">
	<link rel="stylesheet" type="text/css" href="../../../paquetes/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="../../../paquetes/resources/demo.css">
	<script type="text/javascript">
		var newwindow;
		function poptastic(url)
			{
				newwindow=window.open(url,'name','height=640,width=800,left=300,padding=500');
				if (window.focus) {newwindow.focus()}
			}
		var newwindow;
		function elim(url)
			{
				newwindow=window.open(url,'name','height=200,width=400,left=400,padding=700');
				if (window.focus) {newwindow.focus()}
			}
		var newwindow;
		function impr(url)
			{
				newwindow=window.open(url,'name','height=200,width=500,left=400,padding=700');
				if (window.focus) {newwindow.focus()}
			}
	</script>
	<script type="text/javascript" language="javascript" src="../../../paquetes/media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="../../../paquetes/media/js/jquery.dataTables.js"></script>
    	<script type="text/javascript" language="javascript" src="../../../paquetes/media/js/dataTables.tableTools.js"></script>
	<script type="text/javascript" language="javascript" src="../../../paquetes/media/js/js/TableTools.j"></script>
	<script type="text/javascript" language="javascript" src="../../../paquetes/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../../../paquetes//resources/demo.js"></script>
 
	<script type="text/javascript" language="javascript" class="init">
	
	$(document).ready(function() {
	$('#example').DataTable( {
		/*"scrollY": 200,*/
        "scrollX": true,
		dom: 'T<"clear">lfrtip',
		tableTools: {
			
			"aButtons": [
				
				"print",
				
			]
		}
	} );
} );


$(document).ready(function() {
	var table = $('#example').DataTable();

	$('#example tbody').on( 'dblclick', 'tr', function () {
		$(this).toggleClass('selected');
	} );

	$('#button').click( function () {
		alert( table.rows('.selected').data().length +' row(s) selected' );
	} );
} );

/*
$(document).ready(function() {
	$('#example').dataTable();
	
	$('#example tbody').on('dblclick', 'tr', function () {
		var name = $('td', this).eq(0).text();
		alert( 'You clicked on '+name+'\'s row' );
	} );
} );
*/

$(document).ready( function () {
    var table = $('#example').DataTable();
    $.fn.dataTable.KeyTable( table );
} );

/*
para sumar en la grilla por json

$(document).ready(function() {
    $('#example').dataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            data = api.column( 4 ).data();
            total = data.length ?
                data.reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                } ) :
                0;
 
            // Total over this page
            data = api.column( 4, { page: 'current'} ).data();
            pageTotal = data.length ?
                data.reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                } ) :
                0;
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
    } );
} );

*/

	</script>
</head>

<body class="dt-example" >
	
    
    <div class="container_">
    
		<section>
			<h1>GUÍAS<span></span></h1>

			
            <div class="tablas"  align="center" >

			<table id="example"  class="display" cellspacing="0" width="100%">
				<thead>
					<tr class="cabecera" >
						<th >#</th>
			                        <th style=" width:200px;" >N.Documento</th>
			                        <th style=" width:250px;">Sucursal</th>
			                        <th style=" width:300px;">Partida</th>
			                        <th style=" width:300px;">Destino</th>
			                        <th style=" width:100px;">Condicion</th>
			                        <th style=" width:150px;">Vendedor</th>
			                        <th style=" width:200px;">Fecha Envio.</th>
			                        <th style=" width:200px;">Fecha Guia</th>
			                        <th>Exp.</th>
			                        <th>Impr.</th>
			                        <th>Anular</th>
					</tr>
				</thead>
				<tbody align="center">
                 <?php
					$tra=new guia_cabecera();
					$reg=$tra->get_guia_cabecera();
					for ($i=0;$i<count($reg);$i++)
					{
				 ?>  
					<tr>     
						<td><?php echo $reg[$i]["id"];?></td>                  
						<td><?php echo '00'.$reg[$i]["var_cod_ser"]."-".$reg[$i]["var_cod_guia_cab"];?></td> 
						<td><?php echo $reg[$i]["var_rsoc_cli"];?></td>
                				 <td><?php echo $reg[$i]["var_pun_part_guia_cab"];?></td>
						<td><?php echo $reg[$i]["var_pun_lleg_guia_cab"];?></td>
                        			<td><?php echo $reg[$i]["var_desc_mov"];?></td>
						<td><?php echo $reg[$i]["var_nom_usu"];?></td>
                				<td><?php echo $reg[$i]["date_fecenv_guia_cab"];?></td>
						<td><?php echo $reg[$i]["date_fecadd_guia_cab"];?></td>
						<td align='center' ><a href=" javascript:poptastic('reporte_historial.php?id=<?php echo $reg[$i]["var_cod_guia_cab"];?>'); " ><img src='../../../img/images/pdf.png' width='15px' height='15px'></a></td>
						<td align='center' ><a href=" javascript:impr('imprimir.php?id=<?php echo $reg[$i]["var_cod_guia_cab"];?>'); " ><img src='../../../img/images/impre.gif' width='15px' height='15px'></a></td>
						<td align='center' ><a href=" javascript:elim('eliminar_guia.php?id=<?php echo $reg[$i]["var_cod_guia_cab"];?>'); " ><img src='../../../img/images/close_delete.png' width='15px' height='15px'></a></td>
					
					</tr>
				
  <?php
}
?>        
                </tbody>
			</table>
			</div>
		</section>

	<section>
		<div class="footer"></div>
	</section>
</div>
</body>
</html>
