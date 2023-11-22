<?php 
require_once('../modelo/Usuario.php');

$cuenta = new Usuarios();
$valor = $cuenta->cuentas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="iconos/logo.ico" type="image/x-icon">
    <title>Login Banco</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .centered-card {
            margin: 0 auto;
            float: none;
            max-width: 400px; /* Ajusta el ancho máximo según tus necesidades */
            border: 1px solid #ccc; /* Cambia el color y estilo del borde según tus preferencias */
            border-radius: 10px; /* Añade esquinas redondeadas al borde */
            padding: 20px; /* Añade un espacio interno al contenido de la tarjeta */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card my-3">
                    <div class="card-header text-center">
                        <h5 class="card-title">Crear Cuenta Bancaria</h5>
                    </div>
                    <div class="card-body">
                    <form action="../controlador/RegistroController.php?action=crearUsuario" method="POST">
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
                        <div class="mb-3">
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
    </div>

    <?php
    session_start();
     if (isset($_SESSION['mjs'])) : 
       $error=$_SESSION['mjs']; ?>
        <script>
           swal({
                title: "!ERROR¡",
                text: "<?php echo $error; ?>",
                icon: "warning",
                button: "OK",
                });
        </script>
    <?php 
    unset($_SESSION['mjs']);
    endif; ?>
