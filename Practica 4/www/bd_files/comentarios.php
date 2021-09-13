<?php
    include_once("base.php");
    include_once("seguridad.php");
    include_once("eventos.php");
    
//Sacar los comentarios de un evento
function getComentarios($idEv){
        $mysqli = Conectar();

        seguridad($idEv) ;
        $res= $mysqli->query("Select id_comentario, nick, fecha, hora, comentario From comentarios Where id_evento=$idEv") ;

        $comentario = array('Nick' => "Nadie", 'Comentario' => 'Error') ;
        $comentarios = array() ;

        while($row = $res->fetch_assoc()){
            $comentario = array('id_comentario' => $row['id_comentario'],'nick' => $row['nick'], 'fecha' => date('d-m-Y',strtotime($row['fecha'])), 'hora' => $row['hora'],
                            'comentario' => $row['comentario']) ;
            array_push($comentarios,$comentario) ;
        }

        return $comentarios ;
    }

//Funcion para añadir un comentario
function addComentario($id_evento,$nick,$fecha,$hora,$comentario){
        $mysqli = Conectar();
        seguridad($id_evento) ;
        $mysqli->query("Insert into comentarios Values('$id_evento','$nick','$fecha','$hora','$comentario')");
    }
    
//Coger un comentario especifico

function getComentario($id_evento,$id_comentario){
	$mysqli = Conectar();
        seguridad($id_evento) ;
        seguridad($id_comentario) ;
        $res = $mysqli->query("Select nick, fecha, hora, comentario From comentarios Where id_evento='$id_evento' and id_comentario='$id_comentario'") ;

        $comentario = $res->fetch_assoc() ;
        return $comentario ;
    }
 
 
//Da una lista con todos los comentarios ordenadas por el id de los Eventos
function getListaComentarios(){
        $mysqli = Conectar();

        $res = $mysqli->query("Select id_evento, id_comentario, nick, fecha, hora, comentario From comentarios Order By id_evento") ;
        $listaEventos = getLista();
        $eventos = array();
        
        for($i = 0 ; $i<count($listaEventos) ; $i++){
            $nombreEvento = $listaEventos[$i]['nick'];
            $eventos[$listaEventos[$i]['id_evento']] = $nombreEvento;
        }


        $comentarios = array() ;
        $contador = 0 ;
        
        while($row = $res->fetch_assoc()){
            $comentario = array('id_comentario' => $row['id_comentario'], 'id_evento' => $eventos[$row['id_evento']] ,'nick' => $row['nick'], 'fecha' => date('d-m-Y',strtotime($row['fecha'])), 'hora' => $row['hora'], 'comentario' => $row['comentario']) ;
            array_push($comentarios,$comentario) ;
            $contador = $contador + 1 ;
        }

        return $comentarios ;
    }

//Funcion para modificar un comentario
    function modifyComentario($id_evento,$id_comentario,$contenido){
        $mysqli = Conectar();
        strip_tags($contenido);
        $mysqli -> query("Update comentarios Set comentario='$contenido' Where id_evento=$id_evento and id_comentario=$id_comentario");
    }

//Funcion para eliminar un comentario
    function deleteComentario($id_evento,$id_comentario){
        $mysqli = Conectar();
        seguridad($id_evento);
        seguridad($id_comentario);
        $mysqli->query("Delete From comentarios Where id_evento='$id_evento' and id_comentario='$id_comentario'");
    }


?>
