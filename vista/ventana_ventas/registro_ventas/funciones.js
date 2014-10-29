            $(document).ready(function(){
         
         
         $("#boton").click(function() {
						$.ajax({
                        type: "GET",
                        url: "insertar_datos.php",
                        data: "tip_per=" + $("#tip_per").val(),
                        success: function(datos){
                        
                        //var res = jQuery.parseJSON(datos);
                        var variable=27;
                        if(res.cliente===""){
                            alert("cliente vacio");
                        }else{

                        $("#ruc").val(res.ruc);
						$("#direccion").val(res.direccion);

                     
                        $("#valor_tres").focus();
                        
                        fn_dar_eliminar();
                        fn_cantidad(); 
                        }
                        
                        },
                        error: function(datos) {
                        alert("Data not found");
                        }
                    });
         
         
         
                //Iniciando el datepicker
                $( "#datepicker" ).datepicker();
                //Iniciando las validaciones del formulario
				$("#contact-form").validate({
                //Especificando las reglas de validacion
                
                        rules: {
						    
							tipo_doc: {
                               required: true
                            },
                            sucursal: {
                               required: true
                            },
                            fecha_registro: {
                               required: true
                            },
                            cliente: {
                               required: true
                            },
							ruc: {
                               required: true
                            },
                            vendedor: {
                               required: true
                            }
                           
                    },
                // Especificandolos mensaje
                    messages: {
					    tipo_doc: "*",
                        sucursal: "*",
                        fecha_registro: "*",
                        cliente: "*",
						ruc: {
                            required: "*",
                            maxlength: "Máximo 11 caracteres"
                        },
                        vendedor: "*"
                       
                       
                    },
                    submitHandler: function(form) {
                        //Variables Cabecera Pedido

                    var cod_emp=1;
					var tipo_doc= $("#tipo_doc").val();
                    var cod_suc = $("#sucursal").val();
                    var cod_cli = $("#clienteID").val();
                    var fec_pedido=$("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd ").val() + " 12:36:05";
                    var ped_usu='JCASTILLO';
                    //Variables Cabecera Guia
                    var cod_ser='1';
                    var cod_usu=$("#vendedor").val();
                    
                    var pedido_detalle = "[";
              
                    
                    
                    for (var i=1;i<document.getElementById('grilla').rows.length-2;i++){ 
                        pedido_detalle = pedido_detalle + 
                            '{"codigo_libro":' 
                            + document.getElementById('grilla').rows[i].cells[0].childNodes[1].value + ", "
                            + '"cantidad_libro":'
                            + document.getElementById('grilla').rows[i].cells[3].childNodes[0].value + ", "
                            + '"valor_impuesto":'
                            + (document.getElementById('grilla').rows[i].cells[3].childNodes[0].value * document.getElementById('grilla').rows[i].cells[2].childNodes[0].value) * 0.18 + ", "
                            + '"valor_descuento":'
                            + (document.getElementById('grilla').rows[i].cells[3].childNodes[0].value * document.getElementById('grilla').rows[i].cells[2].childNodes[0].value) * document.getElementById('grilla').rows[i].cells[4].childNodes[0].value + ", "
                            + '"porcentaje_impuesto":'
                            + 18 + ", "
                            + '"porcentaje_descuento":'
                            + document.getElementById('grilla').rows[i].cells[4].childNodes[0].value + ", "
                            + '"costo_total_libro":'
                            + document.getElementById('grilla').rows[i].cells[4].childNodes[0].value + "}"

                            if (i==document.getElementById('grilla').rows.length-3){
                            pedido_detalle = pedido_detalle + "]";
                            }else{
                            pedido_detalle = pedido_detalle + ','; 
                            }       
                    }

                   
                    if(pedido_detalle=="["){
                       
                        alert("Registre correctamente los campos as");
                    } else {
                                        //Datos Cabecera Pedido
                        var dataString= 'cod_emp='+cod_emp+
                                        '&cod_suc='+cod_suc+
                                        '&cod_cli='+cod_cli+
										'&tipo_doc='+tipo_doc+
                                        '&fec_pedido='+fec_pedido+
                                        '&ped_usu='+ped_usu+
                                        //Datos Cabecera Guia
                                        '&cod_ser='+cod_ser+
                                        '&cod_usu='+cod_usu+
                                        '&pedido_detalle='+pedido_detalle;

                                                          
                                                              
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

                            alert(result); 
							
                            limpiarformulario("#contact-form");

                          },
                          error: function(result){

                            alert("error");
                          }
                        });
                    }
                    return false;   
                    }
                });
                //Busqueda de titulos segun el codgo de barra proporcionado
                $("#valor_ide").change(function() {
                    
                    $.ajax({
                        type: "GET",
                        url: "titulos_buscar.php",
                        data: "id=" + $("#valor_ide").val(),
                        success: function(datos){
                        
                        var res = jQuery.parseJSON(datos);
                        
                        if(res.nombre===""){
                            alert("Título no registrado, proceda a agregarlo en el menú correspondiente");
                        }else{

                        $("#valor_uno").val(res.nombre);

                        $("#tituloID").val(res.codigo);

                        $("#valor_dos").val(res.precio);
                        
                        $("#valor_cuatro").val(res.precio);
                     
                        $("#valor_tres").focus();
                        
                        fn_dar_eliminar();
                        fn_cantidad(); 
                        }
                        
                        },
                        error: function(datos) {
                        alert("Data not found");
                        }
                    });
                });

                $("#valor_tres").change(function() {
                        cadena = "<tr>";
                        cadena = cadena + "<td><input name='codigo[]' class='input username' type='text' value='"+ $("#valor_ide").val() +"'  OnFocus='this.blur()'/><input name='codigo_titulo[]' id='codigo_titulo[]' type='hidden' value='"+ $("#tituloID").val() +"'/></td>";
                        cadena = cadena + "<td><input name='nombre[]' class='input username' id='nombre[]' type='text' value='"+ $("#valor_uno").val() +"'  OnFocus='this.blur()'/></td>";
                        cadena = cadena + "<td><input name='precio[]' class='precio' type='text' value='"+ $("#valor_dos").val() +"'  OnFocus='this.blur()'/></td>";
                        cadena = cadena + "<td><input name='cantidad[]' class='cantidad' id='cantidad[]' type='text' value='"+ $("#valor_tres").val() +"'  onKeyUp='sumar()'/></td>";
                        cadena = cadena + "<td><input name='descuento[]' class='descuento' id='descuento[]' type='text' value='0'  onKeyUp='sumar()'/></td>";
                        cadena = cadena + "<td><input name='total[]' class='total' id='total[]' type='text' value='"+ $("#valor_dos").val() * $("#valor_tres").val() +"'  OnFocus='this.blur()'/></td>";
                        cadena = cadena + "<td><a class='elimina'><img src='delete.png' /></a></td></tr>";
                        $("#grilla tbody").append(cadena);
                        $('#frm_usu input[type="text"]').val('');
                        $("#valor_ide").focus();
                        fn_dar_eliminar();
                        fn_cantidad(); 
 
                });

                $("#cliente").autocomplete({
                    source:'autocompletar_clientes.php',
                    minLength:1,
                    focus: function( event, ui ) {
                        $( "#cliente" ).val(ui.item.label);
                        return false;
                    },
                    select: function( event, ui ) {
                        $( "#cliente" ).val( ui.item.label );
                        $("#clienteID").val(ui.item.id);
                        
                    return false;
                    }
                });

                $("#cliente").change(function() {
                   
                    
                    $.ajax({
                        type: "GET",
                        url: "clientes_buscar.php",
                        data: "id=" + $("#cliente").val(),
                        success: function(datos){

                       
                        var res = jQuery.parseJSON(datos);
                     
                        $("#ruc").val(res.ruc);
                        $("#id").val(res.id);
                        $("#direccion").val(res.direccion);
                        $("#distrito").val(res.distrito);
                        $("#telefono").val(res.telefono);
                        $("#referencia").val(res.referencia);
                        $("#direccion_compra").focus();
                        
                        },
                        error: function(datos) {
                        alert("Data not founds");
                        }
                    });
                    
                });
 
                });
				
				
				
			
			function fn_cantidad(){
				cantidad = $("#grilla tbody").find("tr").length;
				$("#span_cantidad").html(cantidad);
			};

			function fn_dar_eliminar(){
                $("a.elimina").click(function(){
                    id = $(this).parents("tr").find("td").eq(0).html();
                    $(this).parents("tr").fadeOut("normal", function(){
                        $(this).remove();
                        fn_cantidad(); 
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
            function sumar(){
        
                var a_descuento = [], a_precio = [], a_cantidad  = [], a_total  = [];
                $('.descuento').each( function () {       
                    a_descuento.push($(this));
                } );
                $('.precio').each( function () {         
                    a_precio.push($(this));
                } );
                $('.cantidad').each( function () {        
                    a_cantidad.push($(this));
                } );  
                $('.total').each( function () {        
                    a_total.push($(this));
                } );  
          
                for(var i =0 ; i < a_cantidad.length ; i++){
            
                    a_total[i][0]['value'] = (a_precio[i][0]['value'] * a_cantidad[i][0]['value'])-((a_precio[i][0]['value'] * a_cantidad[i][0]['value'])*(a_descuento[i][0]['value']/100));

                }
         
            console.log(a_total);        
            console.log(a_precio);
            console.log(a_descuento);
            console.log(a_cantidad);
            }

