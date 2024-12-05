<?php
include "header.php";

// Consulta a la base de datos para obtener los proveedores
$stmt = $conn->prepare("SELECT * FROM proveedores");
$stmt->execute();
$proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h5><b><i class="fa fa-building"></i> Proveedores</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
<div class="row">
    <div class="col-md-2 text-right">
        <h1><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
        <i class="bi bi-person-plus"></i> Nuevo
        </button></h1>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="20">No</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Empresa</th>
            <th>Imagen</th>
            <th width="100">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($proveedores as $proveedor) { ?>
            <tr>
                <td><?php echo $proveedor['id']; ?></td>
                <td><?php echo $proveedor['nombre']; ?></td>
                <td><?php echo $proveedor['email']; ?></td>
                <td><?php echo $proveedor['telefono']; ?></td>
                <td><?php echo $proveedor['direccion']; ?></td>
                <td><?php echo $proveedor['empresa']; ?></td>
                <td><img src="imagen/<?php echo $proveedor['imagen']; ?>" alt="" class="img-rounded" width="150px" height="150px"></td>
                <td>
                <?php 
                    if ($_SESSION['usuario']['tipo'] == 'Admin') {
                        ?>
                        <a href="updateproveedores.php?id=<?php echo $proveedor['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                        <a onclick="return confirm_delete()" href="deleteproveedores.php?id=<?php echo $proveedor['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                        <?php
                    } else {
                        ?>
                        <a href="updateproveedores.php?id=<?php echo $proveedor['id']; ?>" class="btn btn-warning btn-sm disabled"><i class="bi bi-pencil-fill"></i></a>
                        <a onclick="return confirm_delete()" href="deleteproveedores.php?id=<?php echo $proveedor['id']; ?>" class="btn btn-danger btn-sm disabled"><i class="bi bi-trash"></i></a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script type="text/javascript">
function confirm_delete() {
    return confirm('¿Está seguro de eliminarlo?');
}
</script>
<script>
  // Get the Sidebar
  var mySidebar = document.getElementById("mySidebar");

  // Get the DIV with overlay effect
  var overlayBg = document.getElementById("myOverlay");

  // Toggle between showing and hiding the sidebar, and add overlay effect
  function w3_open() {
    if (mySidebar.style.display === 'block') {
      mySidebar.style.display = 'none';
      overlayBg.style.display = "none";
    } else {
      mySidebar.style.display = 'block';
      overlayBg.style.display = "block";
    }
  }

  // Close the sidebar with the close button
  function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
  }
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<?php
include "createproveedores.php";
include "footer.php";
?>
