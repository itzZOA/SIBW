<?php
    require_once 'bd_files/users.php';
    
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    if (registrar($nick, $email, $password)) {
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
