<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bd_files/users.php';

  $error = 0;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $password = $_POST['password'];
  
    if (comprobarUsuario($nick, $password)) {
      session_start();
      
      $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
    }
    
    if(isset($_SESSION['nickUsuario']))
        header("Location: index.php");
    else 
        $error = 1 ;
  }
  
  echo $twig->render('login.html', ['error' => $error, 'user' => "Empty"]);
?>
