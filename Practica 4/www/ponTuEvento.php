<?php
session_start();
require_once "/usr/local/lib/php/vendor/autoload.php";
require_once 'bd_files/users.php';
require_once "bd_files/eventos.php";
require_once "bd_files/etiquetas.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);


//Se comprueba el rol del usuario
    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']);
      $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
    }
    else $usuario = "Empty";

//Se comprueba que sea superusuario, administrador o gestor.
    if($usuario['rol']!=4 and $usuario['rol']!=3) header("Location: index.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $errors= array();

        if(isset($_FILES['img'])){
            $archivoimg = addImagenRuta($_FILES['img']);
        }
            $colornom=$_POST['colornom'];
            $nombre=$_POST['nombre'];
            $intro=$_POST['intro'];
            $personalidad=$_POST['personalidad'];
            $mote=$_POST['mote'];
            $color=$_POST['color'];
            $imgarma=$_POST['imgarma'];
            $arma=$_POST['arma'];
            $imgelem=$_POST['imgelem'];
            $elemento=$_POST['elemento'];
            $sexo=$_POST['sexo'];
            $cumpleaños=$_POST['cumpleaños'];
            $constelacion=$_POST['constelacion'];
            $nacion=$_POST['nacion'];
            $consigue=$_POST['consigue'];
            $fecha=$_POST['fecha'];
            
            
           

            if ($archivoimg != false) {$img = $archivoimg;}
            
            $gestor= $user['nick'];

            $id = addEvento($colornom,$nombre,$intro,$personalidad,$mote,$color,$imgarma,$arma,$imgelem,$elemento,$sexo,$cumpleaños,$constelacion,$nacion,$consigue,$fecha,$img,$gestor);
            $etiquetas = explode(' ',$_POST['etiquetas']) ;
            addEtiquetas($id,$etiquetas);

            /*if(empty($errors)){
                header("Location:index.php");
            }*/
    
      }



  echo $twig->render('ponTuEvento.html', ['user' => $usuario, 'errores'=> $errors]);
?>
