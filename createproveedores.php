<?php
if ($_POST) {
    $nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : "");
    $email = (isset($_POST['email']) ? $_POST['email'] : "");
    $telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : "");
    $direccion = (isset($_POST['direccion']) ? $_POST['direccion'] : "");
    $empresa = (isset($_POST['empresa']) ? $_POST['empresa'] : "");
    $imagen = (isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : "");
    $ruta = "imagen/" . $_FILES['imagen']['name'];
    $resultado = move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    try {
        $stmt = $conn->prepare("INSERT INTO proveedores(id, nombre, email, telefono, direccion, empresa, imagen) 
                                VALUES(null, :nombre, :email, :telefono, :direccion, :empresa, :imagen)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":direccion", $direccion);
        $stmt->bindParam(":empresa", $empresa);
        $stmt->bindParam(":imagen", $imagen);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
  Proveedor agregado correctamente <a href="readproveedores.php" class="alert-link">Volver a proveedores</a>.
</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
  Ocurrió un error. <a href="readproveedores.php" class="alert-link">Volver a proveedores</a>.
</div>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!-- Modal de Crear Proveedor -->
<div class="modal" id="create" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title center" id="modalLoginLabel"><i class="bi bi-person-plus"></i> AGREGAR PROVEEDOR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Formulario de Crear Proveedor -->
                    <div class="mb-3">
                        <i class="bi bi-person-vcard-fill"></i>
                        <label for="inputNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Ingresa el nombre" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-envelope-at-fill"></i>
                        <label for="inputEmail" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="tucorreo@example.com" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-phone-fill"></i>
                        <label for="inputTelefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="inputTelefono" name="telefono" placeholder="123-456-7891" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-house-add-fill"></i>
                        <label for="inputDireccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Ingresa la dirección" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-building"></i>
                        <label for="inputEmpresa" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="inputEmpresa" name="empresa" placeholder="Nombre de la empresa" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-image"></i>
                        <label for="inputImage" class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-floppy2-fill"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
