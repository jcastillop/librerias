/*
Creating an HTML5 enhanced responsive-ready contact form, with custom javascript feature detection
www.toddmotto.com
*/
(function() {

	// Create input element for testing
	var inputs = document.createElement('input');
	
	// Create the supports object
	var supports = {};
	
	supports.autofocus   = 'autofocus' in inputs;
	supports.required    = 'required' in inputs;
	supports.placeholder = 'placeholder' in inputs;

	// Fallback for autofocus attribute
	if(!supports.autofocus) {
		
	}
	
	// Fallback for required attribute
	if(!supports.required) {
		
	}

	// Fallback for placeholder attribute
	if(!supports.placeholder) {
		
	}
	
	// Change text inside send button on submit
	var send = document.getElementById('contact-submit');
	if(send) {
		send.onclick = function () {
			this.innerHTML = '...Sending';
		}
	}

})();



function Solo_Numerico(variable){
    Numer=parseInt(variable);
    if (isNaN(Numer)){
       return "";
       }
       return Numer;
    }
    function ValNumero(Control){
      Control.value=Solo_Numerico(Control.value);
    }
	
	
	function tab(ev,obj) {
var keyCode = document.layers ? ev.which : document.all ? event.keyCode : document.getElementById ? ev.keyCode : 0;
if (keyCode !=13) return;
frm = obj.form;
for(i = 0; i < frm.elements.length; i++) 
if (frm.elements[i] == obj) { 
if (i == frm.elements.length-1) i =-1;
break 
}
frm.elements[i+1].focus();
return false;
}
function decimal(evt) {
var keyPressed = (evt.which) ? evt.which : event.keyCode
return !((keyPressed !=13) && (keyPressed != 46) && (keyPressed < 48 || keyPressed > 57));



}

function validar_tipo_doc(){
	
		var factura = document.getElementById("tip_per").value;
	
		if (factura==2)
		{
			document.getElementById("rsocial").innerHTML = "R. SOCIAL :";
			document.getElementById("ruc").innerHTML = "RUC :";
		}
		else
		{
			document.getElementById("rsocial").innerHTML = "NOMBRES:";
			document.getElementById("ruc").innerHTML = "DNI:";
		}
	}
