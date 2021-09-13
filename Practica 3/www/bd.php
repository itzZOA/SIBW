<?php
	function getEvento($idEv){
		$mysqli = new mysqli("mysql", "claudia", "03C02SM", "SIBW");
		if($mysqli->connect_errno){
			echo ("Fallo al conectar: " . $mysqli->connect_error);
		}
		(int)$mysqli->real_escape_string($_POST['idEv']);
		$res = $mysqli->query("SELECT colornom, nombre, intro, personalidad, mote, img, color, imgarma, arma, imgelem, elemento, sexo, cumpleaños, constelacion, nacion, consigue, fecha FROM  eventos WHERE id=" . $idEv);
		
		$evento = array('colornom'=> '#29FFC6', 'nombre' => 'AAA', 'intro' => 'BBB','personalidad' => 'CCC', 'mote' => 'DDD', 'img' => 'img/venti.png', 'color' => '#BEFFED', 'imgarma' => 'img/arcoicon.png', 'arma' => 'EEE', 'imgelem' => 'img/anemo.png', 'elemento' => 'FFF', 'sexo' => 'GGG', 'cumpleaños' => 'HHH', 'constelacion' => 'III', 'nacion' => 'JJJ', 'consigue' => 'KKK', 'fecha' => 'LLL');
		if ($res->num_rows > 0){
			$row = $res->fetch_assoc();
			$evento = array('colornom' => $row['colornom'], 'nombre' => $row['nombre'], 'intro' => $row['intro'], 'personalidad' => $row['personalidad'], 'mote' => $row['mote'], 'img' => $row['img'], 'color' => $row['color'], 'imgarma' => $row['imgarma'], 'arma' =>$row['arma'], 'imgelem' => $row['imgelem'], 'elemento' => $row['elemento'], 'sexo' => $row['sexo'], 'cumpleaños' => $row['cumpleaños'], 'constelacion' => $row['constelacion'], 'nacion' => $row['nacion'], 'consigue' => $row['consigue'], 'fecha' => $row['fecha']);
		}
		return $evento;
	}
?>


