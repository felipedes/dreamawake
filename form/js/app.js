var App = {

	validaciones: function(){

		//variables inputs
		var txt_nombre = $('#txt_nombre'),
			txt_rut = $('#txt_rut'),
			txt_email = $('#txt_email'),
			btn_send = $('#btn_send');

		//variables booleanas para validar el form
		var nom_ok = false,
			rut_ok = false,
			ema_ok = false,
			rad_ok = false;

		//plugin para validar rut
		var rut_val = txt_rut.rut({ formatOn: 'keyup' });

		//formato email para validar
		var val_email = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

		$("#txt_rut")
		.rut()
		.on('rutInvalido', function(){ 
			gabo = 0;
		})
		.on('rutValido', function(){ 
			gabo = 1;
		});

		//validar campo rut numerico
	    txt_rut.keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A
	            (e.keyCode == 65 && e.ctrlKey === true) ||
	             // Allow: Ctrl+C
	            (e.keyCode == 67 && e.ctrlKey === true) ||
	             // Allow: Ctrl+X
	            (e.keyCode == 88 && e.ctrlKey === true) ||
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 75 || e.keyCode > 75) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });


		//función al presionar el btn enviar, gatilla el validador
		btn_send.on('click', function() {

			if (txt_nombre.val() !="") {
				nom_ok = true;
			} else {
				txt_nombre.css('background-color', 'rgba(255, 36, 36, 0.5)');
			}

			if (txt_rut.val() !="" && gabo == 1) {			
				rut_ok = true;
			} else {
				txt_rut.css('background-color', 'rgba(255, 36, 36, 0.5)');
			}

			if (txt_email.val() !="" && txt_email.val().match(val_email)) {				
				ema_ok = true;
			} else {
				txt_email.css('background-color', 'rgba(255, 36, 36, 0.5)');
			}

			if(!$('#rad_si:checked').length == 1 || $('#rad_no:checked').length == 1 ) {
				alert("No acepta las condiciones")			
			} else {
				rad_ok = true;
			}	

			if (nom_ok == true && rut_ok == true && ema_ok == true && rad_ok == true) {

                $.ajax({
                     url: 'bin/miarchivo.php',
                     data: {
                         name: txt_nombre.val(),
                         rut: txt_rut.val(),
                         ema: txt_email.val(),
                         rad: $('#rad_si').val()
                     },
                     type: 'post',
                     dataType: 'json',
                 });

                alert("Datos enviados por AJAX \n" + txt_nombre.val() + "\n" + txt_rut.val() + "\n" + txt_email.val() + "\n y acepta nuestras condiciones de uso");
			
			}

		});

		//Limpia los inputs (errores)
		txt_nombre.focus(function(){ txt_nombre.css('background-color', 'rgba(0,0,0,0.5)'); });			
		txt_rut.focus(function(){ txt_rut.css('background-color', 'rgba(0,0,0,0.5)'); });	
		txt_email.focus(function(){ txt_email.css('background-color', 'rgba(0,0,0,0.5)'); });

		//alert("hola ctm");

	}

};

//ejecutamos la Aplicación
App.validaciones();