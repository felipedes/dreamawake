<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// archivo de configuración
include("config.php");

// datos recibidos por ajax
//datos form lado
$name = $_POST["name"];
$email = $_POST["email"];
$tele = $_POST["tele"];
$rut = $_POST["rut"];
$sede = $_POST["sede"];
$supo = $_POST["supo"];
$comment = $_POST["comment"];

// variable para correo
$mail_destino = $_POST["mail_destino"];

// variables booleanas para validar campos
$name_ok = false;
$email_ok = false;
$tele_ok = false;
$rut_ok = false;
$sede_ok = false;
$supo_ok = false;
$comment_ok = false;

// validamos campos si es que están vacíos
if($_POST) {

	if(empty($name)) {
		$name_ok = false;
	} else {
		$name_ok = true;
	}

	if(empty($email)) {
		$email_ok = false;
	} else {
		$email_ok = true;
	}

	if(empty($tele)) {
		$tele_ok = false;
	} else {
		$tele_ok = true;
	}

	if(empty($rut)) {
		$rut_ok = false;
	} else {
		$rut_ok = true;
	}

	if(empty($sede)) {
		$sede_ok = false;
	} else {
		$sede_ok = true;
	}

	if(empty($supo)) {
		$supo_ok = false;
	} else {
		$supo_ok = true;
	}	

	if(empty($comment)) {
		$comment_ok = false;
	} else {
		$comment_ok = true;
	}

	// Para enviar un correo HTML, debe establecerse la cabecera Content-type
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	// Cabeceras adicionales
	$cabeceras .= 'To: Lead misitio.com <'.$mail_destino.'>,<email@test.cl>' . "\r\n";
	$cabeceras .= 'From: Notificación Lead de Página Web <email@test.cl>' . "\r\n";
	$cabeceras .= 'Cc: email@test.cl' . "\r\n";

	// Varios destinatarios
	// $para = 'email@test.clm';
	// $para  = '' . ', felipe.desarrollo30@gmail.com'; // atención a la coma
	$para .= 'email@test.cl';

	// título
	$titulo = 'Lead Tronwell.com';

	// mensaje
	$mensaje = '
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	  <title>Mensaje enviado Desde El sitio web</title>
	</head>
	<body>
	  <p>Información del cliente</p>
	  <table>
	  	<tr>
			<td>Nombre: '. $name .'</td>
	  	</tr>
	  	<tr>
			<td>Email: '. $email .'</td>
	  	</tr>
	  	<tr>
			<td>Teléfono: '. $tele .'</td>
	  	</tr>	  	
	  	<tr>
			<td>Rut: '. $rut .'</td>
	  	</tr>
	  	<tr>
			<td>Sede: '. $sede .'</td>
	  	</tr>
	  	<tr>
			<td>Como supo de nosotros: '. $supo .'</td>
	  	</tr>
	  	<tr>
			<td>Comentarios: '. $comment .'</td>
	  	</tr>
	  </table>
	</body>
	</html>
	';	


	if(name_ok == true && email_ok == true && tele_ok == true && sede_ok == true && comment_ok == true) {

		// consulta para insertar nuestros datos a la bd
		$sql = "INSERT INTO mitabla (nombre, email, telefono, rut, sede, supo, comentarios)
				VALUES ('$name','$email','$tele','$rut','$sede','$supo','$comment')";

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
