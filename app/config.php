<?php 

// Local
// $server = "localhost";
// $usuario = "root";
// $password = "";
// $bd = "mibase";

// Producción
$server = "localhost";
$usuario = "user";
$password = "pass";
$bd = "mibasehost";

//abrimos conexión
$conexion = new mysqli($server,$usuario,$password,$bd);

// NO afectará a $mysqli->real_escape_string();
$conexion->query("SET NAMES utf8");

//chequeamos conexión
if($conexion->connect_error) {
	die("Error en la conexión :" . $conexion->connect_error);
}

?>
