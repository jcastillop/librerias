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


<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>
        <title>jQuery - agregar y eliminar filas en una tabla</title>
        <script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    
        <script language="javascript" type="text/javascript" src="funciones.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />		
        <link href="../../../css/estilo.css" rel="stylesheet" type="text/css" />
    
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
    
    <form  id="form">
    <div class="container" >
            <h4 align="center" >Registro de compras</h4>
                 
                
                     <input type="file"  name="file" id="file" style="width:350px;margin-left:40px;"/>
                     <input class="enviar"  type="button"  id="cargarxls" name="cargarxls" value="CARGAR"/>
                     <label for="lblfec_rec"style="margin-left:100px" > Fecha de recepción:</label>
                     <input name ="fecha_recepcion" type="text" id="fecha_recepcion" class="input username" style="width:100px" /><br>
                      
                       <label for="lblsucursal_procedencia"style="margin-left:50px" > Sucursal:</label>
                        <select  name="sucursal" id="sucursal"   class="menu" onchange="from(document.form1.sucursal.value,'midiv','prueba.php')">
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
			<br><label for="lbldesc" style="margin-left:42px" >Descripción:</label>
			<input name ="descripcion" type="text" id="descripcion" class="input username"style="width:400px"  />
			<label for="lblcond" style="margin-left:170px" >Condición:</label>
                        <input name="condiciones" type="text" class="input username"  id="condiciones" style="width:100px" value="Compra"></input>
			
                </div>
            
        <div class="container3" >
              <h4 align="center">Registro de productos <input type="checkbox" name="transporte" value="1" id="transporte"></h4>
            <div id="frm_usu">

                    <tbody>
                     
                            <label for="lblcod" >Código Barras</label><input name="cod_bar_tit" type="text" id="cod_bar_tit" onkeypress="return tabular(event,this)"/>
       
                            <label for="lbled"style="margin-left:10px" >Edición</label>
                            <input name="edic_tit" type="text" id="edic_tit"style="width:100px"onkeypress="return tabular(event,this">
                   
                           <label for="lbltit" style="margin-left:38px" > Titulo</label><input name="tit_tit" type="text" id="tit_tit" onkeypress="return tabular(event,this)"/>

                            <label for="lblaut" style="margin-left:43px">Autor</label>
                            <input name="aut_tit" type="text" id="aut_tit" onkeypress="return tabular(event,this)"/><br>
                                
                            <label for="lblISBN" style="margin-left:67px" >ISBN</label>
                            <input name="isbn_tit" type="text" id="isbn_tit" onkeypress="return tabular(event,this)"/>
                       
                       
                              <label for="lblnro" >Nro. Pag</label>
                            <input name="nro_tit" type="text" id="nro_tit" onkeypress="return tabular(event,this)" style="width:100px"/>

                            <label for="lbledit" style="margin-left:14px" >Editorial</label>
							<input name="edi_tit" type="text" id="edi_tit" onkeypress="return tabular(event,this)"/>

                            <label for="lblgen"style="width:100px;margin-left:30px" >Genero</label>
                            <input name="gen_tit" type="text" id="gen_tit" onkeypress="return tabular(event,this)"/><br>

                            <label for="lblpais" style="margin-left:71px" >Pais</label>
                            <input name="pai_tit" type="text" id="pai_tit" onkeypress="return tabular(event,this)"/>

                            <label for="lbldesc" style="margin-left:1px" >Descripción</label>
                            <input name="desc_tit" type="text" id="desc_tit" style="width:335px" onkeypress="return tabular(event,this)"/>

                       
                          <label for="lblprov" style="margin-left:5px">Proveedor</label>
                          <input name="prov_tit" type="text" id="prov_tit" style="width:155px" onkeypress="return tabular(event,this)"/><br>
                          <label for="lblmon" style="margin-left:43px" >Moneda</label>
                          <input name="mon_tit" type="text" id="mon_tit" style="width:100px" onkeypress="return tabular(event,this)"/>
                          <label for="lblprec" style="margin-left:70px">Precio</label>
                          <input name="pre_tit" type="text" id="pre_tit" style="width:100px" onkeypress="return tabular(event,this)"/>
                          <label for="lblcant" style="margin-left:10px">Cantidad</label>
                          <input name="cant_tit"  type="text" id="cant_tit" style="width:100px" onkeypress="return tabular(event,this)"/>
                                           
                       
                    </tbody>
                    <tfoot>
                    </tfoot>
              
            </div></div>
            	
			<div class="container4" style="height:115px; overflow: scroll;" >
            <table id="grilla">
              <thead>
                    <tr>
                        <th style="width:50px;">Cod.Barras</th>
                        <th style="width:50px;">Cantidad</th>
                        <th style="width:50px;">Título</th>
                        <th style="width:150px;">Autor</th>
                        <th style="width:50px;">Proveedor</th>
                        <th style="width:100px;">ISBN</th>
                       <th style="width:50px;">Edición</th>
                        <th style="width:100px;">Nro Pag.</th>
                        <th style="width:100px;">Editorial</th>
                        <th style="width:50px;">Genero</th>
                        <th style="width:50px;">Pais</th>
                        <th style="width:50px;">Moneda</th>
                        <th style="width:50px;">Precio</th>
                        <th style="width:50px;">Desc</th>
                    </tr>
                </thead>
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
            
</form> 

        
    
        

     
    </body>
</html>

