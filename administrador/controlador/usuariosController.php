<?php 
include('../../conexion.php');
include('../modelo/Usuario.php');
session_start();
class UsuariosController{

    public function registrar(){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $cuenta = $_POST['tipo_cuenta'];
            $rol = $_POST['rol'];
            $password = $_POST['password'];
            $passwordc = $_POST['passwordc'];
            
            if (empty($id) || empty($nombre) || empty($apellido) || empty($email) || empty($cuenta) || empty($rol) ||  empty($password) || empty($passwordc)) {
                // Alguno de los campos está vacío, mostrar mensaje de error
                $_SESSION['mjs'] =  'Todos los campos son obligatorios';
                
            }else {
                
            $usu = new Usuarios();
            $res=$usu->verificarCorreo($email);
            if ($res===true) {
                $_SESSION['mjs'] = 'Este Email ya esta registrado';
            
            }else {
            if ($passwordc==$password) {
                $registroExitoso = $usu->crearUsuario($id, $nombre, $apellido, $email, $rol, $cuenta, $password);
                if ($registroExitoso) {
                    
                    // El registro se realizó correctamente, redirigir a una página de éxito o mostrar un mensaje de éxito
                    header('Location: ../vista/index.php');
                    return;
                } else {
                    // Ocurrió un error al registrar al usuario, mostrar mensaje de error
                    $_SESSION['mjs'] = 'Inconvenientes al registrar el Usuario';
    
                }
            }else {
                $_SESSION['mjs'] = 'Sus contraseñas no coinciden';
            }
        }

    }
            header('Location: ../vista/registrar.php');
        }

    }

    public function borrar(){
        if ($_SERVER['REQUEST_METHOD']==="POST") {
           $id = $_POST['id'];

            $usu = new Usuarios();
            $res=$usu->borrarUsuario($id);
            if ($res===true) {
               $_SESSION['exito']='Usuario Eliminado con exito';
            }else {
                $_SESSION['mjs']='Error al eliminar usuario';
            }

            header('Location: ../vista/index.php');
        }
    }

    public function editar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $cuenta = $_POST['tipo_cuenta'];
            $rol = $_POST['rol'];
            
            if (empty($id) || empty($nombre) || empty($apellido) || empty($email) || empty($cuenta) || empty($rol)) {
                // Alguno de los campos está vacío, mostrar mensaje de error
                $_SESSION['mjs'] =  'Todos los campos son obligatorios';
                
            }else {
                
            $usu = new Usuarios();

                $registroExitoso = $usu->editarUsuario($id, $nombre, $apellido, $email, $cuenta, $rol);
                if ($registroExitoso) {
                    $_SESSION['exito'] = 'usuario editado correctamente';
                    header('Location: ../vista/index.php');
                    return;
                } else {
                    // Ocurrió un error al registrar al usuario, mostrar mensaje de error
                    $_SESSION['mjs'] = 'No se pudo actualizar Correctamente';
    
                }

    }
            header('Location: ../vista/registrar.php');
        }

    
    }
}


$action = isset($_GET['action']) ? $_GET['action'] : '';

$usuariosController = new UsuariosController();

switch ($action) {

    case 'borrar':
        $usuariosController->borrar();
      break;
      case 'editar':
        $usuariosController->editar();
      break;
      case 'registrar':
        $usuariosController->registrar();
      break;
  
  case 'cerrarSesion':
      session_start();
      unset($_SESSION['idAdmin']);
      unset($_SESSION['nombreA']);
      header('Location: ../../login.php');
      exit();
      break;
  
  }

?>