<?php 
session_start();
if (isset($_SESSION['idAdmin'])) {
    $id= $_SESSION['idAdmin'];
    $nombre = $_SESSION['nombreA'];
    require_once('../modelo/Usuario.php');
if ($_SERVER['REQUEST_METHOD']==="POST") {
    $id = $_POST['id'];
    $usu = new Usuarios();
    $res=$usu->traerUsuario($id);
    $valor = $usu->cuentas();
    $role = $usu->rol();

    include('header.php');

?>

 
<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3">
                    <div class="card-header text-center">
                        <h5 class="card-title">Crear Cuenta Bancaria</h5>
                    </div>
                    <div class="card-body">
                    <form action="../controlador/usuariosController.php?action=editar" method="POST">
                        <div class="mb-3">
                        <label for="id" class="form-label">Numero Identificacion</label>
                        <input type="number" class="form-control" id="id" name="id" value="<?php echo $res->getId();?>" readonly>
                        </div>
                        <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $res->getNombres();?>" required>
                        </div>
                        <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $res->getApellidos();?>" required>
                        </div>
                        <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $res->getCorreo();?>" readonly>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cuenta" class="form-label">Tipo Cuenta</label>
                                <select class="form-select" name="tipo_cuenta" aria-label="Default select example">
                                <?php
                                foreach ($valor as $tipo) {
                                    $selected = ($tipo->getId() == $res->GetId_cuenta()) ? 'selected' : '';
                                    echo "<option value=\"" . $tipo->getId() . "\" $selected>" . $tipo->getNombres() . "</option>";
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rol" class="form-label">Tipo Rol</label>
                                <select class="form-select" name="rol" aria-label="Default select example">
                                <?php
                                foreach ($role as $tipo) {
                                    $selected = ($tipo->getId() == $res->getId_rol()) ? 'selected' : '';
                                    echo "<option value=\"" . $tipo->getId() . "\" $selected>" . $tipo->getNombres() . "</option>";
                                }
                                ?>
                            </select>
                            </div>
                        </div>
                        <div class="mb-3">
                        
                        </div>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>


<?php
}
include('footer.php');
}else {
    header('location: index.php');
}
?>