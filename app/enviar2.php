<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// archivo de configuración
include("config.php");

// datos recibidos por ajax

//datos form home
$name_home = $_POST["name_home"];
$email_home = $_POST["email_home"];
$tele_home = $_POST["tele_home"];
$rut_home = $_POST["rut_home"];
$sede_home = $_POST["sede_home"];
$supo_home = $_POST["supo_home"];
$comment_home = $_POST["comment_home"];

// variable para correo
$mail_destino = $_POST["mail_destino"];

// variables booleanas para validar campos home
$name_home_ok = false;
$email_home_ok = false;
$tele_home_ok = false;
$rut_home_ok = false;
$sede_home_ok = false;
$supo_home_ok = false;
$comment_home_ok = false;


// variable para correo
$mail_destinatario = $_POST[""];

// validamos campos si es que están vacíos
if($_POST) {

	if(empty($name_home)) {
		$name_home_ok = false;
	} else {
		$name_home_ok = true;
	}

	if(empty($email_home)) {
		$email_home_ok = false;
	} else {
		$email_home_ok = true;
	}

	if(empty($tele_home)) {
		$tele_home_ok = false;
	} else {
		$tele_home_ok = true;
	}

	if(empty($rut_home)) {
		$rut_home_ok = false;
	} else {
		$rut_home_ok = true;
	}

	if(empty($sede_home)) {
		$sede_home_ok = false;
	} else {
		$sede_home_ok = true;
	}

	if(empty($supo_home)) {
		$supo_home_ok = false;
	} else {
		$supo_home_ok = true;
	}	

		if(empty($comment_home)) {
		$comment_home_ok = false;
	} else {
		$comment_home_ok = true;
	}

	// Para enviar un correo HTML, debe establecerse la cabecera Content-type
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	// Cabeceras adicionales
	$cabeceras .= 'To: Lead Tronwell.com <'.$mail_destino.'>,<christian.hahn@tronwell.com>,<felipe.farias@elliving.cl>' . "\r\n";
	$cabeceras .= 'From: Notificación Lead de Página Web <marketing@tronwell.com>' . "\r\n";
	$cabeceras .= 'Cc: medios.tronwell@gmail.com,test@tronwell.com,marketing@tronwell.com,christian.hahn@tronwell.com' . "\r\n";

	// Varios destinatarios
	// $para = 'mkting.uniacc@gmail.com';
	// $para  = '' . ', felipe.desarrollo30@gmail.com'; // atención a la coma
	$para .= 'marketing@tronwell.com';

	// título
	$titulo = 'Lead Tronwell.com';

	// mensaje
	$mensaje = '
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	  <title>Mensaje enviado Desde El sitio de Tronwell</title>
	</head>
	<body>
	  <p>Información del cliente</p>
	  <table>
	  	<tr>
			<td>Nombre: '. $name_home .'</td>
	  	</tr>
	  	<tr>
			<td>Email: '. $email_home .'</td>
	  	</tr>
	  	<tr>
			<td>Teléfono: '. $tele_home .'</td>
	  	</tr>	  	
	  	<tr>
			<td>Rut: '. $rut_home .'</td>
	  	</tr>
	  	<tr>
			<td>Sede: '. $sede_home .'</td>
	  	</tr>
	  	<tr>
			<td>Como supo de nosotros: '. $supo_home .'</td>
	  	</tr>
	  	<tr>
			<td>Comentarios: '. $comment_home .'</td>
	  	</tr>
	  </table>
	</body>
	</html>
	';	


	if(name_ok == true && email_ok == true && tele_ok == true && sede_ok == true && comment_home_ok == true) {

		// consulta para insertar nuestros datos a la bd
		$sql = "INSERT INTO clientes_web (nombre, email, telefono, rut, sede, supo, comentarios)
				VALUES ('$name_home','$email_home','$tele_home','$rut_home','$sede_home','$supo_home','$comment_home')";

		// chequeamos que la consulta este bien ingresada
		if($conexion->query($sql) === TRUE) {
			mail($para,$titulo,$mensaje,$cabeceras);
			echo "Nuevo registro ingresado correctamente";
		} else {
			echo "Error en la consulta " . $sql . $conexion->error();
		}

	} else {
		echo "Campos vacíos " . $conexion->connect_error;
	}

} else {
	echo "Campos vacíos " . $conexion->connect_error;
}
//header("Location: ../");
sleep(1);
exit();

//cerrar siempre conexión
$conexion->close();

?>