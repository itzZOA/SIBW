<?php
	session_start();
	require_once "/usr/local/lib/php/vendor/autoload.php";
	include_once('bd_files/eventos.php');
	include_once('bd_files/imagenes.php');
	include_once('bd_files/palabras.php');
	include_once('bd_files/comentarios.php');
	include_once('bd_files/users.php');
	include_once('bd_files/etiquetas.php');
	
	//Comprobamos el usuario

	if (isset($_SESSION['nickUsuario'])){
		$user = getUser($_SESSION['nickUsuario']);
		$usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
	}
	else $usuario = "Empty";
	
	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig = new \Twig\Environment($loader);
	
	if(isset($_GET[ 'ev' ])){
		$idEv = $_GET[ 'ev' ];
	}else {
		$idEv = -1; 
	}
	
	$evento = getEvento($idEv);
	$comentarios = getComentarios($idEv);
	$imagenes = getImagenes($idEv);
	$palabras = getPalabras();
	$etiquetas = getEtiquetas($idEv);
	
	echo $twig->render('plantilla_evento.html',['evento' =>$evento,'comentarios' => $comentarios, 'imagenes' => $imagenes, 'palabras' => $palabras, 'etiquetas' => $etiquetas,'user' => $usuario]);
?>
