<script> 
function cerrarse(){ 
window.close() 
} 
</script> 
<?php
require_once("../../../conexiones/class_cliente.php");
require_once("../../../conexiones/class_pais.php");
require_once("../../../conexiones/conexion.php");
?>
  




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<!--------------------
LOGIN FORM
by: Amit Jakhu
www.amitjakhu.com
--------------------->

<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>


<title>CLIENTE</title>

<!--STYLESHEETS-->
<link href="../../../paquetes/css ventanas/style_ventana.css" rel="stylesheet" type="text/css" />

<!--SCRIPTS-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
 <script type="text/javascript" src="js/validar.js"></script>
 <script type="text/javascript" src="../../paquetes/js/validar.js"></script>

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

function formulario(f) {
	if (f.tip_per.value   == '--Seleccione--') 
    { 
      alert ('El campo Tipo de Persona esta vacío, ingrese un dato porfavor!!');  
	   f.tip_per.focus(); return false; 
   }  
	if (f.rsoc.value   == '') { alert ('El campo Razon Social esta vacío, ingrese un dato porfavor!!');  
	f.rsoc.focus(); return false; }  
  if (f.ruc.value  != '' && f.ruc.value.length < 11) { alert ('El campo RUC tiene menos de 11 Digitos, Complete los digitos porfavor!!');
  f.ruc.focus(); return false; }
	
	

	
	

	
	
	

	if (f.distrito.value   == '') { alert ('El campo Distrito esta vacío, ingrese un dato porfavor!!');  
	f.distrito.focus(); return false; }
	if (f.telefono.value   == '') { alert ('El campo Teléfono esta vacío, ingrese un dato porfavor!!');  
	f.telefono.focus(); return false; }
  if (f.dni.value!='' && f.dni.value.length < 8) { alert ('El campo DNI tiene menos de 8 Digitos, Complete los digitos porfavor!!');
  f.ruc.focus(); return false; }
	
 return true; } 
  
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
<form name="form1" class="login-form" id="formulario" action="ingresar_cliente.php" method="post" onSubmit="return formulario(this)">

	<!--HEADER-->
    <div class="header">
    <!--TITLE-->
    <h1 align="center">CLIENTE</h1>
    
    <!--END TITLE-->
  
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
      <table width="70%" border="1">
        <tr>
          <td height="20">Tipo de Persona: </td>
          <td><select name="tip_per" class="input username" style="width: 160px;" id="tip_per" onKeyPress="return tab(event,this)">
                <option>--Seleccione--</option>
                <option value="1">Persona Natural</option>
                <option value="2">Persona Juridica</option>
              </select></td>
               </tr>
        <tr>
        <td>Razon Social: </td>
          <td><input name="rsoc" type="text" maxlength="50" class="input username" style="width: 400px;" id="rsoc"  onKeyPress="return tab(event,this)" /></td>
        </tr>
        <tr>
        <td><input name="estado" id="estado" type="hidden" value="1" class="input username" />
        	RUC: </td>
            <td>
          	<input name="ruc" type="text" maxlength="11" class="input username" style="width: 180px;" id="ruc" onkeyUp="return ValNumero(this);" /></td> 	
         </tr>
        <tr>
         <td>País: </td>
          <td>
          <select  name="pais" id="pais" class="input username" style="width: 160px;" onChange="from(document.form1.pais.value,'midiv','cliente_dep.php')">
          <option value="999">--Seleccione--</option>
          <?php
			$tra=new pais();
			$reg=$tra->get_combo_pais();
			for ($i=0;$i<count($reg);$i++)
			{
			?>
			   <option value="<?php echo $reg[$i]["int_cod_pais"];?>"><?php echo $reg[$i]["var_nom_pais"];?></option>
			
			
			<?php
			}
		  ?>
            </select>
             </td>	
              </tr>
        <tr>	  
       <td>Departamento:</td>
          <td>
          <div id='midiv'><select style="width: 200px;" class="input username">
          <option value="99999">--Seleccione--</option>
         </select></div>
          </td>
           </tr>
        <tr>
        <td>Provincia: </td>
          <td>
          <div id="madiv"><select style="width: 200px;" class="input username">
          <option value="999">--Seleccione--</option>
          </select></div>
          </td>		
           </tr>
        <tr>  
         <td>Distrito: </td>
         <td><input name="distrito" type="text" maxlength="50" style="width: 300px;" class="input username" id="distrito"  onKeyPress="return validar(event)"/></td>
            </tr>
        <tr>
		 <td>Direccion: </td>
		 <td><input name="direccion" type="text" maxlength="50" style="width: 400px;" class="input username" id="direccion"  onKeyPress="return tab(event,this)" /></td>
		</tr>
        <tr>
          <td>Ref.Dom: </td>
		  <td><input name="refdom" type="text" maxlength="70" style="width: 400px;" class="input username" id="refdom" onkeyUp="return tab(event,this)" /></td>	
		</tr>
        <tr>
          <td>DNI: </td>
		   <td><input name="dni" type="text" maxlength="8" style="width: 150px;" class="input username" id="dni" onkeyUp="return ValNumero(this);" /></td>	
		 </tr>
        <tr>
        <td>Telefono: </td>
		 <td><input name="telefono" type="text" maxlength="15" style="width: 150px;" class="input username" id="telefono" onkeyUp="return ValNumero(this);" />
         Fax:<input name="fax" type="text" maxlength="15" style="width: 160px;" class="input username" id="fax" onkeyUp="return ValNumero(this);" /></td>
		 </tr>
        <tr>
         <td>Correo: </td>
		   <td><input name="correo" type="text" maxlength="50" style="width: 400px;" class="input username" id="correo" onKeyPress="return tab(event,this)" /></td>
		
		</tr>
      </table>
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer" >
    <!--LOGIN BUTTON--><input type="submit" name="submit" id="submit" value="GUARDAR" class="button" /><!--END LOGIN BUTTON-->
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

