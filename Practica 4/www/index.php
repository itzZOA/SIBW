<?php
	session_start();
	include_once ('bd_files/eventos.php');
	require_once ('bd_files/users.php');
	
	
	if (isset($_SESSION['nickUsuario'])){
		$user = getUser($_SESSION['nickUsuario']);
		$usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
	}
	else 
		$usuario = "Empty";

	require_once "/usr/local/lib/php/vendor/autoload.php";
	
	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig = new \Twig\Environment($loader);
	
	$eventos = getLista();
	
	
	echo $twig->render('portada.html',['user'=> $usuario,'eventos' =>$eventos]);
?>
