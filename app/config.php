<?php 

// Local
// $server = "localhost";
// $usuario = "root";
// $password = "";
// $bd = "tronwell";

// Producción
$server = "localhost";
$usuario = "tronwell_2017";
$password = "tronwell2017@";
$bd = "tronwell_2017";

//abrimos conexión
$conexion = new mysqli($server,$usuario,$password,$bd);

// NO afectará a $mysqli->real_escape_string();
$conexion->query("SET NAMES utf8");

//chequeamos conexión
if($conexion->connect_error) {
	die("Error en la conexión :" . $conexion->connect_error);
}

?>