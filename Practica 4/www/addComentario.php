<?php
include_once("bd_files/comentarios.php");
include_once("bd_files/users.php");

session_start();
if (isset($_SESSION['nickUsuario'])){
    $user = getUser($_SESSION['nickUsuario']);
    $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
}

if(isset($_POST['comentario'])){
    addComentario($_POST['id_evento'],$user['nick'],date("Y-m-d"),date("h:i"),$_POST['comentario']);
    header("Location: evento.php?ev=" . $_POST['id_evento']);
}
else echo "Fallo";

?>
