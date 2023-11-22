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
            <div class="col-md-6">
                <div class="card centered-card">
                    <div class="card-header">
                        <h5 class="card-title">Inicio de sesión de usuarios</h5>
                    </div>
                    <div class="card-body">
                        <form action="usuarios/controlador/LoginController.php?action=iniciarSesion" method="POST">
                            <div class="form-group mt-2">
                                <label for="username">Correo Inicio sesion:</label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-2">
                        <a href="">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="text-center mt-2">
                        <a href="usuarios/vista/registrar.php">No tienes cuenta. Regístrate aquí</a>
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

