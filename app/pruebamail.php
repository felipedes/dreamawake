<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$name_home = "Felipe";
$email_home = "felipe.farias@gmail.cl";
$tele_home = "+569-42132914";
$rut_home = "18356477-3";
$sede_home = "Santiago-Centro";
$supo_home = "Redes Sociales";
$comment_home = "Esto es un pequeño comentario";


// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Cabeceras adicionales
// $cabeceras .= 'To: Lead Tronwell.com <felipe.farias@elliving.cl>,<puentealto@tronwell.com>' . "\r\n";
$cabeceras .= 'From: Notificación Lead de Página Web <www.tronwell.com>' . "\r\n";
// $cabeceras .= 'Cc: puentealto@tronwell.com' . "\r\n";

// Varios destinatarios
// $para = 'mkting.uniacc@gmail.com';
// $para  = '' . ', felipe.desarrollo30@gmail.com'; // atención a la coma
$para .= 'puentealto@tronwell.com,felipe.farias@elliving.cl';

// título
$titulo = 'Lead Tronwell.com';

$mensaje = "Hola esto es un mensaje";

// mensaje
// $mensaje = '
// <html xmlns="http://www.w3.org/1999/xhtml">
// <head>
// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
//   <title>Mensaje enviado Desde El sitio de Tronwell</title>
// </head>
// <body>
//   <p>Información del cliente</p>
//   <table>
//   	<tr>
// 		<td>Nombre: '. $name_home .'</td>
//   	</tr>
//   	<tr>
// 		<td>Email: '. $email_home .'</td>
//   	</tr>
//   	<tr>
// 		<td>Teléfono: '. $tele_home .'</td>
//   	</tr>	  	
//   	<tr>
// 		<td>Rut: '. $rut_home .'</td>
//   	</tr>
//   	<tr>
// 		<td>Sede: '. $sede_home .'</td>
//   	</tr>
//   	<tr>
// 		<td>Como supo de nosotros: '. $supo_home .'</td>
//   	</tr>
//   	<tr>
// 		<td>Comentarios: '. $comment_home .'</td>
//   	</tr>
//   </table>
// </body>
// </html>
// ';	

if(mail($para,$titulo,$mensaje,$cabeceras)) {
	echo "Email enviado correctamente";
} else {
	echo "Correo no enviado";	
}

?>
