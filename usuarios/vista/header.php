<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco</title>
   
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/d152bd8a2a.js" crossorigin="anonymous"></script>
    <style>
        
    </style>
</head>
<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
        <a class="navbar-brand" href="#">
            <span class="text-white"> <i class="fa-solid fa-square-nfi fa-2xl" style="color: #f5f7f9;"></i> BANCO</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active my-2">
            <i class="fa-regular fa-circle-user" style="color: #f7f7f8;"></i>
                </li>
                <li class="nav-item active">
                <span class="nav-link"><?php echo $nombre; ?></span>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="message">
            <p class="mb-0">Gracias por Utilizar nuestros servicios. Bienvenido</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                Perfil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="retirar.php">
                                Retirar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recargar.php">
                                Recargar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pagar.php">
                                Pagar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                Movimientos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../controlador/LoginController.php?action=cerrarSesion">
                                Cerrar Sesion
                            </a>
                        </li>
                        <!-- Agrega más opciones según tus necesidades -->
                    </ul>
                </div>
            </nav>
            <!-- // Sidebar -->

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <div class="container-fluid">