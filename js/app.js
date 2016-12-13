var App = {

	animaciones: function() {

		//scroll
        $('a[href^="#"]').on('click', function(event) {
            var target = $( $(this).attr('href') );
            if( target.length ) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 800);
            }
        });

        //loader 
        $(window).load(function(){
        	/* Act on the event */
        	$('body').css('overflow','hidden');
        	setTimeout(function(){
        		$('.cortina').fadeOut('slow/400/fast', function() {
		        	$('body').css('overflow','auto');        			
        			$('.cortina').remove();
        		});
        	}, 3000);

        });

		// Animacion para abrir formulario
		$('.btn-abrir-form').on('click', function(){
			$('.full-caja-contact').fadeOut('slow/400/fast', function() {
				$('#formulario').fadeIn('slow/400/fast', function() {
					//código extra
				    $('html,body').animate({
				        scrollTop: $('section#contacto').position().top
				    }, 800);
				});	
			});		
		});
		$('.close-form').on('click', function(){
			$('#formulario').fadeOut('slow/400/fast', function() {
				$('.full-caja-contact').fadeIn('slow/400/fast', function() {
					//código extra
				}); 
			});	
		});

		$('#close-errors').on('click', function(){
			$('#errores').fadeOut('slow/400/fast', function(){
				$('body').css('overflow','auto');
				$('.text-error').remove();
				$('.text-ok').remove();
			});		
		});

	},

	validaciones: function() {

		$('#enviar_form').on('click', function(){

			var name_ok = false,
				email_ok = false,
				mensaje_ok = false;

			var name = $('#name_txt'),
				email = $('#email_txt'),
				mensaje = $('#mensaje_txt');

			var mailformato = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

			//validaciones

			if (name.val()!="" && name.val().length > 10) {
				name_ok = true;
			} else {
				$('#errores').fadeIn('slow/400/fast', function(){
					$('body').css('overflow','hidden');
					$('.cont-shot-men').append('<p class="text-error">Nombre</p>');
				});
			}

			if (email.val()!="" && email.val().length > 10 && email.val().match(mailformato)) {
				email_ok = true;
			} else {
				$('#errores').fadeIn('slow/400/fast', function(){
					$('body').css('overflow','hidden');
					$('.cont-shot-men').append('<p class="text-error">Email</p>');
				});
			}

			if (mensaje.val()!="" && mensaje.val().length > 20) {
				mensaje_ok = true;
			} else {
				$('#errores').fadeIn('slow/400/fast', function(){
					$('body').css('overflow','hidden');
					$('.cont-shot-men').append('<p class="text-error">Mensaje</p>');
				});
			}

			if (name_ok == true && email_ok == true && mensaje_ok == true) {

                $.ajax({
                     url: 'bin/enviar.php',
                     data: {
                         name: name.val(),
                         apep: email.val(),
                         apem: mensaje.val(),
                     },
                     type: 'post',
                     dataType: 'json',
                 });

				$('#errores').fadeIn('slow/400/fast', function(){
					$('.titulo-errors').html("Mensaje enviado con éxito");
					$('.cont-shot-men').append('<p class="text-ok">Gracias  :) </p>');
				});				
			
			}
			

		});

	}

};

App.animaciones();
App.validaciones();