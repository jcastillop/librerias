<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
 <link href="responsive/css/style.css" rel="stylesheet">
 <script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
 <script src="responsive/js/scripts.js"></script>
 <script src="funciones.js"></script>
  <link href="../../../paquetes/js/validar.js" rel="stylesheet">
<body>
<div align="center">
<form >
<div id="contact-form">
  <table width="34%"  class="table_css"  align="center">
    <tr>
      <td colspan="3" align="center"><p><img src="responsive/img/edit_user-.png" width="94" height="77" /></p>
        <p>CLIENTE NUEVO</p></td>
    </tr>
    <tr>
      <td colspan="3" class="tw">&nbsp;</td>
      </tr>
    <tr>
      <td width="27%"><p>&nbsp;</p>
        <p>TIPO CLIENTE : </p></td>
      <td colspan="2"><select name="tip_per" class="menu"   id="tip_per" onblur="validar_tipo_doc()"  onkeypress="return tab(event,this)">
        <option>--Seleccione--</option>
        <option value="1">Persona Natural</option>
        <option value="2">Persona Juridica</option>
      </select></td>
      </tr>
    <tr>
      <td><label id="rsocial" class="rsocial">R. SOCIAL:</label></td>
      <td colspan="2"><input name="rsoc" type="text"   id="rsoc"  onkeypress="return tab(event,this)" /></td>
      </tr>
    <tr>
      <td><label id="ruc" class="ruc">RUC:</label></td>
      <td ><input name="ruc" type="text"   id="ruc" onkeyup="return ValNumero(this);" onKeyPress="return tab(event,this)"   /></td>
      </tr>
    <tr>
      <td>DIRECCION:</td>
      <td width="36%"><input name="direccion" type="text"   id="direccion"  onkeypress="return tab(event,this)" /></td>
      <td width="37%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" name="boton" id="boton" value="GUARDAR" /></td>
      </tr>
  </table>


</form>
</div>


</div>
</body>
</html>
