<?php 
 session_start();
 if (isset($_SESSION['idusuario'])) {
     $id= $_SESSION['idusuario'];
     $nombre= $_SESSION['nombreU'];

include('header.php');
?>
<div class="row justify-content-center">
<div class="col-md-9">
            <!-- Formulario de transferencia y retiro de fondos en una card -->
            <div class="card border-2 border-secondary shadow-lg rounded-lg">
                <div class="card-body">
                    <h3 class="card-title">Retiro de fondos</h3>
                    <form action="../controlador/cuentaController.php?action=retirar" method="POST">
                        <div class="form-group">
                            <label for="monto">Monto:</label>
                            <input type="text" class="form-control" id="monto" name="monto" placeholder="$0.00" required>
                        </div>
                        <div class="form-group">
                            <label for="tipoRetiro">Tipo de retiro:</label>
                            <select class="form-control" id="tipoRetiro" name="tipoRetiro">
                                <option value="cajeroFisico">Cajero Físico</option>
                                <option value="cajeroAutomatico">Cajero Automático</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">Retirar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
<?php
include('footer.php');
 include('errores.php');

}
else {
    header('Location: ../../login.php');
}
?>