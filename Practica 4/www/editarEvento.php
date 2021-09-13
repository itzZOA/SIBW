<?php
session_start();
require_once "/usr/local/lib/php/vendor/autoload.php";
require_once "bd_files/eventos.php" ;
require_once "bd_files/imagenes.php" ;
require_once "bd_files/etiquetas.php" ;

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd_files/users.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      $idEv = $_GET['evento'];
      $colornom = $_POST['colornom'];
      $nombre = $_POST['nombre'];
      $intro = $_POST['intro'];
      $personalidad = $_POST['personaliad'];
      $mote = $_POST['mote'];
      $color= $_POST['color']; 
      $imgarma = $_POST['immgarma'];
      $arma = $_POST['arma'];
      $imgelem = $_POST['imgelem'];
      $elemento = $_POST['elemento'];
      $sexo = $_POST['sexo'];
      $cumpleaños = $_POST['cumpleaños'];
      $constelacion = $_POST['constelacion'];
      $nacion = $_POST['nacion'];
      $fecha = $_POST['fecha'];
     if(($_FILES['img']['error']) == 0) $img = addImagenRuta($_FILES['img']);
      modificarEvento($idEv,$colornom,$nombre,$intro,$personalidad,$mote,$color,$imgarma,$arma,$imgelem,$elemento,$sexo,$cumpleaños,$constelacion,$nacion,$consigue,$fecha);
      deleteEtiquetas($idEv);
      addEtiquetas($idEv,explode(' ',$_POST['etiquetas']));
      header("Location: evento.php?ev=$idEv");
  }

//Miramos el tipo de usuario

    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']);
      $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
    }
    else $usuario = "Empty";

//Si no es un superusuario, gestor o moderador no pasa
    if(!($usuario['rol']==3 or $usuario['rol']==4 and isset($_GET['evento']))) header("Location:index.php");

    $evento = getEvento($_GET['evento']);
    $etiquetas = getEtiquetas($evento['id']);

  echo $twig->render('editarEvento.html', ['user' => $usuario, 'evento' => $evento, 'etiquetas' => $etiquetas]);
?>
