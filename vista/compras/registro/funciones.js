$(document).ready(function(){
//Iniciando el datepicker
$.datepicker.setDefaults($.datepicker.regional["es"]);
    $( "#fecha_recepcion" ).datepicker({dateFormat: 'dd/mm/yy'});
    $("#frm_usu").css("display", "none");
//Validaciones y envio del formulario
	$("#form").validate({
    //Especificando las reglas de validacion
    rules: {
        distrito: {
            required: true
        },
        fecha_recepcion: {
            required: true
        },
        sucursal: {
            required: true
        },
        descripcion: {
            required: true
        },
    },
    // Especificandolos mensaje
    messages: {
        fecha_recepcion: {
            required: "*"
        },
        sucursal: {
            required: "*"
        },
        descripcion: {
            required: "*"
        },
                        
                       
    },
    submitHandler: function(form) {
        //Variables Cabecera Pedido
       
        var cod_emp=1;
        var cod_suc = $("#sucursal").val();
        var fec_rec = $("#fecha_recepcion").datepicker("option", "dateFormat", "yy-mm-dd ").val();
        var desc = $("#descripcion").val();
        var compra_detalle = "[";
                    
        for (var i=1;i<document.getElementById('grilla').rows.length-1;i++){ 
            compra_detalle = compra_detalle + 
            '{"codigo_barras_detalle":"' 
            + document.getElementById('grilla').rows[i].cells[0].childNodes[0].value + '", '
            + '"cantidad_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[1].childNodes[0].value + '", '
            + '"titulo_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[2].childNodes[0].value + '", '
            + '"autor_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[3].childNodes[0].value + '", '
            + '"proveedor_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[4].childNodes[0].value + '", '   
            + '"isbn_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[5].childNodes[0].value + '", '   
            + '"edicion_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[6].childNodes[0].value + '", '   
            + '"nropag_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[7].childNodes[0].value + '", '   
            + '"editorial_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[8].childNodes[0].value + '", '   
            + '"genero_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[9].childNodes[0].value + '", '   
            + '"pais_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[10].childNodes[0].value + '", '
            + '"moneda_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[11].childNodes[0].value + '", '             
            + '"precio_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[12].childNodes[0].value + '", '    
            + '"descripcion_libro_detalle":"'
            + document.getElementById('grilla').rows[i].cells[13].childNodes[0].value + '"}'

            if (i==document.getElementById('grilla').rows.length-2){
              
                compra_detalle = compra_detalle + "]";
            }else{
                compra_detalle = compra_detalle + ','; 
            }       
        }
       
        if(compra_detalle=="["){
                       
            alert("Registre detalle de la compra");
        } else {
            
        //Datos compras cabecera
        
        var dataString= 'cod_emp='+cod_emp+
                        '&cod_suc='+cod_suc+
                        '&fec_rec='+fec_rec+
                        '&desc='+desc+
                        '&compra_detalle='+compra_detalle;
                      
                        $.ajax({
                          type: "POST",
                          url: "insertar_datos.php",
                          data: dataString,
                          cache: false,
                          
                          success: function(result){
                            /*
                            if(result==0){
                               limpiarformulario("#form");
                               alert("Guia registrada correctamente");
                            } else {
                               alert("Error al registrar guia: " + result);
                            } 
                            */
                            limpiarformulario("#form");
                            alert(result);   
                            $("#condiciones").val("Compra"); 
                          },
                          error: function(result){
                            alert("error");
                          }
                        });
                    }  
        
        return false;   
        }
    });
    
    $("#transporte").click(function(evento){
                  if ($("#transporte").attr("checked")){
                  $("#frm_usu").css("display", "block");
		  }else{
                  $("#frm_usu").css("display", "none");
                  }
                  });
                  
                //Carga xls a la tabla
    $("#cargarxls").click(function() {
       
                    
        var formData = new FormData();
        formData.append('file', $('#file').get(0).files[0]);
                  
                    $.ajax({
                        type: "POST",
                        url: "cargar_tabla.php",
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(datos){
                        
                        
                        $("#grilla tbody").append(datos);
                        $('#frm_usu input[type="text"]').val('');
                        $("#cod_bar_tit").focus();
                        fn_dar_eliminar();
                        fn_cantidad();
                        fn_sumatotal();
                        var can = $("#grilla tbody").find("tr").length;

                        
                        
                        },
                        error: function(datos) {
                        alert("Data not founds");
                        }
                    });


                });

                $("#cod_bar_tit").change(function() {
                    
                    $.ajax({
                        type: "GET",
                        url: "titulos_buscar.php",
                        data: "id=" + $("#cod_bar_tit").val(),
                        success: function(datos){
                        
                        var res = jQuery.parseJSON(datos);
                        
                        if(res.nombre===""){
                            alert("Título no registrado, proceda a agregarlo en el menú correspondiente");
                        }else{

                        $("#tit_tit").val(res.nombre);

                        $("#aut_tit").val(res.autor);

                        $("#isbn_tit").val(res.isbn);
                        
                        $("#edic_tit").val(res.edicion);

                        $("#nro_tit").val(res.nropag);
//
                        $("#edi_tit").val(res.editorial);

                        $("#gen_tit").val(res.genero);

                        $("#pai_tit").val(res.pais);

                        $("#desc_tit").val(res.descripcion);
                     
                        fn_dar_eliminar();
                        fn_cantidad(); 
                        }
                        
                        },
                        error: function(datos) {
                        alert("Data not found");
                        }
                    });
                });

    $("#cant_tit").change(function() {
        cadena = "<tr>";
        cadena = cadena + "<td><input name='cod_bar_des[]' style='width:80px' id='cod_bar_des[]' type='text' value='"+ $("#cod_bar_tit").val() +"' size='15' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='cant_des[]' style='width:70px' id='cant_des[]' type='text' value='"+ $("#cant_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='tit_des[]' style='width:70px' id='tit_des[]' type='text' value='"+ $("#tit_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='aut_des[]' style='width:70px' id='aut_des[]' type='text' value='"+ $("#aut_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='prov_des[]' style='width:70px' id='prov_des[]' type='text' value='"+ $("#prov_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='isb_des[]' style='width:70px' id='isb_des[]' type='text' value='"+ $("#isbn_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='edic_des[]' style='width:70px' id='edic_des[]' type='text' value='"+ $("#edic_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='nro_des[]' style='width:70px' id='nro_des[]' type='text' value='"+ $("#nro_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='edit_des[]' style='width:70px' id='edit_des[]' type='text' value='"+ $("#edi_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='gen_des[]' style='width:70px' id='gen_des[]' type='text' value='"+ $("#gen_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='pai_des[]' style='width:70px' id='pai_des[]' type='text' value='"+ $("#pai_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='mon_des[]' style='width:70px' id='mon_des[]' type='text' value='"+ $("#mon_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='pre_des[]' style='width:70px' id='pre_des[]' type='text' value='"+ $("#pre_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='desc_des[]' style='width:70px' id='desc_des[]' type='text' value='"+ $("#desc_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";        
        cadena = cadena + "<td><a class='elimina'><img src='delete.png' /></a></td></tr>";
        $("#grilla tbody").append(cadena);
        $('#frm_usu input[type="text"]').val('');
        $("#valor_ide").focus();
        fn_dar_eliminar();
        fn_cantidad();
        fn_sumatotal();
 
    });
		
});			
				
			
			function fn_cantidad(){
				cantidad = $("#grilla tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};
            function fn_sumatotal(){
                    var total=0;
                    for (var i=1;i<document.getElementById('grilla').rows.length-1;i++){ 
                    total= total + parseFloat(document.getElementById('grilla').rows[i].cells[12].childNodes[0].value);
             
                    }
                    $("#suma_total").html(total); 
            };			

			   function fn_dar_eliminar(){
                $("a.elimina").click(function(){
                    id = $(this).parents("tr").find("td").eq(0).html();
                    
                  
                        $(this).parents("tr").fadeOut("normal", function(){
                            $(this).remove();
                            fn_cantidad(); 
                            fn_sumatotal();
                            /*
                                aqui puedes enviar un conjunto de datos por ajax
                                $.post("eliminar.php", {ide_usu: id})
                            */
                        })
                    
                });

            };
            function limpiarformulario(formulario){
   /* Se encarga de leer todas las etiquetas input del formulario*/
     $(formulario).find('input').each(function() {
      switch(this.type) {
         case 'password':
         case 'text':
         case 'hidden':
              $(this).val('');
              break;
         case 'checkbox':
         case 'radio':
              this.checked = false;
      }
   });
 
   /* Se encarga de leer todas las etiquetas select del formulario */
   $(formulario).find('select').each(function() {
       $("#"+this.id + " option[value='']").attr("selected",true);
   });
   /* Se encarga de leer todas las etiquetas textarea del formulario */
   $(formulario).find('textarea').each(function(){
      $(this).val('');
   });
   $('#grilla tbody').empty();
                               fn_cantidad(); 
                            fn_sumatotal();
}

