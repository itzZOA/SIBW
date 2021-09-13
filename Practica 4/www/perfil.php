<?php
  require_once 'bd_files/users.php';
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  


  $errors = "Empty";

   session_start();

//Coge al usuario
   if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']); 
      $nickAntiguo = $_SESSION['nickUsuario'];
    }

//Modifica los datos de usuario que este desea cambiar
    modifyUser($nickAntiguo,$_POST['nick'],$_POST['email']);
    if (!empty($_POST['oldPass'])){

      if ($_SESSION['nickUsuario'] == $_POST['nick'] || empty($_POST['nick'])) 
        $accNick = $_SESSION['nickUsuario'];
      else 
        $accNick = $_POST['nick'] ;

      $errors = modifyPass($accNick,$_POST['oldPass'],$user['password'],$_POST['newPass'],$_POST['repeatPass']);
    }
    $_SESSION['nickUsuario'] = $_POST['nick'];
   }

//Saca los datos de usuario
    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']);
      $usuario = array('nick' => $user['nick'], 'rol' => $user['rol'], 'email' => $user['email'], 'hash' => $user['password']) ;
    }
    else $usuario = "Empty";

    if($usuario == "Empty") header("Location: index.php");

    

  echo $twig->render('perfil.html', ['user' => $usuario, 'errors' => $errors]);
?>
