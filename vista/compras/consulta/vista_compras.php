
<?php
require_once("../../../conexiones/class_historico_compras.php");
function nombremes($mes){
setlocale(LC_TIME, 'spanish');
$nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
return $nombre;
} 
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

	<title>Documento</title>
	<link rel="stylesheet" type="text/css" href="../../../paquetes/media/css/jquery.dataTables.css">
    	<link rel="stylesheet" type="text/css" href="../../../paquetes/media/css/dataTables.tableTools.css">
        

	<link rel="stylesheet" type="text/css" href="../../../paquetes/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="../../../paquetes/resources/demo.css">
     
   
	<style type="text/css" class="init">

	th, td { white-space: nowrap; }
	div.dataTables_wrapper {
		width: 90%;
		margin: 0 auto;
	}
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

	</style>
    <script type="text/javascript">
var newwindow;
function poptastic(url)
{
	newwindow=window.open(url,'name','height=640,width=650,left=100,padding=500');
	if (window.focus) {newwindow.focus()}
}
var newwindow;
function elim(url)
{
	newwindow=window.open(url,'name','height=550,width=650,left=400,padding=700');
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
/*
	$('#example tbody tr td').on( 'dblclick', 'tr', function () {
		//$(this).toggleClass('selected');
		alert($('#example tbody td:nth-child(0)'));
		//var children = $(this)[0].innerHTML;
		//alert(children);

	} );
*/
	$('#example tbody').on( 'dblclick', 'tr', function () {
	
		//var children = $(this).find("td:first").innerHTML;
		var name = $('td', this).eq(1).text();
		alert(name);
		$('#tt').tabs('select', 'Registro Ventas');
		//addTab('Registro Ventas','vista/almacen/registro/index.php');
	

	} );

	$('#button').click( function () {
		alert( table.rows('.selected').data().length +' row(s) selected' );
	} );


} );


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
<script src="../../js/funciones_principal.js"></script>
<body class="dt-example" >
	
    
    <div class="container_">
    
		<section>
			<h1>ÓRDENES DE COMPRA<span></span></h1>

			
            <div class="tablas"  align="center" >

			<table id="example"  class="display" cellspacing="0" width="100%">
				<thead>
					<tr class="cabecera" >
						
				    	<th ></th>
                        <th style="width: 200px;">N°Documento</th>
                        <th style="width: 200px;">Proveedor</th>
                        <th style="width: 200px;">Sucursal</th>
                        <th style="width: 200px;">Empresa</th>
                        <th style="width: 150px;">Mes</th>
                        <th style="width: 100px;">Año</th>
					</tr>
				</thead>
				<tbody align="center">
                 <?php
					$tra=new ordcomp_cabecera();
					$reg=$tra->get_ordcomp_cabecera();
					for ($i=0;$i<count($reg);$i++)
					{
				 ?>  
					<tr>    
						<td></td>                  
						<td><?php echo $reg[$i]["var_cod_comp_cab"];?></td>
						<td><?php echo $reg[$i]["var_rsoc_prov"];?></td>
                        <td><?php echo $reg[$i]["var_nom_suc"];?></td>
                        <td><?php echo $reg[$i]["var_nom_emp"];?></td>
                        <td><?php echo nombremes($reg[$i]["mes"]);?></td>
                        <td><?php echo $reg[$i]["año"];?></td>

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