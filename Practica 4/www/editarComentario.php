<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
require_once "bd_files/comentarios.php" ;

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd_files/users.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      $id_evento = $_POST['id_evento'];
      $id_comentario = $_POST['id_comentario'];
      $comentario = $_POST['comentario'] . "*Mensaje editado por un Moderador*";
      modifyComentario($idEv,$idCom,$contenido);
      header("Location: panelComentarios.php");
  }

//Miramos el tipo de usuario
  session_start();
    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']);
      $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
    }
    else $usuario = "Empty";

//Comprobamos si no es superusuario, moderador o gestor
    if(!($usuario['rol']==2 or $usuario['rol']==4) and isset($_GET['evento']) and isset($_GET['comentario'])) header("Location: index.php");

    $comentario = getComentarioConcreto($_GET['evento'],$_GET['comentario']);
    $comentario['id_evento'] = $_GET['evento'];
    $comentario['id_comentario'] = $_GET['comm'];

  echo $twig->render('editarComentario.html', ['user' => $usuario, 'comentario' => $comentario]);
?>
