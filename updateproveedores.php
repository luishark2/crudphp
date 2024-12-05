<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM proveedores WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $nombre = $result['nombre'];
    $email = $result['email'];
    $telefono = $result['telefono'];
    $direccion = $result['direccion'];
    $empresa = $result['empresa'];
    $imagenActual = $result['imagen'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $empresa = $_POST['empresa'];

    // Manejo de la imagen
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = $_FILES['imagen']['name'];
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $directorioDestino = "imagen/" . $nombreImagen;

        // Mover la imagen al directorio
        move_uploaded_file($rutaTemporal, $directorioDestino);
    } else {
        $directorioDestino = $imagenActual; // Usar la imagen anterior si no se subió una nueva
    }

    // Actualizar proveedor
    $stmt = $conn->prepare("
        UPDATE proveedores 
        SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion, empresa = :empresa, imagen = :imagen 
        WHERE id = :id
    ");
    $stmt->bindValue(":nombre", $nombre);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":telefono", $telefono);
    $stmt->bindValue(":direccion", $direccion);
    $stmt->bindValue(":empresa", $empresa);
    $stmt->bindValue(":imagen", $directorioDestino);
    $stmt->bindValue(":id", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Proveedor actualizado correctamente.');
                window.location.href = 'readproveedores.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar el proveedor.');
                window.location.href = 'readproveedores.php';
              </script>";
    }
}

include "header.php";
?>
<h5><b><i class="fa fa-pencil"></i> Actualizar Proveedores</b></h5>
</header>
<div class="row">
    <div class="col-md-2 text-right">
        <h1><a href="readproveedores.php" class="btn btn-info">Regresar</a></h1>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
        </div>
        <div class="mb-3">
            <label for="empresa" class="form-label">Empresa</label>
            <input type="text" class="form-control" id="empresa" name="empresa" value="<?php echo $empresa; ?>" required>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen Actual </label>
            <img src="imagen/<?php echo $imagenActual; ?>" alt="Imagen del Proveedor" style="max-width: 150px; display: block; margin-bottom: 10px;">
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include "footer.php"; ?>
