<?php

class Usuarios{

    private $id;
    private $nombres;
    private $apellidos;
    private $num_identificacion;
    private $id_rol;
    private $num_cuenta;
    private $correo;
    private $pass;
    private $saldo;
    private $cuenta;

    public function __construct($id = null, $nombres = null, $apellidos = null, $num_identificacion = null, $id_rol = null, $num_cuenta = null, $correo = null, $pass = null, $saldo=null, $cuenta=null) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->num_identificacion = $num_identificacion;
        $this->id_rol = $id_rol;
        $this->num_cuenta = $num_cuenta;
        $this->correo = $correo;
        $this->pass = $correo;
        $this->saldo = $saldo;
        $this->cuenta = $cuenta;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getNum_identificacion() {
        return $this->num_identificacion;
    }

    public function setNum_identificacion($num_identificacion) {
        $this->num_identificacion = $num_identificacion;
    }

    public function getId_rol() {
        return $this->id_rol;
    }

    public function setId_rol($id_rol) {
        $this->id_rol = $id_rol;
    }

    public function getNum_cuenta() {
        return $this->num_cuenta;
    }

    public function setNum_cuenta($num_cuenta) {
        $this->num_cuenta = $num_cuenta;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function getCuenta() {
        return $this->cuenta;
    }

    public function setCuenta($cuenta) {
        $this->cuenta = $cuenta;
    }

    public static function crearUsuario($id, $nombre, $apellido, $email, $cuenta, $password){
        include('../../conexion.php');
        
        $num_cuenta = rand(1000000000, 9999999999);
    
        // vamos a utilizar una sentencia preparada
        $stmt = $conexion->prepare("INSERT INTO usuarios (rol_idrol, cuentas_idcuenta, nombres, apellidos, num_identificacion, correo, pass, saldo, numero_cuenta) VALUES (2, ?, ?, ?, ?, ?, ?, 0, ?)");
        $stmt->bind_param("ississi", $cuenta, $nombre, $apellido, $id, $email, $password, $num_cuenta);
    
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        $stmt->close();

        if ($resultado) {
            return true; 
        } else {
            
            echo "Error al registrar el usuario: " . $conexion->error;
            return false; 
        }
    }

    

    public static function verificarCorreo($username){
        include('../../conexion.php');
        
        $sql= "SELECT COUNT(*) AS count FROM usuarios INNER JOIN rol ON rol.idrol= usuarios.rol_idrol
         where correo = '$username' and rol.nombre_rol = 'usuario'";
        $resultado = $conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $count = $row['count'];
            if ($count>0) {
                return true;
            }
        }
        return false;
    }

    public static function verificarCorreoA($username){
        include('../../conexion.php');
        
        $sql= "SELECT COUNT(*) AS count FROM usuarios INNER JOIN rol ON rol.idrol= usuarios.rol_idrol
         where correo = '$username' and rol.nombre_rol = 'admin'";
        $resultado = $conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $count = $row['count'];
            if ($count>0) {
                return true;
            }
        }
        return false;
    }


    public static function loginUsu($username, $password){

        include ('../../conexion.php');

        $sql= "SELECT *
         FROM usuarios where correo = '$username' and pass = '$password'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();

            $usuario = new Usuarios();
            $usuario->setId($row['idusuario']);
            $usuario->setNombres($row['nombres']);
            $usuario->setApellidos($row['apellidos']);
            $usuario->setNum_identificacion($row['num_identificacion']);
            $usuario->setId_rol($row['rol_idrol']);
            $usuario->setNum_cuenta($row['cuentas_idcuenta']);
            $usuario->setCorreo($row['correo']);
            $usuario->setPass($row['pass']);

            return $usuario;
        }else {
            return null;
        }
    }


    public static function loginAdmin($username, $password){

        include('../../conexion.php');

        $sql= "SELECT * FROM usuarios INNER JOIN rol ON rol.idrol= usuarios.rol_idrol where correo = '$username'
        and pass = '$password' and rol.nombre_rol = 'admin'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();

            $usuario = new Usuarios();
            $usuario->setId($row['idusuario']);
            $usuario->setNombres($row['nombres']);
            $usuario->setApellidos($row['apellidos']);
            $usuario->setNum_identificacion($row['num_identificacion']);
            $usuario->setId_rol($row['rol_idrol']);
            $usuario->setNum_cuenta($row['cuentas_idcuenta']);
            $usuario->setCorreo($row['correo']);
            $usuario->setPass($row['pass']);

            return $usuario;
        }else {
            return null;
        }
    }
   
    
    public static function cuentas(){
         include('../../conexion.php');

         $sql="SELECT * FROM cuentas";
         $resultado= $conexion->query($sql);
         $cuentas= array();

         while ($row = $resultado->fetch_assoc()) {
           $cuenta = new Usuarios();
           $cuenta->setId($row['idcuenta']);
           $cuenta->setNombres($row['tipo_cuenta']);
           $cuentas[] = $cuenta;
         }
         return $cuentas;

    }

    public static function traerUsuario($id){
        include('../../conexion.php');

        $sql="SELECT * FROM usuarios INNER JOIN cuentas ON cuentas.idcuenta = usuarios.cuentas_idcuenta where num_identificacion = '$id'";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows === 1) {
             $row = $resultado->fetch_assoc();

        $usuario = new Usuarios();
        $usuario->setId($row['num_identificacion']);
        $usuario->setNombres($row['nombres']);
        $usuario->setApellidos($row['apellidos']);
        $usuario->setNum_cuenta($row['tipo_cuenta']);
        $usuario->setCorreo($row['correo']);
        $usuario->setSaldo($row['saldo']);
        $usuario->setCuenta($row['numero_cuenta']);

        return $usuario;
    }else {
        return null;
    }
}

 public static function saldo($id){
        include('../../conexion.php');
        $sql="SELECT saldo FROM usuarios where num_identificacion = '$id'";
        $resultado= $conexion->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $saldo = $row['saldo'];
            return $saldo;
        }
    }

    public static function recargar($monto, $id){
        $valor = self::saldo($id);
        $total = $valor + $monto;
    
        include('../../conexion.php');
        
        // en este caso vamos hacer uso de una sentencia preparada
        $stmt = $conexion->prepare("UPDATE usuarios SET saldo = ? WHERE num_identificacion = ?");
        $stmt->bind_param("ii", $total, $id);
    
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        $stmt->close();
    
        if ($resultado) {
            return true;
        } else {
            return false;
        } 
    }
    public static function buscarCuenta($cuenta){
        include('../../conexion.php');
        $sql="SELECT num_identificacion  FROM usuarios where numero_cuenta = '$cuenta'";
        $resultado= $conexion->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $saldo = $row['num_identificacion'];
            return $saldo;
        }
    }

    public static function retirar($monto, $id){
        $valor = self::saldo($id);
    
        if ($valor >= $monto) {
            $total = $valor - $monto;
    
            include('../../conexion.php');
            
            // Esta funcion tambien estara utilizando una sentencia preparada
            $stmt = $conexion->prepare("UPDATE usuarios SET saldo = ? WHERE num_identificacion = ?");
            $stmt->bind_param("ii", $total, $id);
    
            // Ejecutar la consulta
            $resultado = $stmt->execute();
            $stmt->close();
            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } else {
            // Saldo insuficiente
            return false;
        }
    }
    

    // public static function retirar($monto, $id){
    //    $valor=self::saldo($id);
    //    if ($valor>=$monto) {
    //     $total=$valor-$monto;
    //     include('../../conexion.php');
    //     $sql="UPDATE usuarios SET saldo=$total WHERE num_identificacion = '$id'";
    //     $resultado = $conexion->query($sql);
    //     if ($resultado) {
    //         // Éxito en la actualización
    //         return true;
    //     } else {
    //         // Error en la actualización
    //         return false;
    //     }
    // } else {
    //     // Saldo insuficiente
    //     return false;
    //    }
      

    // }
}


?>