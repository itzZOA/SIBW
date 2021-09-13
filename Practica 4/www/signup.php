<?php
    require_once 'database/bd_usuarios.php';
    
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
  
    if (registrar($nick, $email, $pass)) {
      session_start();
      
      $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha registrado
    }
    
    header("Location: index.php");
    
    exit();
  }

/*Carga de Twig*/ 
require_once "/usr/local/lib/php/vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('registro.html', ['user' => "Empty"]);
?>