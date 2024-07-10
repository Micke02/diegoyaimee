<?php
	$servidor="localhost";
	$usuario="root";
	$password="";
	$bd="id20950289_violeta";

	$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
	mysqli_set_charset($conexion, "utf8mb4");
	return $conexion;
 ?>