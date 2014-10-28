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
			$table = "";

			for($v=$start_v+1; $v<=$end_v; $v++){
				//empieza lectura horizontal
				$table .= "<tr>";
				for($h=$start_h; ord($h)<=ord($end_h); pp($h)){
					$cellValue = get_cell($h.$v, $objPHPExcel);
					$table .= "<td><input style='width:70px' type='text' name='".$v.$h."' value='";
					if($cellValue !== null){
						$table .= $cellValue;
					}
					$table .= "'/></td>";
				}
				$table .= "<td><a class='elimina'><img src='delete.png' /></a></td></tr>";
			}
			

			
			echo $table;		
		}
?>		