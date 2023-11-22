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
    private $id_cuenta;

    public function __construct($id = null, $nombres = null, $apellidos = null, $num_identificacion = null, $id_rol = null, $num_cuenta = null, $correo = null, $pass = null, $saldo=null, $cuenta=null, $id_cuenta=null) {
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
        $this->id_cuenta=$id_cuenta;
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

    public function getId_cuenta(){
        return $this->id_cuenta;
    }

    public function setId_cuenta($id_cuenta){
        $this->id_cuenta = $id_cuenta;
    }

    public static function crearUsuario($id, $nombre, $apellido, $email, $rol, $cuenta, $password){
        include('../../conexion.php');
        $num_cuenta = rand(1000000000, 9999999999);

        // Esta funcion utilizara una sentencia preparada
        $stmt = $conexion->prepare("INSERT INTO usuarios (rol_idrol, cuentas_idcuenta, nombres, apellidos, num_identificacion, correo, pass, saldo, numero_cuenta)
            VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)");
        $stmt->bind_param("iississi", $rol, $cuenta, $nombre, $apellido, $id, $email, $password, $num_cuenta);
    
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        $stmt->close();
        if ($resultado) {
            return true; 
        } else {
            return false; 
        }
    }
    

    // public static function crearUsuario($id, $nombre, $apellido, $email, $rol, $cuenta, $password){
    //     include('../../conexion.php');
    //     $num_cuenta = rand(1000000000, 9999999999);
    //     $sql="INSERT INTO usuarios (rol_idrol, cuentas_idcuenta, nombres, apellidos, num_identificacion, correo, pass, saldo, numero_cuenta)
    //     VALUES ('$rol', '$cuenta', '$nombre', '$apellido', '$id', '$email', '$password', 0, '$num_cuenta')";
    //     $resultado = $conexion->query($sql);

    //     if ($resultado) {
    //         return true; 
    //     } else {
    //         return false; 
    //     }
    // }

    public static function borrarUsuario($id){
        include('../../conexion.php');
        
        // esta funcion tambien Utilizamos una sentencia preparada
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE num_identificacion = ?");
        $stmt->bind_param("i", $id);
    
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        $stmt->close();
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    
    }

    public static function editarUsuario($id, $nombre, $apellido, $email, $cuenta, $rol){
        include('../../conexion.php');
    
        // Utilizamos una sentencia preparada para esta funcion
        $stmt = $conexion->prepare("UPDATE usuarios SET rol_idrol=?, cuentas_idcuenta=?, nombres=?, apellidos=?, correo=? WHERE num_identificacion=?");
        $stmt->bind_param("iisssi", $rol, $cuenta, $nombre, $apellido, $email, $id);
    
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        $stmt->close();
        if ($resultado) {
            return true;
        } else {
            return false;
        }
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
        $usuario->setId_rol($row['rol_idrol']);
        $usuario->setId_cuenta($row['cuentas_idcuenta']);

        return $usuario;
    }else {
        return null;
    }
}


public static function rol(){
    include('../../conexion.php');

    $sql="SELECT * FROM rol";
    $resultado= $conexion->query($sql);
    $roles= array();

    while ($row = $resultado->fetch_assoc()) {
      $rol = new Usuarios();
      $rol->setId($row['idrol']);
      $rol->setNombres($row['nombre_rol']);
      $roles[] = $rol;
    }
    return $roles;

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

public static function verificarCorreo($username){
    include('../../conexion.php');
    
    $sql= "SELECT COUNT(*) AS count FROM usuarios INNER JOIN rol ON rol.idrol= usuarios.rol_idrol
     where correo = '$username'";
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

public static function usuarios(){
    include('../../conexion.php');

    $sql="SELECT * FROM usuarios";
    $resultado= $conexion->query($sql);
    $usuarios= array();

    while ($row = $resultado->fetch_assoc()) {
      $usuario = new Usuarios();
      $usuario->setId($row['num_identificacion']);
      $usuario->setNombres($row['nombres']);
      $usuario->setApellidos($row['apellidos']);
      $usuario->setCorreo($row['correo']);
      $usuario->setCuenta($row['numero_cuenta']);
      $usuarios[] = $usuario;
    }
    return $usuarios;

}


}


?>