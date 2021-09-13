<?php
include_once('base.php');

  // Devuelve true si existe un usuario con esa contraseña
  function comprobarUsuario($nick, $password) {
    $mysqli = Conectar();
    $res = $mysqli->query("Select nick, password From usuarios Where nick='$nick'") ;
    if($res->num_rows > 0){
      $row = $res-> fetch_assoc();
      if ($password==$row['password']){
        return true;
      }
      else{
        return false;
      }
        
    }
    else return false;
  }

  
//Funcion para registrar un usuario
  function registrar($nick,$email,$password){
    $mysqli = Conectar();
    if (empty($nick) || empty($email) || empty($password)) return false;
    //$hash = password_hash($password,PASSWORD_DEFAULT);
    if ($mysqli->query("INSERT INTO usuarios (email, nick,password, rol) VALUES ('$email','$nick','$password',1)")){return true;}
    else return false ;
}

  
  // Devuelve la información de un usuario a partir de su nick 
  function getUser($nick) {
    $mysqli = Conectar();
    $res = $mysqli->query("Select id,nick,email,password,rol From usuarios Where nick='$nick'") ;

    if($res->num_rows > 0) 
        return $res->fetch_assoc() ;
    else 
        return 0;

  }

//Lista de usuarios por rol
  function getListUser() {
    $mysqli = Conectar();
    $res = $mysqli->query("Select nick,email,rol From usuarios Order By rol") ;
    $userList = array() ;

        while($row = $res->fetch_assoc()){
            $user = array('nick' => $row['nick'], 'email'=>$row['email'], 'rol' => $row['rol'] ) ;
            array_push($userList,$user) ;
        }
    return $userList;
    
  }


//Funcion para modificar el nick y el correo
  function modifyUser($oldNick,$nick,$email){
    $mysqli = Conectar();

    if (!empty($nick)) 
        $mysqli->query("UPDATE usuarios SET nick = '$nick' WHERE nick = '$oldNick' ");
    if (!empty($email) and empty($nick)) 
        $mysqli->query("UPDATE usuarios SET email = '$email' WHERE nick = '$oldNick' ");
    if (!empty($email) and !empty($nick)) 
      $mysqli->query("UPDATE usuarios SET email = '$email' WHERE nick = '$nick' ");
  }

//Funcion para modificar el password
  function modifyPass($nick,$oldPass,$oldHash,$password,$rep){
    $mysqli = Conectar();
    $errors="Empty";
    if (($oldPass==$oldHash) and $password == $rep){
      $mysqli->query("UPDATE usuarios SET password = '$password' WHERE nick = '$nick' ");
    }
    else{
      if (!password_verify($oldPass,$oldHash)){
        $errors="La contraseña antigua no es esa";
        return $errors;
      } 
        
      if ($password != $rep){
        $errors="Las contraseñas nuevas no coinciden";
      }
        
    }
    return $errors;
  }

//Funcion para cambiar el rol de un usuario
  function modifyRole($nick,$rol){
    $mysqli = Conectar();
    $res = $mysqli->query("Select Count(rol) Cuenta From usuarios Where rol = 4") ;
    $res2 = $mysqli->query("Select rol From usuarios Where nick = '$nick'") ;
    $cuenta = $res->fetch_assoc()['Cuenta'];
    $rolUsuario = $res2->fetch_assoc()['rol'];
    if ($cuenta == "4" and $rolUsuario == 4 and $rol != 4)
      return false;
    else $mysqli->query("UPDATE usuarios SET rol = '$rol' WHERE nick = '$nick' ");
      return true ;
  }
?>
