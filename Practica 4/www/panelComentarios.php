<?php
session_start();
require_once "/usr/local/lib/php/vendor/autoload.php";
require_once "bd_files/comentarios.php" ;

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd_files/users.php';


    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']);
      $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
    }
    else $usuario = "Empty";

    if(!($usuario['rol']==2 or $usuario['rol']==4)) header("Location: index.php");

    $listaComentarios = getListaComentarios();

  echo $twig->render('panelComentarios.html', ['user' => $usuario, 'comentarios' => $listaComentarios]);
?>
