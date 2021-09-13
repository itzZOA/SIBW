<?php
include_once("base.php");
include_once("seguridad.php");

//Funcion que muestra las etiquetas de un evento
function getEtiquetas($idEv){
    $mysqli = Conectar();
    $etiquetas = array();

    $res=$mysqli->query("Select des From etiquetas Where id_evento='$idEv'");
    while($row = $res->fetch_assoc()){
        array_push($etiquetas,$row['des']);
    }
    $lista_etiquetas = implode(' ',$etiquetas);
    return $lista_etiquetas;
}

//Funcion que añade etiquetas a un determinado evento
function addEtiquetas($idEv,$etiquetas){
    $mysqli = Conectar();
    foreach($etiquetas as $etiqueta){
        $mysqli->query("INSERT into etiquetas (id_evento, des) Values ('$idEv','$etiqueta')");
    }
}

//Funcion que elimina una etiqueta de un Evento
function deleteEtiquetas($idEv){
    $mysqli = Conectar();
    $mysqli->query("Delete From etiquetas Where idEv='$idEv'");
}
?>
