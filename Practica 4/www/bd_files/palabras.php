<?php

    function getPalabras(){
        $mysqli = Conectar();
        $res = $mysqli->query("Select palabra From palabras") ;

        $palabras = array() ;

        while($row = $res->fetch_assoc()){
            array_push($palabras,$row['palabra']);
        }

        return $palabras ;
    }
?>
