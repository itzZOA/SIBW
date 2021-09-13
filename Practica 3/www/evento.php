<?php
	require_once "/usr/local/lib/php/vendor/autoload.php";
	include("bd.php");
	include("comentarios.php");
	
	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig = new \Twig\Environment($loader);
	
	if(isset($_GET[ 'ev' ])){
		$idEv = $_GET[ 'ev' ];
	}else {
		$idEv = -1; 
	}
	
	$evento = getEvento($idEv);
	$comentarios = getComentarios($idEv);
	
	echo $twig->render('venti.html',['evento' =>$evento, 'comentarios' => $comentarios, 'ncomentarios' =>sizeof($comentarios)]);
?>
