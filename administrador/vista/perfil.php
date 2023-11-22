<?php 
 session_start();
 if (isset($_SESSION['idAdmin'])) {
     $id= $_SESSION['idAdmin'];
     $nombre= $_SESSION['nombreA'];

     require_once('../modelo/Usuario.php');

     $cuenta = new Usuarios();
     $valor = $cuenta->traerUsuario($id);
    

include('header.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Información de la cuenta -->
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Bienvenido,<?php echo $valor->getNombres()." ". $valor->getApellidos(); ?> </h2>
                    <p class="card-text">Número de cuenta: <span id="numCuenta"><?php echo $valor->getCuenta();?></span></p>
                    <p class="card-text">Saldo actual: $<span id="saldo"><?php echo $valor->getSaldo(); ?></span></p>
                    <p class="card-text">Tipo de cuenta: <span id="tipoCuenta"><?php echo $valor->getNum_cuenta();?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
}
else {
    header('Location: ../../login.php');
}
?>