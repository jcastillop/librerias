<script> 
function cerrarse(){ 
window.close() 
} 
</script> 



<?php
@session_start();
 $user=$_SESSION['usuario'];
 $fecha_actual= date("Y-m-d");
require_once("../../../conexiones/class_tipocambio.php");
require_once("../../../conexiones/class_monedas.php");
require_once("../../../conexiones/conexion.php");
?>
  


<?php

$tra=new tipocambio();

if (isset($_GET["grabar"]) and $_GET["grabar"]=="si")
{
	 
    $tra->edit_tipocambio($_GET['id'],$_GET["var_fec_Tc"],$_GET["dec_val_tc"],$_GET["var_desc_tc"],$user
	);
	exit;
}


$reg=$tra->get_tipocambio_por_id($_GET["id"] , $_GET["fecha"]);
    $id=$reg[0]["int_cod_mon"];
		$fecha=$reg[0]["date_fecha_tipcam"];
    $var_nom_mon=$reg[0]["var_nom_mon"];
		$dec_val_tc=$reg[0]["dec_val_tipcam"];
		$var_desc_tc=$reg[0]["var_desc_tipcam"];
		?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<head>

<!--------------------
LOGIN FORM
by: Amit Jakhu
www.amitjakhu.com
--------------------->

<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TIPO DE CAMBIO</title>

<!--STYLESHEETS-->
<link href="../../../paquetes/css ventanas/style_ventana.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
 <script type="text/javascript" src="js/validar.js"></script>
  <script type="text/javascript" src="../../../paquetes/js/validar.js"></script>

<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
function obtiene_http_request()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = obtiene_http_request();



function from(id,ide,url){
		var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la p�gina en el cach�...
		var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
		//alert(vinculo);
		miPeticion.open("GET",vinculo,true);//ponemos true para que la petici�n sea asincr�nica
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }/*else
               {
			document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";

                }*/
       }
       miPeticion.send(null);

}
function validar(e) { // 1

    tecla = (document.all) ? e.keyCode : e.which; // 2

    if (tecla==8) return true; // 3

    patron =/[A-Za-z\s]/; // 4

    te = String.fromCharCode(tecla); // 5

    return patron.test(te); // 6

}
 
</script>

</head>
<body <?php if (isset($_GET['load'])){ echo "onload='cerrar();'";  } ?>   >

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon_"></div>
    <div class="pass-icon_"></div>
    <!--END SLIDE-IN ICONS-->
    <br />
    <br />

<!--LOGIN FORM-->
<form name="form1" class="login-form" action="mod_tipocambio.php" method="get">

	<!--HEADER-->
    <div class="header">
    <!--TITLE-->
    <h1 align="center">TIPO DE CAMBIO</h1>
    
    <!--END TITLE-->
  
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
      <table width="80%" border="1">
      	<tr>
          <td height="20">Moneda: </td>
          <td><select name="int_cod_mon" id="int_cod_mon" type="text" maxlength="10" style="width: 400px;" class="input username" onKeyPress="return tab(event,this)" />
            <option value="<?php echo $id ;?>" selected><?php echo $var_nom_mon;?></option>
			    <?php
          $tra=new monedas();
          $reg=$tra->get_combo_monedas();
          for ($i=0;$i<count($reg);$i++)
          {
          ?>
            <option value="<?php echo $reg[$i]["int_cod_mon"];?>"><?php echo $reg[$i]["var_nom_mon"];?></option>
              
          <?php
          }
          ?>
           
			     </select>
			   </td>
      </tr>
      <tr>
          <td height="20">Fecha: </td>
          <td><input type="text" class="input username" style="width: 160px;"   name="var_fec_Tc" id="date_fec_tc" value="<?php echo $fecha; ?>"/></td>
		  </tr>
		 <tr>
          <td height="20">Valor: </td>
          <td><input type="text" class="input username" style="width: 160px;"   name="dec_val_tc" id="dec_val_tc" value="<?php echo $dec_val_tc; ?>"/></td>
		</tr>
		<tr>
          <td height="20">descripción: </td>
          <td><input type="text" class="input username" style="width: 160px;"   name="var_desc_tc" id="var_desc_tc" value="<?php echo $var_desc_tc; ?>" /></td>
		</tr>
      </table>
    </div>
    <!--END CONTENT-->
    <!--FOOTER-->
    <div class="footer" >
    <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
    <input type="hidden" name="fecha" value="<?php echo $_GET["fecha"]?>">
    <input type="hidden" name="grabar" value="si" />
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="GUARDAR" class="button" /><!--END LOGIN BUTTON-->
    <!--REGISTER BUTTON--><input type="button" name="submit" value="CANCELAR" class="register"onClick="cerrarse()" /><!--END REGISTER BUTTON-->
    <input type="hidden" id="val1" value="" disabled="disabled"/> 
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><!--END GRADIENT-->

</body>
</html>




