<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>jQuery Easy - Importar Excel</title>
<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script language="javascript" type="text/javascript" src="funciones.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
</head>
<body>
<div id="header">

</div>

<div id="demos">
    <h3>Seleccionar archivo Excel</h3>
    <form name="frmload" method="post" action="index.php" enctype="multipart/form-data">
        <input type="file" name="file" /> &nbsp; &nbsp; &nbsp; <input type="submit" value="----- IMPORTAR -----" />
    
    <div id="show_excel">
    	<?php 
		
		if($_FILES['file']['name'] != '')
		{
			
			require_once 'reader/Classes/PHPExcel/IOFactory.php';

			//Funciones extras
			
			function get_cell($cell, $objPHPExcel){
				//select one cell
				$objCell = ($objPHPExcel->getActiveSheet()->getCell($cell));
				//get cell value
				return $objCell->getvalue();
			}
			
			function pp(&$var){
				$var = chr(ord($var)+1);
				return true;
			}
	
			$name	  = $_FILES['file']['name'];
			$tname 	  = $_FILES['file']['tmp_name'];
			$type 	  = $_FILES['file']['type'];
				
			if($type == 'application/vnd.ms-excel')
			{
				// Extension excel 97
				$ext = 'xls';
			}
			else if($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
			{
				// Extension excel 2007 y 2010
				$ext = 'xlsx';
			}else{
				// Extension no valida
				echo -1;
				exit();
			}
		
			$xlsx = 'Excel2007';
			$xls  = 'Excel5';
	
			//creando el lector
			$objReader = PHPExcel_IOFactory::createReader($$ext);
			
			//cargamos el archivo
			$objPHPExcel = $objReader->load($tname);
		
			$dim = $objPHPExcel->getActiveSheet()->calculateWorksheetDimension();
		
			// list coloca en array $start y $end
			list($start, $end) = explode(':', $dim);
				
			if(!preg_match('#([A-Z]+)([0-9]+)#', $start, $rslt)){
				return false;
			}
			list($start, $start_h, $start_v) = $rslt;
			if(!preg_match('#([A-Z]+)([0-9]+)#', $end, $rslt)){
				return false;
			}
			list($end, $end_h, $end_v) = $rslt;
		
			//empieza  lectura vertical
			$table = "<table  id='grilla' border='1'>";
			for($v=$start_v; $v<=$end_v; $v++){
				//empieza lectura horizontal
				$table .= "<tr>";
				for($h=$start_h; ord($h)<=ord($end_h); pp($h)){
					$cellValue = get_cell($h.$v, $objPHPExcel);
					$table .= "<td><input type='text' name='".$v.$h."' value='";
					if($cellValue !== null){
						$table .= $cellValue;
					}
					$table .= "'/></td>";
				}
				$table .= "</tr>";
			}
			$table .= "</table>";
			
			echo $table;		
		}
		?>
    </div>

    </form>
    <input type="button" value="Registrar información" id="btn_enviar" name="btn_enviar"/>
</div>
	
</body>
</html>
