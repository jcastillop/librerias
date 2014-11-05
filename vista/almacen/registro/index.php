<?php
require_once("../../../conexiones/class_sucursal.php");
require_once("../../../conexiones/conexion.php");
require_once("../../../conexiones/class_usuario.php");
require_once("../../../conexiones/class_cliente.php");

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
        <link href="../../../paquetes/responsive/css/style.css" rel="stylesheet">
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>



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

       <style type="text/css">
  label, input, select {
     display: block;
     width: 150px;
     float: left;
     margin-bottom: 10px;
     position: relative;
}
        label {
              text-align: right; width: 75px; padding-right: 20px;
            
           }     
           br {
              clear: left;
           }
           div.container {
  border: 2px dashed #333;
  background-color: #ffe;
  }
  </style>
    
    <body>	
            
            <form  id="form">
    <div class="container">
        asd
            <h1 align="center">Guía Remisíon</h1>
            <br>
            <label for="lblsucursal_procedencia">Sucursal procedencia:</label>
            <select  name="sucursal" id="sucursal"  style="width:150px" class="menu">
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
            <label for="lblsucursal_envio">Sucursal envio:</label>
              
                <select  name="cliente" id="cliente"  style="width:150px" class="menu">
                    <option value="">-Seleccione-</option>
                        <?php
                            $tra=new cliente();
                            $reg=$tra->get_combo_cliente();
                               for ($i=0;$i<count($reg);$i++)
                                 {
                            ?>
                            <option value="<?php echo $reg[$i]["int_cod_cli"];?>"><?php echo $reg[$i]["var_rsoc_cli"];?></option>
                            <?php
                                 }
                            ?>
                        </select>
            <label for="lblcondicion">Condición:</label>
            <input name="condiciones" class="condiciones" style="width:120px"type="text" id="condiciones" value="Transacción"  OnFocus="this.blur()"/>
            <label for="lblfecha">Fecha traslado:</label>
            <input name ="fecha_registro" type="text" id="datepicker" class="input username" style="width:150px" />
            <label for="lblvendedor">Vendedor:</label>
            <select  name="vendedor" id="vendedor"  style="width:200px" class="menu">
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
            </select>
		    <label for="lblruc">R.U.C:</label>
            <input name="ruc" class="input username" style="width:200px" type="text" id="ruc" onkeypress="" />
            <label for="lbldireccion">Dirección alternativa:</label>
            <input name="direccion_compra" class="input username" style="width:500px" type="text" id="direccion_compra"/>
            <label for="lblpartida">Punto de partida:</label>
            <input name="punto_partida" class="input username" style="width:300px" type="text" id="punto_partida" >
            <label for="lblllegada">Punto de llegada:</label>
            <input name="punto_llegada" class="input username" style="width:300px" type="text" id="punto_llegada" >
     </div>
            <br />
            <h2 align="center">Unidad de transporte</h2>
         

                <table>
                    <tr>
                        <td>
						    Marca y Número de Placa:&nbsp;&nbsp;<input name="transporte_mn" class="input username" style="width:200px" type="text" id="transporte_mn"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nª de constancia de inscripción :&nbsp;&nbsp;<input name="transporte_c" class="input username" style="width:150px" type="text" id="transporte_c"/>
                             </td>
                    </tr><tr>
                        <td>Nº de licencia de conducir:&nbsp;&nbsp;<input name="transporte_l" class="input username" style="width:130px" type="text" id="transporte_l"/>
                           </td>
                    </tr>
                </table>
            
			
			<h2 align="center">Empresa de transporte</h2>
            <div>

                <table>
                    <tr>
                        <td>
						    Razon Social de Transportista:&nbsp;&nbsp;<input name="transportista_rs" class="input username" style="width:400px" type="text" id="transportista_rs"/>
                            &nbsp;&nbsp;RUC :&nbsp;&nbsp;<input name="transportista_ruc" class="input username" style="width:150px" type="text" id="transportista_ruc"/>
                            </td>
                    </tr>
					 <tr>
                        <td>
						Dirección:&nbsp;&nbsp;<input name="transportista_dir" class="input username" style="width:400px" type="text" id="transportista_dir"/>
                           </td>
                    </tr>
                </table>
            </div>
            
             <br />
             <h2 align="center">Registro de productos</h2>
            <div id="frm_usu">
                <table>

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
            	
		<div>
            <table id="grilla">
              <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

 
                </tbody>
                <tfoot>
                	<tr>
                        <td colspan="3"><strong>Cantidad:</strong> <span id="span_cantidad">0</span> productos.</td>
                        <td><strong>Acción:</strong> <input id="submit" name="Submit" class="enviar" value="Enviar" type="submit"></td>
                        <td><strong>Suma total:</strong> <span id="suma_total">0</span></td>
                    </tr>
                </tfoot>
            </table>
            </div>
            </div>
</form> 

        
    
        </div>

     
    </body>
</html>
