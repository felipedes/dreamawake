var App = {

	validaciones: function() {

		//variables inputs
		var name = $("#name"),
			rut = $("#rut"),
			tele = $("#tele"),
			email = $("#email"),
			mens = $("#mens"),
			file = $("#file");

		//variables booleanas para validar el form
		var name_ok = false,
			rut_ok = false,
			tele_ok = false,
			email_ok = false,
			mens_ok = false,
			file_ok = false;

		//plugin para validar rut
		var rut_val = rut.rut({ formatOn: 'keyup' });

		//formato email para validar
		var val_email = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

		//variable con estado true o false que valida rut 
		rut
		.rut()
		.on('rutInvalido', function(){ 
			gabo = 0;
		})
		.on('rutValido', function(){ 
			gabo = 1;
		});

		//validar campo rut numerico
		var rut_tele = $("#rut,#tele");
	    rut_tele.keydown(function (e) {
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

	    //validar solo textos
	    name.keypress(function(event){
	        var soloTexto = event.charCode;
	        if(!(soloTexto >= 65 && soloTexto <= 120) && (soloTexto != 32 && soloTexto != 0)){
	            event.preventDefault();
	        }
	    });

	    $("#enviar").on('click', function(){

	    	if (name.val() != "") {
	    		name_ok = true;
	    	} else {
	    		name.css('background-color', 'rgba(255, 36, 36, 0.5)');
	    	}

	    	if (rut.val() != "" && gabo == 1) {
	    		rut_ok = true;
	    	} else {
	    		rut.css('background-color', 'rgba(255, 36, 36, 0.5)');
	    	}

	    	if (tele.val() != "" && tele.val().length >= 9) {
	    		tele_ok = true;
	    	} else {
	    		tele.css('background-color', 'rgba(255, 36, 36, 0.5)');
	    	}

	    	if (email.val() != "" && email.val().match(val_email)) {
	    		email_ok = true;
	    	} else {
	    		email.css('background-color', 'rgba(255, 36, 36, 0.5)');
	    	}

	    	if (mens.val() != "") {
	    		mens_ok = true;
	    	} else {
	    		mens.css('background-color', 'rgba(255, 36, 36, 0.5)');
	    	}

	    	if (file.val() != "") {
	    		file_ok = true;
	    	} else {
	    		file.css('background-color', 'rgba(255, 36, 36, 0.5)');
	    	}

	    	if (name_ok == true && rut_ok == true && tele_ok == true && email_ok == true && mens_ok == true && file_ok == true ){

	    		// archivo
				var file_load = $("#file").prop('files')[0];
			    var file_data = new FormData();                  
			    	file_data.append('file', file_load); 

	            $.ajax({           	
                     url: 'back/enviar.php',
                     dataType: 'json',
					 mimeType: "multipart/form-data",                     
	                 cache: false,                 
                     data: {
                         name: name.val(),
                         rut: rut.val(),
                         tele: tele.val(),
                         email: email.val(),
                         mens: mens.val(),
                         file: file.val()
                         //file: file_data
                     },
					 type: 'POST' 
                });

	    		alert("Mensaje enviado :)");
	    		window.location = "http://localhost/prueba_ida/back/enviar.php"

	    	} else {
	    		alert("Error en el mensaje");
	    	}

	    });

		name.focus(function(){ name.css('background-color', '#fff'); });			
		rut.focus(function(){ rut.css('background-color', '#fff'); });	
		tele.focus(function(){ tele.css('background-color', '#fff'); });
		email.focus(function(){ email.css('background-color', '#fff'); });
		mens.focus(function(){ mens.css('background-color', '#fff'); });
		file.focus(function(){ file.css('background-color', '#fff'); });

	}

};

App.validaciones();