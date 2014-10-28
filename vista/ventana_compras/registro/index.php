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
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="../../../paquetes/css ventanas/style_ventana.css" rel="stylesheet" type="text/css" />
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
    
            <h1 align="center">Registro de compras</h1>
            <div class="content">
            
            <div  style="width: 1095px; margin-left: 10px; border-radius: 10px; border: 2px solid #B1B1B1;">
            <table>
      

            


                 <tr>
                    <td>
                        <input type="file" name="file" id="file"/>
                        <input class="button" style="width:80px" type="button"  id="cargarxls" name="cargarxls" value="CARGAR"/>
                    </td>  
                </tr>
                <tr>
                    <td>
                        Fecha de recepción:<input name ="fecha_registro" type="text" id="fecha_registro" class="input username" style="width:150px" />
                        Fecha de emisión:<input name ="fecha_emision" type="text" id="fecha_emision" class="input username" style="width:150px" />
                    </td> 
                </tr>
                <tr>
                    <td>Sucursal:                 
                        <select  name="sucursal" id="sucursal"  style="width:350px" class="input username" onChange="from(document.form1.sucursal.value,'midiv','prueba.php')">
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
                        Fecha de caducidad:
                        <input name ="fecha_caducidad" type="text" id="fecha_caducidad" class="input username" style="width:150px" />
                    </td>
                </tr> 
                <tr>
                    <td>Descripción:<input name ="descripcion" type="text" id="descripcion" class="input username" style="width:300px" /></td>
                </tr>   

            </table>
            </div>
        
             <br />
             <h2 align="center">Registro de productos</h2>
            <div id="frm_usu" style="width: 1080px; margin-left: 10px; border-radius: 10px;border: 2px solid #B1B1B1;">
                <table border="0" align="center">

                    <tbody>
           <tr>
                            <td>Código Barras</td>
                            <td><input name="cod_bar_tit" class="input username" style="width:100px" type="text" id="cod_bar_tit" onkeypress="return tabular(event,this)"/></td>
       
                            <td>Cantidad</td>
                            <td><input name="cant_tit" class="input username"style="width:60px" type="text" id="cant_tit" class="required" onkeypress="return tabular(event,this)"/></td>
                   
                            <td>Titulo</td>
                            <td><input name="tit_tit" class="input username" style="width:100px" type="text" id="tit_tit" class="required" onkeypress="return tabular(event,this)"/></td>

                            <td>Autor</td>
                            <td><input name="aut_tit" class="input username" style="width:100px" type="text" id="aut_tit" onkeypress="return tabular(event,this)"/></td>
                                
                            <td>Proveedor</td>
                            <td><input name="prov_tit" class="input username" style="width:100px" type="text" id="prov_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>ISBN</td>
                            <td><input name="isbn_tit" class="input username" style="width:80px" type="text" id="isbn_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Edición</td>
                            <td><input name="edic_tit" class="input username" style="width:100px" type="text" id="edic_tit" onkeypress="return tabular(event,this)"/></td>
                        </tr>
                        <tr>
                            <td>Nro. Pag</td>
                            <td><input name="nro_tit" class="input username" style="width:70px" type="text" id="nro_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Editorial</td>
                            <td><input name="edi_tit" class="input username" style="width:100px" type="text" id="edi_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Genero</td>
                            <td><input name="gen_tit" class="input username" style="width:100px" type="text" id="gen_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Pais</td>
                            <td><input name="pai_tit" class="input username" style="width:100px" type="text" id="pai_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Moneda</td>
                            <td><input name="mon_tit" class="input username" style="width:100px" type="text" id="mon_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Precio</td>
                            <td><input name="pre_tit" class="input username" style="width:80px" type="text" id="pre_tit" onkeypress="return tabular(event,this)"/></td>

                            <td>Descripción</td>
                            <td><input name="desc_tit" class="input username" style="width:100px" type="text" id="desc_tit" onkeypress="return tabular(event,this)"/></td>

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
                        <td><strong>Acción:</strong> <input id="submit" name="Submit" class="button" value="Enviar" type="submit"></td>
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