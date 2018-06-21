// Toggle Function
$('.toggle').click(function(){
  // Switches the Icon
  $(this).children('i').toggleClass('fa-pencil');
  // Switches the forms  
  $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
  }, "slow");
});

function validar(){

		var imagen = document.getElementById("imagen").value;
		var aleatorio = document.getElementById("aleatorio").value;
				
		if(imagen== aleatorio){
			window.open("http://www.google.com.pe");
		}else{
			alert("El codigo Ingresado no coincide");
		}
	}

	