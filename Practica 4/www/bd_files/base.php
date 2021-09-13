<?php
//Funcion para conectar y que no se haga en cada funcion de las anteriores
    function Conectar(){
    $mysqli = new mysqli("mysql", "claudia", "03C02SM", "SIBW");
		if($mysqli->connect_errno){
			die("Fallo al conectar: " . $mysqli->connect_error);
		}
	return $mysqli;
    }
?>
