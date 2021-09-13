<?php

//Funcion que devuelve una lista de imagenes de un evento
    function getImagenes($idEv){
        $mysqli = Conectar();

        seguridad($idEv) ;

        $res = $mysqli->query("Select id_evento,id_img,ruta From imagenes Where id_evento=" . $idEv) ;

        
        $imagenes = array() ;

        while($row = $res->fetch_assoc()){
            $imagen = array('id_evento' => $row['id_evento'], 'id_img' => $row['id_img'], 'ruta' => $row['ruta']) ;
            array_push($imagenes,$imagen) ;
        }

        return $imagenes ;
    }

//Funcion que acepta y añade la imagen a la carpeta donde se localizan las imagenes
    function addImagenRuta($imagen){
        $file_name = $imagen['name'];
        $file_size = $imagen['size'];
        $file_tmp = $imagen['tmp_name'];
        $file_type = $imagen['type'];
        $file_ext = strtolower(end(explode('.',$imagen['name'])));
                
        $extensions= array("jpeg","jpg","png");
                
        if (in_array($file_ext,$extensions) === false){
            $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
        }
                
        if ($file_size > 2097152){
            $errors[] = 'Tamaño del fichero demasiado grande';
        }
        
       //move_uploaded_file($file_tmp,"img/$file_name");
                  
        if (!empty($errors)) return false;
        else return ("img/$file_name") ;
    }

//Funcion que añade la imagen a la base de datos
    function addImagen($ruta, $id_evento){
     	$mysqli = Conectar();
        
        $mysqli->query("Insert into imagenes values ('$id_evento','$ruta')");       
    }

//Funcion para coger el id de la imagen de un evento
    function getIdImagen($idEv){
        $mysqli = Conectar();
        $res = $mysqli->query("Select id_img from imagenes Where id_evento='$idEv'");
        $id = 0;
    
        if ($res->num_rows > 0) {
            // output data of each row
            while($row = $res->fetch_assoc()) {
                //echo "id: " . $row["id_img"];
                $id = $row["id_img"];
            }
        }  

        if ($id == 0){
            $id = 1;
        }
        else{
            $id = $id + 1;
        }

        return $id;

    }
    
?>
