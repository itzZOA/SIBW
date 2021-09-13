<?php
    include_once("base.php");
    include_once("seguridad.php");
    include_once("etiquetas.php");
    include_once("imagenes.php");
    
//Funcion para crear la base de datos de eventos y sacar su contenido
function getEvento($idEv){
	$mysqli = Conectar();
	seguridad($idEv) ;
		
	$res = $mysqli->query("SELECT colornom, nombre, intro, personalidad, mote,color, imgarma, arma, imgelem, elemento, sexo, cumpleaños, constelacion, 		nacion, consigue, fecha FROM  eventos WHERE id='$idEv'");
		
	$evento = array('colornom'=> '#29FFC6', 'nombre' => 'AAA', 'intro' => 'BBB','personalidad' => 'CCC', 'mote' => 'DDD', 'color' => '#BEFFED', 'imgarma' => 'img/arcoicon.png', 'arma' => 'EEE', 'imgelem' => 'img/anemo.png', 'elemento' => 'FFF', 'sexo' => 'GGG', 'cumpleaños' => 'HHH', 'constelacion' => 'III', 'nacion' => 'JJJ', 'consigue' => 'KKK', 'fecha' => 'LLL');
		
		
	if ($res->num_rows > 0){
		$row = $res->fetch_assoc();
		$evento = array('colornom' => $row['colornom'], 'nombre' =>$row['nombre'], 'intro' => $row['intro'], 'personalidad' => $row['personalidad'], 'mote' => $row['mote'], 'color' => $row['color'], 'imgarma' => $row['imgarma'], 'arma' =>$row['arma'], 'imgelem' => $row['imgelem'], 'elemento' => $row['elemento'], 'sexo' => $row['sexo'], 'cumpleaños' => $row['cumpleaños'], 'constelacion' => $row['constelacion'], 'nacion' => $row['nacion'], 'consigue' => $row['consigue'], 'fecha' => $row['fecha'], 'id' => $idEv);
	}
		
		return $evento;
	}
	
//Funcion para obtener todos los eventos que hay en la base de datos
function getLista(){
        $mysqli = Conectar();

        $res = $mysqli->query("Select id, colornom, nombre, intro, personalidad, mote, color, imgarma, arma, imgelem, elemento, sexo, cumpleaños, constelacion, nacion, consigue, fecha,img From eventos") ;

        $eventos = array() ;

        while($row = $res->fetch_assoc()){
           $evento = array('colornom' => $row['colornom'], 'nombre' =>$row['nombre'], 'intro' => $row['intro'], 'personalidad' => $row['personalidad'], 'mote' => $row['mote'], 'color' => $row['color'], 'imgarma' => $row['imgarma'], 'arma' =>$row['arma'], 'imgelem' => $row['imgelem'], 'elemento' => $row['elemento'], 'sexo' => $row['sexo'], 'cumpleaños' => $row['cumpleaños'], 'constelacion' => $row['constelacion'], 'nacion' => $row['nacion'], 'consigue' => $row['consigue'], 'fecha' => $row['fecha'],'img' => $row['img'] ,'id' => $row['id']);
            array_push($eventos,$evento) ;
        }

        return $eventos ;
    }

//Funcion para añadir un evento 
function addEvento($colornom,$nombre,$intro,$personalidad,$mote,$color,$imgarma,$arma,$imgelem,$elemento,$sexo,$cumpleaños,$constelacion,$nacion,$consigue,$fecha,$img,$gestor){
	$mysqli = Conectar();
	$mysqli->query("Insert into eventos(colornom,nombre,intro,personalidad,mote,color,imgarma,arma,imgelem,elemento,sexo,cumpleaños,constelacion,nacion,consigue, fecha,img,gestor) Values ('$colornom','$nombre','$intro','$personalidad','$mote','$color','$imgarma','$arma','$imgelem','$elemento','$sexo','$cumpleaños','$constelacion', 		'$nacion','$consigue','$fecha','$img','$gestor')") ;
	
//Para añadir las imagenes
	 $res=$mysqli->query("Select id From eventos Where nombre='$nombre'");
	


        $id = $res->fetch_assoc()['id'];
        echo $id;
         if(isset($img)){
            $mysqli->query("Insert into imagenes Values ('$id','$img')");
        }
        
	return $id;
}

//Funcion para modificar un evento
function modificarEvento($idEv,$colornom,$nombre,$intro,$personalidad,$mote,$color,$imgarma,$arma,$imgelem,$elemento,$sexo,$cumpleaños,$constelacion,$nacion,$consigue,$fecha){
        $mysqli = Conectar();
        seguridad($idEv);
        
        //Vayamos comprobando que está relleno. Si lo está, actualizamos.
        if(isset($colornom)) 
            $mysqli->query("Update eventos Set colornom='$colornom' Where id='$idEv'");
         if(isset($nombre)) 
            $mysqli->query("Update eventos Set nombre='$nombre' Where id='$idEv'");
         if(isset($intro)) 
            $mysqli->query("Update eventos Set intro='$intro' Where id='$idEv'");
         if(isset($personalidad)) 
            $mysqli->query("Update eventos Set personalidad='$personalidad' Where id='$idEv'");
         if(isset($mote)) 
            $mysqli->query("Update eventos Set mote='$mote' Where id='$idEv'");
         if(isset($color)) 
            $mysqli->query("Update eventos Set color='$color' Where id='$idEv'");
         if(isset($imgarma)) 
            $mysqli->query("Update eventos Set imgarma='$imgarma' Where id='$idEv'");
         if(isset($arma)) 
            $mysqli->query("Update eventos Set arma='$arma' Where id='$idEv'");
         if(isset($imgelem)) 
            $mysqli->query("Update eventos Set imgelem='$imgelem' Where id='$idEv'");
         if(isset($elemento)) 
            $mysqli->query("Update eventos Set elemento='$elemento' Where id='$idEv'");
         if(isset($sexo)) 
            $mysqli->query("Update eventos Set sexo='$sexo' Where id='$idEv'");
         if(isset($cumpleaños)) 
            $mysqli->query("Update eventos Set cumpleaños='$cumpleaños' Where id='$idEv'");
         if(isset($constelacion)) 
            $mysqli->query("Update eventos Set constelacion='$constelacion' Where id='$idEv'");
         if(isset($nacion)) 
            $mysqli->query("Update eventos Set nacion='$nacion' Where id='$idEv'");
         if(isset($consigue)) 
            $mysqli->query("Update eventos Set consigue='$consigue' Where id='$idEv'");
         if(isset($fecha)) 
            $mysqli->query("Update eventos Set fecha='$fecha' Where id='$idEv'");
        
    }
  
 //Lista de eventos añadidos por un determinado gestor
 function getListaEventosGestor($gestor){
        $mysqli = Conectar();

        $res = $mysqli->query("Select id, colornom, nombre, intro, personalidad, mote, color, imgarma, arma, imgelem, elemento, sexo, cumpleaños, constelacion, nacion, consigue, fecha From eventos Where gestor='$gestor'") ;

        $eventos = array() ;

        while($row = $res->fetch_assoc()){
           $evento = array('colornom' => $row['colornom'], 'nombre' =>$row['nombre'], 'intro' => $row['intro'], 'personalidad' => $row['personalidad'], 'mote' => $row['mote'], 'color' => $row['color'], 'imgarma' => $row['imgarma'], 'arma' =>$row['arma'], 'imgelem' => $row['imgelem'], 'elemento' => $row['elemento'], 'sexo' => $row['sexo'], 'cumpleaños' => $row['cumpleaños'], 'constelacion' => $row['constelacion'], 'nacion' => $row['nacion'], 'consigue' => $row['consigue'], 'fecha' => $row['fecha'], 'id' => $row['id']);
            array_push($eventos,$evento) ;
        }

        return $eventos ;
    }

//Funcion para eliminar un evento
function deleteEvento($idEv){
        $mysqli = Conectar();
        seguridad($idEv);
        deleteEtiquetas($idEv);
        $mysqli->query("Delete From imagenes Where id_evento='$idEv'");
        $mysqli->query("Delete From eventos Where id='$idEv'");
    }


?>
