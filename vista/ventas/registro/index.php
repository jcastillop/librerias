<?php
require_once("../../../conexiones/class_sucursal.php");
require_once("../../../conexiones/class_usuario.php");
require_once("../../../conexiones/conexion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>VENTAS</title>
        <script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.j"></script>
        <script type="text/javascript" src="busquedas/js/jquery-1.4.2.js"></script>
        <script language="javascript" type="text/javascript" src="funciones.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
     
 
     
     
        <link href="../../../paquetes/css ventanas/style_ventana.s" rel="stylesheet" type="text/css" />
        <link href="responsive/css/style.css" rel="stylesheet">
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
        
        <script type='text/javascript' src="busquedas/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="busquedas/js/jquery.autocomplete.css" />
        
 <script type="text/javascript">

 function validaCondicion(b_valida)
 {
    document.forms['contact-form'].condiciones.disabled=!b_valida;
    if(!b_valida){
      document.forms['contact-form'].condiciones.value=0;
    }
    else{
      document.forms['contact-form'].condiciones.value='';
    } 

 }

$().ready(function() {
	$("#cliente").autocomplete("busquedas/autoCompleteMain.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#cliente").result(function(event, data, formatted) {
		$("#clienteID").val(data[1]);
		$("#ruc").val(data[2]);
		$("#direccion").val(data[3]);
		$("#distrito").val(data[4]);
	
	});
});



$(document).ready(function () {
 
         var inputs = $(':input').keypress(function (e) {
             if (e.which == 13) {
                 e.preventDefault();
                 var nextInput = inputs.get(inputs.index(this) + 1);
                 if (nextInput) {
                     nextInput.focus();
                 }
             }
         });
 
              });
			  
			  

function Abrir_ventana (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=525, top=15, left=140";
window.open(pagina,"",opciones);
}
function detectar_tecla(){
    with (event){
        if (keyCode==8 ){
			
			document.getElementById("clienteID").value="";
            event.keyCode = 0;
            event.cancelBubble = true;
            
            return false;
        
        }
    }
}
function validar_cliente()
{
	
	var factura = document.getElementById("tipo_doc").value;

	
	
var id_cliente=document.getElementById("clienteID").value ;


if(id_cliente=="")
{
	document.getElementById("ruc").disabled=true;	
var r = confirm("CLIENTE NO EXISTE, DESEA AGREGAR UNO NUEVO!");

if (r == true) {
   Abrir_ventana('cliente_nuevo.php');
   document.getElementById("cliente").value='';
   	document.getElementById("cliente").style.borderColor = "#ff0000";
	document.getElementsByName('cliente')[0].placeholder='Ingrese Correctamente un Cliente ';
	document.getElementById("ruc").disabled=false;

	
} 

 else{
	 if (factura==2)
	 {
		 alert('NO SE PUEDE CREAR UNA FACTURA SIN CLIENTE')
		 document.getElementById("cliente").style.borderColor = "#ff0000";
		 document.getElementById("cliente").value="";
   
	document.getElementsByName('cliente')[0].placeholder='Ingrese Correctamente un Cliente ';
	document.getElementById("ruc").disabled=true;
	 }
	 else
	 {
	document.getElementById("clienteID").value="999";
	document.getElementById("cliente").value="PRUEBA";
   
	document.getElementById("ruc").disabled=false;
	document.getElementById("cliente").style.borderColor = "#0066CC";
	//document.getElementById("cliente").style.borderColor = "#ff0000";
	//document.getElementsByName('cliente')[0].placeholder='Ingrese Correctamente un Cliente ';

	 }

}	
}
else
{
document.getElementById("cliente").style.borderColor = "#FFF";
}
}


       
        </script>
        
        
        
        
          <style type="text/css">
    .label {width:100px;text-align:right;float:left;padding-right:10px;font-weight:bold;}
    #register-form label.error, .output {color:#FF0000;font-weight:bold;}
  </style>

    </head>

    
    
<script>
    function tabular(e,obj) {
        tecla=(document.all) ? e.keyCode : e.which;
        if(tecla!=13) return;
        frm=obj.form;
        for(i=0;i<frm.elements.length;i++) 
            if(frm.elements[i]==obj) { 
            if (i==frm.elements.length-1) i=-1;
            break; 
            }
        frm.elements[i+1].focus();
        return false;
    };

</script> 
    
<body>	
        <div id="wrapper" style="zoom:90%">
            <form  id="contact-form" class="login-form">
    
   
            <div align="center" class="content">
            
               <div id="content" >
            <table class="mi_tabla">
                <tr>
                    <td>Tipo documento: 
                     <input type="hidden" id="clienteID" name="clienteID"/>
                        <select  name="tipo_doc" id="tipo_doc"  style="width:150px" class="menu">
                            <option value="">-Seleccione-</option>
                            <option value="1">Boleta</option>
                            <option value="2">Factura</option>
                        </select>
                        Sucursal procedencia    : 
                        <select  name="sucursal" id="sucursal"  style="width:150px" class="menu" onChange="from(document.form1.sucursal.value,'midiv','prueba.php')">
                            <option value="">-Seleccione-</option>
                            <?php
                                 $tra=new sucursal();
                                 $reg=$tra->get_combo_sucursal();
                                 for ($i=0;$i<count($reg);$i++)
                                 {
                             ?>
                             <option value="<?php echo $reg[$i]["int_cod_suc"];?>"><?php echo $reg[$i]["var_nom_suc"];?></option>
                            <?php
                                 }
                            ?>
                        </select>
                        Fecha:
                        <input name ="fecha_registro" type="text" id="datepicker" class="fecha"  />
                        Condicion:
                        <label name="lbl_ventas" id="lbl_ventas"><input name="ventas" type="checkbox" onclick="javascript:validaCondicion(this.checked)" id="ventas"/>Venta a Plazo</label>
                        <input name="condiciones" class="condiciones" disabled type="text" id="condiciones">   
                    </td>

                </tr>
                <tr>
             
                    <td>Cliente:
                    <input name="cliente" class="cliente"  type="text" id="cliente"  onKeyDown ="detectar_tecla (event)"  />
                   
                    R.U.C:
                    <input name="ruc" class="input username" style="width:200px" type="text"  id="ruc"  onFocus="validar_cliente()" /></td>
                </tr>
                <tr>
                    <td>Direccion:
                      <input name="direccion" class="input username"  type="text" id="direccion"  />
                    Distrito:
                    <input name="distrito" class="input username"  type="text" id="distrito" ></input>
                     
                    Vendedor:
                    <select  name="vendedor" id="vendedor"   class="menu">
                      <option value="">-Seleccione-</option>
                      <?php
                                 $tra=new usuario();
                                 $reg=$tra->get_combo_usuario();
                                 for ($i=0;$i<count($reg);$i++)
                                 {
                             ?>
                      <option value="<?php echo $reg[$i]["int_cod_usu"];?>"><?php echo $reg[$i]["nombre"];?></option>
                      <?php
                                 }
                            ?>
                    </select></td>                                         
                </tr>
                 
              </table>
            <br />
             </div>
            
      
 
             <div id="frm_usu" style="width: 1080px; margin-left: 10px; border-radius: 10px;border: 2px solid #B1B1B1;">
                <table border="0" align="center">

                    <tbody>
                        <tr>
                            <td>Codigo</td>
                            <td><input name="valor_ide"  style="width:100px" type="text" id="valor_ide" size="10" onkeypress="return tabular(event,this)"/></td>
       
                            <td>Descripcion</td>
                            <td><input name="valor_uno" style="width:382px" type="text" id="valor_uno" size="50" class='input username'/></td>
                   
                            <td>Precio</td>
                            <td><input name="valor_dos" style="width:100px" type="text"  id="valor_dos" size="10"  class='input username'/>
                                <input type="hidden" id="tituloID" name="tituloID"></input>
                            </td>
                                
                            <td>Cantidad</td>
                            <td><input name="valor_tres" class="input username" style="width:100px" type="text" id="valor_tres" size="10" onkeypress="return tabular(event,this)"/></td>
                        </tr>
                       
                    </tbody>
                    <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
            	
			<div align="center" style="height:250px;overflow:scroll;">
            <table id="grilla" class="lista" border="0" align="center">
              <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descuento</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

 
                </tbody>
                <tfoot>
                	<tr>
                    	<td colspan="3"><strong>Cantidad:</strong> <span id="span_cantidad">0</span> productos.</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                	<tr>
                	  <td colspan="5" align="center"><input id="submit" name="Submit" class="enviar" value="GUARDAR DATOS" type="submit" /></td>
               	  </tr>
                </tfoot>
            </table>
            </div>
            </div>
</form> 

        
    
        </div>


    
        </div>
<script src="responsive/js/scripts.js"></script>
     
    </body>
</html>
