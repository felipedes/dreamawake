<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// archivo de configuración
include("config.php");

// dats recibidos por ajax
$name = $_POST["name"];
$rut = $_POST["rut"];
$tele = $_POST["tele"];
$email = $_POST["email"];
$mens = $_POST["mens"];
$file = $_POST["file"];

// variables booleanas para validar campos
$name_ok = false;
$rut_ok = false;
$tele_ok = false;
$email_ok = false;
$mens_ok = false;
$file_ok = false;

// validamos campos si es que están vacíos
if($_POST) {

	if(empty($name)) {
		$name_ok = false;
	} else {
		$name_ok = true;
	}

	if(empty($rut)) {
		$rut_ok = false;
	} else {
		$rut_ok = true;
	}

	if(empty($tele)) {
		$tele_ok = false;
	} else {
		$tele_ok = true;
	}

	if(empty($email)) {
		$email_ok = false;
	} else {
		$email_ok = true;
	}

	if(empty($mens)) {
		$mens_ok = false;
	} else {
		$mens_ok = true;
	}

	if(empty($file)) {
		$file_ok = false;
	} else {
		$file_ok = true;
		move_uploaded_file($file, 'archivos/');
	}

    // if ( 0 < $_FILES['file']['error'] ) {
    //     echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    //     $file_ok = false;
    // } else { 
    //     move_uploaded_file($_FILES['file']['tmp_name'], 'archivos/' . $_FILES['file']['name']);
    //     $file_ok = true;
    // }

	// Para enviar un correo HTML, debe establecerse la cabecera Content-type
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Cabeceras adicionales
	$cabeceras .= 'To: Juanito Perez <cabecera@misitio.cl>,' . "\r\n";
	$cabeceras .= 'From: Trabajar en <trabajos@misitio.cl>' . "\r\n";
	$cabeceras .= 'Cc: admin@seguridadmaxima.cl' . "\r\n";

	// Varios destinatarios
	$para  = 'trabajos@misitio.cl' . ', jefatura@misitio.cl'; // atención a la coma
	// $para .= 'felipe.desarrollo30@gmail.com';

	// título
	$titulo = 'Mensaje de Cliente';

	// mensaje
	$mensaje = '
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	  <title>Mensaje enviado desde el sitio</title>
	</head>
	<body>
	  <p>¡Información del cliente</p>
	  <table>
	  	<tr>
			<td>Nombre:'. $name .'</td>
	  	</tr>
	  	<tr>
			<td>El rut es:'. $rut .'</td>
	  	</tr>
	  	<tr>
			<td>El teléfono es:'. $tele .'</td>
	  	</tr>
	  	<tr>
			<td>Email:'. $email .'</td>
	  	</tr>
	  	<tr>
			<td>Su mensaje es:'. $mess .'</td>
	  	</tr>
	  	<tr>
			<td>La ruta del archivo es:'. $file .'</td>
	  	</tr>
	  </table>
	</body>
	</html>
	';

	if(name_ok == true && rut_ok == true && tele_ok == true && email_ok == true && mens_ok == true && file_ok == true) {

		// consulta para insertar nuestros datos a la bd
		$sql = "INSERT INTO clientes (nombre, rut, telefono, email, mensaje, ruta_file)
				VALUES ('$name','$rut','$tele','$email','$mens','$file')";

		// chequeamos que la consulta este bien ingresada
		if($conexion->query($sql) === TRUE) {
			echo "Nuevo registro ingresado correctamente";
		} else {
			echo "Error en la consulta " . $sql . $conexion->error();
		}

		// envío del correo con los datos
		mail($para,$titulo,$mensaje,$cabeceras);

	} else {
		echo "Campos vacíos " . $conexion->connect_error;
	}

} else {
	echo "Campos vacíos " . $conexion->connect_error;
}
header("Location: ../");
sleep(1);
exit();

//cerrar siempre conexión
$conexion->close();

?>