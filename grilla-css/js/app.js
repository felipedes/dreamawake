var App = {

	init: function() {

		var alerta = $('.alert-desc'),
			btnok = $('.ok');

		btnok.on('click', function(){
			alerta.fadeOut('slow/400/fast', function() {
				alerta.remove();
			});
		});

	}
};

App.init();