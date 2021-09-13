<?php
	require_once "/usr/local/lib/php/vendor/autoload.php";
	include_once('bd_files/eventos.php');
    	include_once('bd_files/imagenes.php');
	
	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig = new \Twig\Environment($loader);
	
	if(isset($_GET[ 'ev' ])){
		$idEv = $_GET[ 'ev' ];
	}else {
		$idEv = -1; 
	}
	
	$evento = getEvento($idEv);
	$imagenes = getImagenes($idEv);
	
	echo $twig->render('plantilla_imprimir.html',['evento' =>$evento,'imagenes' => $imagenes]);
?>
