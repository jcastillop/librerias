<?php
require_once("../../../conexiones/class_monedas.php");
require_once("../../../conexiones/conexion.php");
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<head>
  <p id="deHijo"></p>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>MONEDAS</title>
	<link rel="stylesheet" type="text/css" href="../../../paquetes/media/css/jquery.dataTables.css">
    	<link rel="stylesheet" type="text/css" href="../../../paquetes/media/css/dataTables.tableTools.css">
        

	<link rel="stylesheet" type="text/css" href="../../../paquetes/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="../../../paquetes/resources/demo.css">
    
    
    
	

    <script type="text/javascript">
var newwindow;
function poptastic(url)
{
	newwindow=window.open(url,'name','height=425,width=580,left=400');
	if (window.focus) {newwindow.focus()}
}
var newwindow;
function elim(url)
{
	newwindow=window.open(url,'name','height=200,width=420,left=400,padding=700');
	if (window.focus) {newwindow.focus()}
}
</script>
	<script type="text/javascript" language="javascript" src="../../../paquetes/media/js/jquery.js"></script>
    
	<script type="text/javascript" language="javascript" src="../../../paquetes/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="../../../paquetes/media/js/dataTables.tableTools.js"></script>
    <script type="text/javascript" language="javascript" src="../../../paquetes/media/js/js/TableTools.js"></script>
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
	
	
	
	
	
	
	
	/*$(document).ready(function() {
	
	
		
		
		
		
	// Setup - add a text input to each footer cell
	$('#example  tfoot th').each( function () {
		var title = $('#example thead th').eq( $(this).index() ).text();
		$(this).html( '<input type="text" class="buscar" placeholder="Buscar '+title+'" />' );
	} );

	// DataTable
	var table = $('#example').DataTable();

	// Apply the search
	table.columns().eq( 0 ).each( function ( colIdx ) {
		$( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
			table
				.column( colIdx )
				.search( this.value )
				.draw();
		} );
	} );
} );

	
	
*/



$(document).ready(function() {
	
	
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
			<h1>MONEDAS<span></span></h1>

			
            <div class="tablas"  align="center">

			<table id="example"  class="display" cellspacing="0" width="100%">
				<thead>
					<tr class="cabecera" >
						
						<th><a href="javascript:poptastic('monedas.php');"><img src="../../../css/images/list-add.png" width="98" height="30" /></a></th>
						<th>Nombre de Moneda</th>
			                        <th>Descripcion</th>
			                        <th>Estado</th>
						<th></th>
				
					</tr>
				</thead>                   

		<tbody align="center">		
                <?php
$tra=new monedas();
$reg=$tra->get_monedas();
for ($i=0;$i<count($reg);$i++)
{
?> 


					<tr>
                  <td align='center' ><a href=" javascript:poptastic('mod_monedas.php?id=<?php echo $reg[$i]["int_cod_mon"];?>'); " ><img src='../../../img/images/edit.png' width='15px' height='15px' title='Actualizar'></a></td>
                      
						<td><?php echo $reg[$i]["var_nom_mon"];?></td>
                        			<td><?php echo $reg[$i]["var_desc_mon"];?></td>
						  			<td><?php echo $reg[$i]["int_est_mon"];?></td>
						
		
                       <td align='center' ><a href=" javascript:elim('eliminar_monedas.php?id=<?php echo $reg[$i]["int_cod_mon"];?>'); " ><img src='../../../img/images/delete.png' width='15px' height='15px' title='Eliminar'></a></td>

						
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
