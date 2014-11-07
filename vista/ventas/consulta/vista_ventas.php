
<?php
require_once("../../../conexiones/class_historico_ventas.php");
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
			<h1>VENTAS<span></span></h1>

			
            <div class="tablas"  align="center" >

			<table id="example"  class="display" cellspacing="0" width="100%">
				<thead>
					<tr class="cabecera" >
						
						
                        <th >#</th>
                        <th >N°Documento</th>
                        <th >T.Documento</th>
                        <th >Suc. Procedencia</th>
                        <th >Cliente</th>
                        <th >Vendedor</th>
                        <th >Fecha Fact.</th>
                        <th>Estado</th>
                        <th >Días de Pago.</th>
					</tr>
				</thead>
				<tbody align="center">
                 <?php
					$tra=new factura_cabecera();
					$reg=$tra->get_factura_cabecera();
					for ($i=0;$i<count($reg);$i++)
				{ if ($reg[$i]["int_tipven_fact_cab"]==2){
				 ?>  
					<tr style="border:2px solid red;">   
                    	<td style="color:red"><?php echo $reg[$i]["id"];?></td>              
						<td style="color:red"><?php echo '00'.$reg[$i]["var_cod_ser"]."-".$reg[$i]["var_cod_fact_cab"];?></td> 
                        <td style="color:red"><?php echo $reg[$i]["int_tip_doc_fact"];?></td>
                        <td style="color:red"><?php echo $reg[$i]["var_nom_suc"];?></td>
						<td style="color:red"><?php echo $reg[$i]["var_rsoc_cli"];?></td>
						<td style="color:red"><?php echo $reg[$i]["var_nom_usu"];?></td>
                        <td style="color:red"><?php echo $reg[$i]["date_fecenv_fact_cab"];?></td>
						<td style="color:red">Pendiente</td>
                        <td style="color:red"><?php echo $reg[$i]["int_dias_fact_cab"];?></td>

					</tr>
				
  <?php
} else {
?>     
<tr>    
                    	<td><?php echo $reg[$i]["id"];?></td>              
						<td><?php echo '00'.$reg[$i]["var_cod_ser"]."-".$reg[$i]["var_cod_fact_cab"];?></td> 
                        <td><?php echo $reg[$i]["int_tip_doc_fact"];?></td>
                        <td><?php echo $reg[$i]["var_nom_suc"];?></td>
						<td><?php echo $reg[$i]["var_rsoc_cli"];?></td>
						<td><?php echo $reg[$i]["var_nom_usu"];?></td>
                        <td><?php echo $reg[$i]["date_fecenv_fact_cab"];?></td>
						<td >Pagado</td>
                        <td><?php echo $reg[$i]["int_dias_fact_cab"];?></td>

					</tr>   
					
					 <?php
} }
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
