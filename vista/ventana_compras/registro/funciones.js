
$(document).ready(function(){


    $("#form").validate({
                //Especificando las reglas de validacion
                
        rules: {
                            ruc: {
                               required: true
                            },
                            id_prov: {
                               required: true
                            },
                            fecha_recepcion: {
                               required: true
                            },
                            fecha_emision: {
                               required: true
                            },
                            fecha_caducidad: {
                               required: true
                            },                            
                            descripcion: {
                               required: true
                            }
                            
                        
                    },
                // Especificandolos mensaje
                    messages: {
                        sucursal: "*",
                        fecha_registro: "*",
                        cliente: "*",
                        direccion_compra: "*",
                        vendedor: "*",
                        punto_partida: {
                            required: "*"
                        },
                        punto_llegada: {
                            required: "*"
                        },
                        
                       
                    },
                    submitHandler: function(form) {
                        //Variables Cabecera Pedido
                    var cod_emp=1;
                    var cod_suc = $("#sucursal").val();
                    var cod_cli = $("#cliente").val();
                    var fec_pedido=$("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd ").val() + " 12:36:05";
                    var ped_usu='JCASTILLO';
                    //Variables Cabecera Guia
                    var cod_ser='1';
                    var dir_env=$("#direccion_compra").val();
                    var pun_part=$("#punto_partida").val();
                    var pun_lleg=$("#punto_llegada").val();
                    var cod_usu=$("#vendedor").val();
                    var dist_gui=$("#distrito_compra").val();
                    var turn_gui=$("#turno").val();
                    var telef_gui=$("#telefono").val();
                    var tran_mn=$("#transporte_mn").val();
                    var tran_c=$("#transporte_c").val();
                    var tran_l=$("#transporte_l").val();
                    var trans_rs=$("#transportista_rs").val();
                    var trans_ruc=$("#transportista_ruc").val();
                    var trans_dir=$("#transportista_dir").val();
                    var pedido_detalle = "[";
                    
                    for (var i=1;i<document.getElementById('grilla').rows.length-1;i++){ 
                        pedido_detalle = pedido_detalle + 
                            '{"codigo_libro":' 
                            + document.getElementById('grilla').rows[i].cells[0].childNodes[1].value + ", "
                            + '"cantidad_libro":'
                            + document.getElementById('grilla').rows[i].cells[3].childNodes[0].value + ", "
                             + '"valor_impuesto":'
                            + 0 + ", "
                             + '"valor_descuento":'
                            + 0 + ", "
                             + '"porcentaje_impuesto":'
                            + 0 + ", "
                             + '"porcentaje_descuento":'
                            + 0 + ", "
                            + '"costo_total_libro":'
                            + document.getElementById('grilla').rows[i].cells[4].childNodes[0].value + "}"

                            if (i==document.getElementById('grilla').rows.length-2){
                            pedido_detalle = pedido_detalle + "]";
                            }else{
                            pedido_detalle = pedido_detalle + ','; 
                            }       
                    } 
                    if(pedido_detalle=="'"){
                       
                        alert("Registre correctamente los campos as");
                    } else {
                                        //Datos Cabecera Pedido
                        var dataString= 'cod_emp='+cod_emp+
                                        '&cod_suc='+cod_suc+
                                        '&cod_cli='+cod_cli+
                                        '&fec_pedido='+fec_pedido+
                                        '&ped_usu='+ped_usu+
                                        //Datos Cabecera Guia
                                        '&cod_ser='+cod_ser+
                                        '&dir_env='+dir_env+
                                        '&pun_part='+pun_part+
                                        '&pun_lleg='+pun_lleg+
                                        '&cod_usu='+cod_usu+
                                        '&dist_gui='+dist_gui+
                                        '&turn_gui='+turn_gui+
                                        '&telef_gui='+telef_gui+
                                        '&tran_mn='+tran_mn+
                                        '&tran_c='+tran_c+
                                        '&tran_l='+tran_l+
                                        '&trans_rs='+trans_rs+
                                        '&trans_ruc='+trans_ruc+
                                        '&trans_dir='+trans_dir+
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
                            limpiarformulario("#form");
                            alert(result);   
                          },
                          error: function(result){
                            alert("error");
                          }
                        });
                    }
                    return false;   
                    }
                });


         
	$( "#cargarxls" ).click(function() {

                    

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

    $("#pre_tit").change(function() {
        cadena = "<tr>";
        cadena = cadena + "<td><input name='cod_bar_des[]' style='width:80px' id='cod_bar_des[]' type='text' value='"+ $("#cod_bar_tit").val() +"' size='15' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='cant_des[]' id='cant_des[]' type='text' value='"+ $("#cant_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='tit_des[]' id='tit_des[]' type='text' value='"+ $("#tit_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='aut_des[]' id='aut_des[]' type='text' value='"+ $("#aut_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='desc_des[]' id='desc_des[]' type='text' value='"+ $("#desc_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='isb_des[]' id='isb_des[]' type='text' value='"+ $("#isbn_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='edic_des[]' id='edic_des[]' type='text' value='"+ $("#edic_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='nro_des[]' id='nro_des[]' type='text' value='"+ $("#nro_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='edit_des[]' id='edit_des[]' type='text' value='"+ $("#edi_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='gen_des[]' id='gen_des[]' type='text' value='"+ $("#gen_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='pai_des[]' id='pai_des[]' type='text' value='"+ $("#pai_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='mon_des[]' id='mon_des[]' type='text' value='"+ $("#mon_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        cadena = cadena + "<td><input name='pre_des[]' id='pre_des[]' type='text' value='"+ $("#pre_tit").val() +"' size='30' OnFocus='this.blur()'/></td>";
        

        cadena = cadena + "<td><a class='elimina'><img src='delete.png' /></a></td></tr>";
        $("#grilla tbody").append(cadena);
        $('#frm_usu input[type="text"]').val('');
        $("#valor_ide").focus();
        fn_dar_eliminar();
        fn_cantidad();
        fn_sumatotal();
 
    });
});
/*

        var pedido_detalle = "[";
        for (var i=1;i<document.getElementById('grilla').rows.length-1;i++){ 
            pedido_detalle = pedido_detalle + 
                            '{"cantidad_libro":' 
                            + document.getElementById('grilla').rows[i].cells[0].childNodes[0].value + ", "         
                            +'{"titulo_libro":' 
                            + document.getElementById('grilla').rows[i].cells[1].childNodes[0].value + ", "
                            + '"costo_total_libro":'
                            + document.getElementById('grilla').rows[i].cells[5].childNodes[0].value + "}"

            if (i==document.getElementById('grilla').rows.length-2){
                pedido_detalle = pedido_detalle + "]";
            }else{
            pedido_detalle = pedido_detalle + ','; 
            }       
        } 
    alert(pedido_detalle);
    });
*/

    function fn_cantidad(){
        cantidad = $("#grilla tbody").find("tr").length;
        $("#span_cantidad").html(cantidad);
    };
    function fn_sumatotal(){
        var total=0;
        for (var i=1;i<document.getElementById('grilla').rows.length-1;i++){ 
            total= total + parseFloat(document.getElementById('grilla').rows[i].cells[4].childNodes[0].value);
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
        $('#grilla').empty();
}