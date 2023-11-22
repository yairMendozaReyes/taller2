<?php
include('../../conexion.php');
include('../modelo/Usuario.php');
session_start();
class CuentaController{

    public function retirar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $monto = $_POST['monto'];
            $tipo = $_POST['tipoRetiro'];
            $id= $_SESSION['idusuario'];
            
            if (empty($monto) || empty($tipo)) {
                // Alguno de los campos está vacío, mostrar mensaje de error
                $_SESSION['mjs'] = 'Todos los campos son obligatorios';
                
            }else {
            $usu = new Usuarios();
            $res=$usu->retirar($monto, $id);
            if ($res===true) {
                    $_SESSION['exito'] = 'Retiro realizado con exito';
                    
                
            }else {
                $_SESSION['mjs'] = 'Saldo insuficiente en su cuenta';
                
            }
        }
            header('Location: ../vista/retirar.php');
           
        }

    }


    
    public function recargar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $monto = $_POST['monto'];
            $id= $_SESSION['idusuario'];
            
            if (empty($monto)) {
                // Alguno de los campos está vacío, mostrar mensaje de error
                $_SESSION['mjs'] = 'Todos los campos son obligatorios';
                
            }else {
            $usu = new Usuarios();
            $res=$usu->recargar($monto, $id);
            if ($res===true) {
                    $_SESSION['exito'] = 'Recarga realizada con exito';
                    
                
            }else {
                $_SESSION['mjs'] = 'Error al intentar recargar';
                
            }
        }
            header('Location: ../vista/retirar.php');
           
        }

    }

    public function pagar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $monto = $_POST['monto'];
            $cuenta = $_POST['cuenta'];
             $id= $_SESSION['idusuario'];
           
            
            if (empty($monto) || empty($cuenta)) {
                // Alguno de los campos está vacío, mostrar mensaje de error
                $_SESSION['mjs'] = 'Todos los campos son obligatorios';
                
            }else {
            $usu = new Usuarios();
            $descuento= $usu->retirar($monto, $id);
            if ($descuento===true) {
               
            $idPago= $usu->buscarCuenta($cuenta);
            if ($idPago>0){
            $res=$usu->recargar($monto, $idPago);
            if ($res===true) {
                    $_SESSION['exito'] = 'Pago realizada con exito';
                    
                
            }else {
                $_SESSION['mjs'] = 'Error al intentar pagar';
                
            } 
        }else {
            $_SESSION['mjs'] = 'Esta cuenta no existe';
        }
           
        }else {
            $_SESSION['mjs'] = 'No cuenta con suficiente dinero para realizar pago';
        }
    }
        header('Location: ../vista/retirar.php');
        }

    }



}

$action = isset($_GET['action']) ? $_GET['action'] : '';

$cuentaController = new CuentaController();

switch ($action) {

    case 'retirar':
        $cuentaController->retirar();
      break;
      case 'recargar':
        $cuentaController->recargar();
      break;
      case 'pagar':
        $cuentaController->pagar();
      break;
  
  }