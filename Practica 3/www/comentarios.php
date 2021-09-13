<?php
    function getComentarios($idEv){
    	$mysqli = new mysqli("mysql", "claudia", "03C02SM", "SIBW");
		if($mysqli->connect_errno){
			echo ("Fallo al conectar: " . $mysqli->connect_error);
		}
	
	(int)$mysqli->real_escape_string($_POST['idEv']);
        $res = $mysqli->query("Select nombre, fecha, hora, comentario From comentarios Where idevento=" . $idEv) ;

        $comentario = array('nombre' => "anonimo", 'comentario' => 'texto vacio') ;
        $comentarios = array() ;

        if ($res->num_rows > 0){
		$row = $res->fetch_assoc();
            $comentario = array('nombre' => $row['nombre'], 'fecha' => $row['fecha'], 'hora' => $row['hora'],
                            'comentario' => $row['comentario']) ;
            array_push($comentarios,$comentario) ;
        }

        return $comentarios ;
    }
?>

