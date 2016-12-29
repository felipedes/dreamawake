<?php 

// datos para la conexión
$server = "localhost";
$usuario = "root";
$password = "";
$bd = "ida_form";

//abrimos conexión
$conexion = new mysqli($server,$usuario,$password,$bd);

//chequeamos conexión
if($conexion->connect_error) {
	die("Error en la conexión :" . $conexion->connect_error);
}

?>