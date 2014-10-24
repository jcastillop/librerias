
$(document).ready(function(){
         
	$( "#btn_enviar" ).click(function() {
        var pedido_detalle = "[";
		for (var i=1;i<document.getElementById('grilla').rows.length-1;i++){ 
        	pedido_detalle = pedido_detalle + 
            				'{"cantidad_libro":' 
                            + document.getElementById('grilla').rows[i].cells[0].childNodes[0].value + ", "        	
            				+'{"titulo_libro":' 
                            + document.getElementById('grilla').rows[i].cells[1].childNodes[0].value + ", "
            				+'{"autor_libro":' 
                            + document.getElementById('grilla').rows[i].cells[2].childNodes[0].value + ", "                            
            				+'{"descripcion_libro":' 
                            + document.getElementById('grilla').rows[i].cells[3].childNodes[0].value + ", "
            				+'{"isbn_libro":' 
                            + document.getElementById('grilla').rows[i].cells[4].childNodes[0].value + ", "                                                         
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
});