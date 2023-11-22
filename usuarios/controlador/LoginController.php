<?php
include('../../conexion.php');
include('../modelo/Usuario.php');
session_start();
class LoginController{

    
  public function iniciarSesion($username, $password) {
    
    $usu = new Usuarios();
    $res=$usu->verificarCorreo($username);
    $resA=$usu->verificarCorreoA($username);
    if ($res===true) {
      
      $existe=$usu->loginUsu($username, $password);

  
      if ($existe) {
        $_SESSION['idusuario'] = $existe->getNum_identificacion();
        $_SESSION['nombreU'] = $existe->getNombres();
        header('Location: ../vista/index.php');
        exit();
      } else {
       
        $_SESSION['mjs']='contraseña de usuario incorrecto';
        // $error_message = "contraseña de usuario incorrecto";
      }
      
    }elseif ($resA===true) {
     $existe= $usu->loginAdmin($username, $password);

  
      if ($existe) {
        // Las credenciales son válidas, iniciar sesión
        
        $_SESSION['idAdmin'] = $existe->getNum_identificacion();
        $_SESSION['nombreA'] = $existe->getNombres();
        header('Location: ../../administrador/vista/');
        exit();
      } else {
        
        $_SESSION['mjs']="contraseña de administrador incorrecto";
       
        // $error_message = "contraseña de administrador incorrecto";
      }
    }
    else{
     
       $_SESSION['mjs']="Usuario no Existe";
    }
    header('Location: ../../login.php');
    // include('../../login.php');
  }

  
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

$loginController = new LoginController();

switch ($action) {

    case 'iniciarSesion':
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loginController->iniciarSesion($username, $password);
      }
      break;
  
  case 'cerrarSesion':
      session_start();
      unset($_SESSION['idusuario']);
      unset($_SESSION['nombreU']);
      header('Location: ../../login.php');
      exit();
      break;
  
   
  }


?>