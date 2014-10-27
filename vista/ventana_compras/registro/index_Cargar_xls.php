<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>jQuery Easy - Importar Excel</title>
<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script language="javascript" type="text/javascript" src="funciones.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
</head>
<body>
<div id="header">

</div>

<div id="demos">
    <h3>Seleccionar archivo Excel</h3>
    <form name="frmload" method="post" action="cargar_tabla.php" enctype="multipart/form-data">
        <input type="file" name="file" /> &nbsp; &nbsp; &nbsp; <input type="submit" value="----- IMPORTAR -----" />
    
    <div id="show_excel">

    </div>

    </form>
    <input type="button" value="Registrar información" id="btn_enviar" name="btn_enviar"/>
</div>
	
</body>
</html>
