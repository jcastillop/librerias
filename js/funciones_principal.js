$(document).ready(function() {
		$("#navegador_tabs").click(function () { 
			    $.ajax({
                type: "GET",
                url: "busqueda_tipocambio.php",
                cache: false,
                       
                	success: function(result){
                       
                		var res = jQuery.parseJSON(result);
                		
                		if(res.indicador==0){
                			
                		}else{
                			notificacion(res.mensaje);	
                		}
                             
                	},
                	error: function(result){
	                	alert("error");
    	            }
              });
		});

	});
		function addTab(title, url){
			if ($('#tt').tabs('exists', title)){
				$('#tt').tabs('select', title);
			} else {
				var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:90%;"></iframe>';
				$('#tt').tabs('add',{
					title:title,
					content:content,
					closable:true
				});
			}
			

		}

		function notificacion(param){
        	alertify.log("Tipo de cambio no actualizado" + param); 
        	return false;
        }