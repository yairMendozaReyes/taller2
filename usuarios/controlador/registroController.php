<?php
include('../../conexion.php');
include('../modelo/Usuario.php');
session_start();
class RegistroController{

    public function crearUsuario(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $cuenta = $_POST['tipo_cuenta'];
            $password = $_POST['password'];
            $passwordc = $_POST['passwordc'];
            
            if (empty($id) || empty($nombre) || empty($apellido) || empty($email) || empty($cuenta) ||  empty($password) || empty($passwordc)) {
                // Alguno de los campos está vacío, mostrar mensaje de error
                $_SESSION['mjs'] ="Todos los campos son obligatorios";
                
            }else {
            $usu = new Usuarios();
            $res=$usu->verificarCorreo($email);
            $resA=$usu->verificarCorreoA($email);
            if ($res===true || $resA===true) {
                $_SESSION['mjs'] = 'Este Email ya esta registrado';
            }else{
            if ($passwordc==$password) {
                $registroExitoso = $usu->crearUsuario($id, $nombre, $apellido, $email, $cuenta, $password);
                if ($registroExitoso) {
                    //  redirigir a una página de éxito
                    header('Location: ../../login.php');
                    return;
                } else {
                    // Ocurrió un error al registrar al usuario
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

}

$action = isset($_GET['action']) ? $_GET['action'] : '';

$registroController = new RegistroController();

switch ($action) {

    case 'crearUsuario':
        $registroController->crearUsuario();
      break;
  
   
  }
