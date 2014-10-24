<?php
require_once("../../conexiones/class_sucursal.php");
require_once("../../conexiones/conexion.php");
require_once("../../conexiones/class_usuario.php");
require_once("../../conexiones/class_cliente.php");

?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>jQuery - agregar y eliminar filas en una tabla</title>
        <script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    
        <script language="javascript" type="text/javascript" src="funciones.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="../../paquetes/css ventanas/style_ventana.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
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
            <form  id="form" class="login-form" style="margin: 1px auto;" >
    
            <h1 align="center">REGISTRO DE COMPRAS</h1>
            <div class="content">
            
            <div  style="width: 1095px; margin-left: 10px; border-radius: 10px; border: 2px solid #B1B1B1;">
			DATOS<BR>
            <table>
                <tr>
                    <td>
                        RUC: <input name="ruc" class="input username" style="width:300px" type="text" id="ruc"/>&nbsp;&nbsp;Cod. Proveedor: <input name="id_prov" class="input username" style="width:20px" type="text" id="id_prov"/> 
                        <input name="prov" class="input username" style="width:250px" type="text" id="prov"/></td>
                    <td> <input class="button" style="width:80px" type="button" value="CARGAR"/></td>  

                </tr>
                <tr>
                    <td>  Fecha de recepción:
                        <input name ="fecha_recepcion" type="text" id="datepicker" class="input username" style="width:210px" />&nbsp;&nbsp;
                       
						Fecha de emición:
                        <input name ="fecha_emicion" type="text" id="datepicker" class="input username" style="width:265px" /></td> 
                </tr>
                <tr>
                    <td>                    
                    Cod. Orden de Compra:<input name="punto_partida" class="input username" style="width:190px" type="text" id="punto_partida" >&nbsp;&nbsp;
                   Fecha de caducidad:
                        <input name ="fecha_caducidad" type="text" id="datepicker" class="input username" style="width:250px" /></td> 
                </tr> 
<tr>
                    <td>                    
                    Tipo de cambio:
                     <select  name="cambio" id="cambio"  style="width:100px" class="input username" >
                            <option value="">-Seleccione-</option></select>&nbsp;&nbsp;<input name="tip_c" class="input username" style="width:130px" type="text" id="tip_c" >&nbsp;&nbsp;
                   Descripciòn:
                        <input name ="descripcion" type="text" id="descripcion" class="input username" style="width:300px" /></td> 
                </tr> 				
            </table>
            </div>
            <br />
             <div id="frm_usu" style="width: 1080px; margin-left: 10px; border-radius: 10px;border: 2px solid #B1B1B1;">
			DETALLE<br>
                <table border="0" align="center">

                    <tbody>
                        <tr>
                            <td>Código</td>
                            <td><input name="valor_ide" class="input username" style="width:100px" type="text" id="valor_ide" size="10" onkeypress="return tabular(event,this)"/></td>
       
                            <td>Descripción</td>
                            <td><input name="valor_uno" class="input username"style="width:382px" type="text" id="valor_uno" size="50" class="required"/></td>
                   
                            <td>Precio</td>
                            <td><input name="valor_dos" class="input username" style="width:100px" type="text" id="valor_dos" size="10" class="required"/>
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
            <table id="grilla" class="lista" border="1" align="center">
              <thead>
                    <tr>
                        <th style="width:50px;">Item</th>
                        <th style="width:150px;">Título</th>
                        <th style="width:50px;">Cantidad</th>
                        <th style="width:100px;">Precio Uni.</th>
                       <th style="width:50px;">Desc</th>
                        <th style="width:100px;">Valor Imp.</th>
                        <th style="width:100px;">Total</th>
                        <th style="width:50px;">Editar</th>
                        <th style="width:50px;">Eliminar</th>
                    </tr>
                </thead>
                <tbody>

 
                </tbody>
                <tfoot>
                	<tr>
                    	<td colspan="3"><strong>Cantidad:</strong> <span id="span_cantidad">0</span> productos.</td>
                        <td colspan="2"><strong>Acción:</strong> <input id="submit" name="Submit" class="button" value="Enviar" type="submit"></td>
                    </tr>
                </tfoot>
            </table>
            </div>
            </div>
</form> 

        
    
        </div>

     
    </body>
</html>
