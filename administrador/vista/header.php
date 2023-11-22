<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/d152bd8a2a.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top p-3">
        <a class="navbar-brand" href="#">
            <!-- Agrega tu logo o imagen aquí -->
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
    <!-- // HEADER -->

    <!-- Message -->


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="perfil.php">
                                Mi Cuenta
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../controlador/usuariosController.php?action=cerrarSesion">
                                Cerrar sesion
                            </a>
                        </li>
                        <!-- Agrega más opciones según tus necesidades -->
                    </ul>
                </div>
            </nav>
            <!-- // Sidebar -->

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <div class="container-fluid overflow-auto">