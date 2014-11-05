
<?php

require_once("../../../conexiones/class_guia_pdf.php");





require("fpdf/fpdf.php");




$dssss;
class PDF extends FPDF
{
var $B;
var $I;
var $U;
var $HREF;

function PDF($orientation='P', $unit='mm', $size='A4')
{
    // Llama al constructor de la clase padre
    $this->FPDF($orientation,$unit,$size);
    // Iniciación de variables
    $this->B = 0;
    $this->I = 0;
    $this->U = 0;
    $this->HREF = '';
}

function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
   
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
}


$tra=new guia_cabecera();

$reg=$tra->get_guia_por_id($_GET['id']);


	


$html = 'prueba';

$pdf = new PDF();
// Primera página
$pdf->AddPage();
$pdf->SetFont('Arial','',8);

$link = $pdf->AddLink();



    // Logo
    
    // Arial bold 15
    $pdf->SetFont('Arial','',10);
	//$pdf->SetMargins(10,20,20);
    // Movernos a la derecha
    //$pdf->Cell(140);
    // Título
   // $this->Cell(50,10,'R.U.C. Nº 20100488699',1,0,'C');
	//$pdf->Cell(50,10, iconv('UTF-8', 'ISO-8859-2', '     R.U.C. N° 20100488699'),1);
	//$pdf->Image('img/chart.png',30,10,20,20,'PNG');
	
	//$pdf->Ln();
	//$pdf->Cell(140);
	//$pdf->Cell(50,18,'GUIA DE REMISION',1,0,'C');
	//$this->Image('logo.jpg' , 80 ,22, 35 , 38,'JPG', 'http://www.desarrolloweb.com');
  
    // Salto de línea
    //$pdf->Ln(20);










/**********                 **********/	
	
$pdf->SetXY(160, 30);
	$pdf->Cell(10, 8,	$reg[0]["var_cod_ser"], 0, 'C');
	//$pdf->SetXY(165, 30);
	//$pdf->Cell(10, 8,	'-', 0, 'C');
	$pdf->SetXY(168, 30);
	$pdf->Cell(10, 8,	$reg[0]["var_cod_guia_cab"], 0, 'C');


	//$pdf->SetXY(5, 40);
	//$pdf->Cell(10, 8, 'Suc.Procedencia: ', 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(37, 40);
	$pdf->Cell(10, 8,	$reg[0]["var_nom_suc"], 0, 'C');
	
	
	
	
	
	//$pdf->SetFontSize(10);
	//$pdf->SetXY(125, 40);
	//$pdf->Cell(10, 8, utf8_decode('Fecha Translado:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(155, 40);
	$pdf->Cell(10, 8,$reg[0]["date_fecenv_guia_cab"], 0, 'C');
	

	
	
/**********                 **********/	
/**********                 **********/	
	//$pdf->SetXY(5, 47);
	//$pdf->Cell(10, 8, 'Suc.Envio: ', 0, 'C');
	
	//$pdf->SetFontSize(9);
	$pdf->SetXY(22, 47);
	$pdf->Cell(10, 8,$reg[0]["var_rsoc_cli"], 0, 'C');
	


	//$pdf->SetXY(140, 47);
	//$pdf->Cell(10, 8, utf8_decode('RUC:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(150, 47);
	$pdf->Cell(10, 8,$reg[0]["var_ruc_cli"], 0, 'C');


	
	
/**********                 **********/	

/**********                 **********/	
	//$pdf->SetXY(5, 54);
	//$pdf->Cell(10, 8, 'Direccion: ', 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(22, 54);
	$pdf->Cell(10, 8,$reg[0]["var_dir_cli"], 0, 'C');	
	
	
	
/**********                 **********/	

/**********                 **********/	
	//$pdf->SetXY(5, 60);
	//$pdf->Cell(10, 8, 'Vendedor:', 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(22, 60);
	$pdf->Cell(10, 8,$reg[0]["var_nom_usu"], 0, 'C');	

	//$pdf->SetXY(45, 60);
	//$pdf->Cell(10, 8,'', 0, 'L');

	//$pdf->SetXY(70, 60);
	//$pdf->Cell(10, 8, utf8_decode('Condicion:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(92, 60);
	$pdf->Cell(10, 8,$reg[0]["var_desc_mov"], 0, 'C');	
	

	
/**********                 **********/	


/**********                 **********/	
	/*$pdf->SetXY(5, 67);
	$pdf->Cell(10, 8, 'Centro de Trabajo:', 0, 'C');
	$pdf->SetFontSize(9);
	$pdf->SetXY(170, 60);
	$pdf->Cell(10, 8,$reg[0]["var_telf_guia_cab"], 0, 'C');	*/

	//$pdf->SetXY(5, 67);
	//$pdf->Cell(10, 8, utf8_decode('Pto.Partida:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(25, 67);
	$pdf->Cell(10, 8,$reg[0]["var_pun_part_guia_cab"], 0, 'C');
	
	//$pdf->SetXY(110, 67);
	//$pdf->Cell(10, 8,'', 0, 'L');

	//$pdf->SetXY(110, 67);
	//$pdf->Cell(10, 8, utf8_decode('Pto.Llegada:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(132, 67);
	$pdf->Cell(10, 8,$reg[0]["var_pun_lleg_guia_cab"], 0, 'C');	
	
	

	//$pdf->SetXY(180, 67);
	//$pdf->Cell(10, 8,'', 0, 'C');
	
	
/**********                 **********/

/**********                 **********/	
	//$pdf->SetXY(5, 75);
	//$pdf->Cell(10, 8, 'Marca/Placa:', 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(25, 75);
	$pdf->Cell(10, 8,$reg[0]["var_tran_marca_guia_cab"], 0, 'C');	
	

	//$pdf->SetXY(60, 75);
	//$pdf->Cell(10, 8, utf8_decode('Const Inscrip:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(82, 75);
	$pdf->Cell(10, 8,$reg[0]["var_tran_constancia_guia_cab"], 0, 'C');


	//$pdf->SetXY(125, 75);
	//$pdf->Cell(10, 8, utf8_decode('Licencia conducir:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(145, 75);
	$pdf->Cell(10, 8,$reg[0]["var_tran_licencia_guia_cab"], 0, 'C');

	//$pdf->SetXY(5, 82);
	//$pdf->Cell(10, 8, utf8_decode('Razon Social Transp.:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(28, 82);
	$pdf->Cell(10, 8,$reg[0]["var_trans_rs_guia_cab"], 0, 'C');
	
	//$pdf->SetXY(70, 82);
	//$pdf->Cell(10, 8, utf8_decode('RUC Transp.:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(92, 82);
	$pdf->Cell(10, 8,$reg[0]["var_trans_ruc_guia_cab"], 0, 'C');
	
	//$pdf->SetXY(140, 82);
	//$pdf->Cell(10, 8, utf8_decode('Direccion Transp.:'), 0, 'C');
	//$pdf->SetFontSize(9);
	$pdf->SetXY(150, 82);
	$pdf->Cell(10, 8,$reg[0]["var_trans_dir_guia_cab"], 0, 'C');
	



$pdf->Ln(10);
	
	                    
						//$pdf->SetFillColor(150,50,150);
                        //$pdf->SetDrawColor(0,0,0);
                        //$pdf->SetTextColor(0,0,0);
						//$pdf->SetFontSize(10);
						
						
						//$pdf->Cell(25, 5,'CODIGO', 1,0, 'C');
					
						//$pdf->Cell(25, 5,'CANTIDAD', 1,0, 'C');
						//$pdf->Cell(85, 5,'DESCRIPCION', 1,0, 'C');
						
						//$pdf->Cell(25, 5,'P. UNITARIO', 1,0, 'C');
						//$pdf->Cell(25, 5,'P. TOTAL', 1,1, 'C');
						
						
	
					$tra= new guia_cabecera();
					$reg=$tra->get_guia_detalle_por_id($_GET['id']);
					for ($i=0;$i<count($reg);$i++)
					{
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFontSize(8);
						
						$pdf->Cell(25, 5,$reg[$i]["int_cod_tit"], 0,0, 'C');
						$pdf->Cell(25, 5,$reg[$i]["int_cant_guia_det"], 0,0, 'C');
						$pdf->Cell(85, 5,$reg[$i]["var_nom_tit"], 0,0, 'C');
						$pdf->Cell(25, 5,$reg[$i]["dec_pvent_guia_det"], 0,0, 'C');
						
						$pdf->Cell(25, 5,$reg[$i]["dec_vtotal_guia_det"], 0,1, 'C');
					}


     

$pdf->Output();
?>
