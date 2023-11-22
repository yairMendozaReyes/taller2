<?php
 session_start();
if (isset($_SESSION['idAdmin'])) {
    $id= $_SESSION['idAdmin'];
    $nombre=$_SESSION['nombreA'];
    require_once('../modelo/Usuario.php');
    $cuenta = new Usuarios();
    $usu = $cuenta->usuarios();

    include('header.php');
    
?>   
<div class="conatiner-fluid">
  <h2>Lista de usuarios</h2>
<div class="m-2"> 
<div class="row justify-content-end">
  <button class="btn btn-primary"><a class="nav-link text-white" href="registrar.php">
    <i class="fa-solid fa-plus" style="color: #f0f2f4;"></i> Crear Usuario</a></button>
</div>
</div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Identificacion</th>
      <th scope="col">Nombres</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Num Cuenta</th>
      <th scope="col">Correo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <?php foreach ($usu as $dato) {
     
     ?>
  <tbody class="table-group-divider">
    <tr>
      <th scope="row"><?php echo $dato->getId();?></th>
      <td><?php echo $dato->getNombres();?></td>
      <td><?php echo $dato->getApellidos();?></td>
      <td><?php echo $dato->getCuenta();?></td>
      <td><?php echo $dato->getCorreo();?></td>
      <td>
      <div class="row">
        <div class="col">
          <form action="../controlador/usuariosController.php?action=borrar" method="POST">
              <input type="hidden" name="action" value="borrar">
              <input type="hidden" name="id" value="<?php echo $dato->getId(); ?>">
              <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash" style="color: #eeeff2;"></i></button>
            </form>
          </div>
        <div class="col">
                        
          <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dato->getId(); ?>">
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen" style="color: #f5f5f5;"></i></button>
          </form>
        </div>
      </div>
      </td>
    </tr>
   
  </tbody>
  <?php  }?>
</table>
</div>




<?php
include('footer.php');
include('errores.php');
}
else {
    header('Location: ../../login.php');
}
?>