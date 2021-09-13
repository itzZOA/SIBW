<?php
include_once("bd_files/imagenes.php");
include_once("bd_files/users.php");
include_once("bd_files/eventos.php");
require_once "/usr/local/lib/php/vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
session_start();

if (isset($_SESSION['nickUsuario'])){
    $user = getUser($_SESSION['nickUsuario']);
    $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
}

$desprendible = $_FILES["desprendible"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_evento = $_POST['idEv'];

    if ($_FILES['imgsubir']['name'] != null) {
        $ruta = addImagenRuta($_FILES['fotosubir']);
        $id_img = getIdImagen($idEv);
        // echo "\n $ruta, $id_evento, $id_img \n";
        addImagen($ruta, $id_evento, $id_img);
    }

}

header("Location: panelGestionEventos.php");

?>
