<?php
include_once("bd_files/users.php");
include_once("bd_files/eventos.php");
include_once("bd_files/comentarios.php");

//Que rol tiene el usuario
session_start();
    if (isset($_SESSION['nickUsuario'])){
      $user = getUser($_SESSION['nickUsuario']);
      $usuario = array('nick' => $user['nick'], 'rol' => $user['rol']) ;
    }
    
//Si no eres gestor, moderador o SuperUsuario no pasas
if($usuario['rol'] != 3 and $usuario['rol'] != 2 and $usuario['Rol'] != 4) header("Location: index.php");

if($_POST['registro'] == "Eventos"){
    deleteEvento($_POST['idEv']);
    header("Location: panelGestionEventos.php");
}
if($_POST['registro'] == "Comentarios"){
    deleteComentario($_POST['id_evento'],$_POST['id_comentario']);
    header("Location: panelComentarios.php");
}
?>
