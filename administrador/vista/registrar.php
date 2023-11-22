<?php
session_start();
if (isset($_SESSION['idAdmin'])) {
    $id= $_SESSION['idAdmin'];
    $nombre = $_SESSION['nombreA'];
    require_once('../modelo/Usuario.php');
    $cuenta = new Usuarios();
    $valor = $cuenta->cuentas();
    $role = $cuenta->rol();
include('header.php');

?>
   
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-3">
                    <div class="card-header text-center">
                        <h5 class="card-title">Crear Cuenta Bancaria</h5>
                    </div>
                    <div class="card-body">
                    <form action="../controlador/usuariosController.php?action=registrar" method="POST">
                        <div class="mb-3">
                        <label for="id" class="form-label">Numero Identificacion</label>
                        <input type="number" class="form-control" id="id" name="id" required>
                        </div>
                        <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cuenta" class="form-label">Tipo Cuenta</label>
                                <select class="form-select" name="tipo_cuenta" aria-label="Default select example">
                                <option selected>Selecciona Cuenta...</option>
                                <?php
                                foreach ($valor as $tipo) {
                                    echo "<option value=\"" . $tipo->getId(). "\">" . $tipo->getNombres() . "</option>";
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rol" class="form-label">Tipo Rol</label>
                                <select class="form-select" name="rol" aria-label="Default select example">
                                <option selected>Selecciona Rol...</option>
                                <?php
                                foreach ($role as $tipo) {
                                    echo "<option value=\"" . $tipo->getId(). "\">" . $tipo->getNombres() . "</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                        
                        </div>
                        <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                        <label for="passwordc" class="form-label">Confirma Contraseña</label>
                        <input type="password" class="form-control" id="passwordc" name="passwordc" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    <?php include('footer.php');
    include('errores.php');
    }
    else {
        header('Location: ../../login.php');
    }?>