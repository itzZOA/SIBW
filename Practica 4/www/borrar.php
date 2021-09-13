<?php
include_once("bd_files/users.php");
include_once("bd_files/eventos.php");
include_once("bd_files/comentarios.php");

//Tenemos que saber que tipo deusuario es
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
if($_POST['registro'] == "Eventos2"){
    deleteEvento($_POST['idEv']);
    header("Location: index.php");
}
if($_POST['registro'] == "Comentarios"){
    deleteComentario($_POST['idEv'],$_POST['idCom']);
    header("Location: panelComentarios.php");
}
if($_POST['registro'] == "Comentarios2"){
    deleteComentario($_POST['idEv'],$_POST['idCom']);
    header("Location: evento.php?ev=" . $_POST['idEv']);
}
?>
