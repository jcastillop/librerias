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
        <link href="../../../css/estilo.css" rel="stylesheet" type="text/css" />
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

    
    
        <body>	
            
            <form  id="form">
    <div class="container" >
            <h4 align="center" >Guía Remisión</h4>
            <label for="lblsucursal_procedencia" >Sucursal procedencia:</label>
            <select  name="sucursal" id="sucursal"  style="width:150px;margin-left:0px;;margin-top:0px" class="menu" >
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
            <label for="lblsucursal_envio" >Sucursal envio:</label>
              
                <select  name="cliente" id="cliente"  style="width:150px;margin-top:0px" class="menu" >
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
						
			<label for="lblvendedor">Vendedor:</label>
            <select  name="vendedor" id="vendedor"  style="width:200px;margin-top:0px" class="menu">
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
            </select><br>
            <label for="lblcondicion">Condición:</label>
            <input name="condiciones" class="condiciones" style="width:150px;margin-top:5px;margin-left:80px;"type="text"  id="condiciones" value="Transacción"  OnFocus="this.blur()"/>
            <label for="lblfecha" style="margin-left:5px;" >Fecha traslado:</label>
            <input name ="fecha_registro" type="text" id="datepicker" class="input username" style="width:150px;margin-top:5px;" />           
		    <label for="lblruc"  style="margin-left:30px;">R.U.C:</label>
            <input name="ruc" class="input username" style="width:200px; margin-top:5px" type="text" id="ruc" onkeypress="" /> <br>
            <label for="lbldireccion" style="width:150px">Dirección alternativa:</label>
            <input name="direccion_compra" class="input username" style="width:750px;margin-top:10px;" type="text" id="direccion_compra"/><br>
            <label for="lblpartida">Punto de partida:</label>
            <input name="punto_partida" class="input username" style="width:300px;margin-top:10px;margin-left:35px;" type="text" id="punto_partida" >
            <label for="lblllegada">Punto de llegada:</label>
            <input name="punto_llegada" class="input username" style="width:300px;margin-top:10px;margin-left:0px" type="text" id="punto_llegada" ></div>
			    <div class="container1" >
            <h4 align="center" >Unidad de transporte</h4>
         

                
						    <label for="lblplaca" style="width:180px">Marca y Placa:</label><input name="transporte_mn" class="input username" style="width:180px" type="text" id="transporte_mn"/>
                            <label for="lblconstancia" style="width:220px">Nª de constancia: </label><input name="transporte_c" class="input username" style="width:180px" type="text" id="transporte_c"/>
                            <label for="lblcondruc" style="width:180px">Nº de licencia :</label><input name="transporte_l" class="input username" style="width:180px" type="text" id="transporte_l"/><br>
							   </div><div class="container2" >
							<h4 align="center">Empresa de transporte</h4>
           

						   <label for="lbltransrs" style="width:150px"> Razon Social de Transportista:</label><input name="transportista_rs" class="input username" style="width:400px" type="text" id="transportista_rs"/>
                            <label for="lbltransruc" style="width:150px">R.U.C.</label><input name="transportista_ruc" class="input username" style="width:220px" type="text" id="transportista_ruc"/>
                            
						<br><label for="lbltransdir" style="width:150px">Dirección de Transportista</label><input name="transportista_dir" class="input username" style="width:700px;margin-left:30px;margin-top:10px" type="text" id="transportista_dir"/>
          </div>  
     <div class="container3" >
             <h4 align="center">Registro de productos</h4>
            <div id="frm_usu">
                <table>

                    <tbody>
                        <tr>
                            <td> <label for="lblcod" style="width:180px">Código</label></td>
                            <td><input name="valor_ide" class="input username" style="width:100px" type="text" id="valor_ide" size="10" onkeypress="return tabular(event,this)"/></td>
       
                            <td><label for="lbldesc" style="width:180px">Descripción</label></td>
                            <td><input name="valor_uno" class="input username"style="width:300px" type="text" id="valor_uno" size="50" class="required"/></td>
                   
                            <td><label for="lbldesc" style="width:180px">Precio</label></td>
                            <td><input name="valor_dos" class="input username" style="width:100px" type="text" id="valor_dos" size="10" class="required"/>
                                <input type="hidden" id="tituloID" name="tituloID"></input>
                            </td>
                                
                            <td><label for="lbldesc" style="width:180px">Cantidad</label></td>
                            <td><input name="valor_tres" class="input username" style="width:100px" type="text" id="valor_tres" size="10" onkeypress="return tabular(event,this)"/></td>
                        </tr>
                       
                    </tbody>
                    <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>    </div>
				<div class="container4">
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
	
           
                           
           
            	
	
         

     
    </body>
</html>
