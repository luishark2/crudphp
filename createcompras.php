<?php
if ($_POST) {
    $fecha_compra = (isset($_POST['fecha_compra']) ? $_POST['fecha_compra'] : "");
    $producto = (isset($_POST['producto']) ? $_POST['producto'] : "");
    $precio = (isset($_POST['precio']) ? $_POST['precio'] : "");

    try {
        $stmt = $conn->prepare("INSERT INTO compras(id, fecha_compra, producto, precio) VALUES(null, :fecha_compra, :producto, :precio)");
        $stmt->bindParam(":fecha_compra", $fecha_compra);
        $stmt->bindParam(":producto", $producto);
        $stmt->bindParam(":precio", $precio);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
  Compra registrada correctamente. <a href="readcompras.php" class="alert-link">Volver a compras</a>.
</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
  Ocurrió un error al registrar la compra. <a href="readcompras.php" class="alert-link">Intentar de nuevo</a>.
</div>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- Modal de Crear Compra -->
<div class="modal" id="create" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title center" id="modalLoginLabel"><i class="bi bi-bag-plus"></i> AGREGAR COMPRA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <!-- Formulario de Crear Compra -->
                    <div class="mb-3">
                        <i class="bi bi-calendar-date"></i>
                        <label for="inputFecha" class="form-label"> Fecha de Compra</label>
                        <input type="date" class="form-control" id="inputFecha" name="fecha_compra" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-box"></i>
                        <label for="inputProducto" class="form-label"> Producto</label>
                        <input type="text" class="form-control" id="inputProducto" name="producto" placeholder="Nombre del producto" required />
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-currency-dollar"></i>
                        <label for="inputPrecio" class="form-label"> Precio</label>
                        <input type="number" class="form-control" id="inputPrecio" name="precio" placeholder="Precio del producto" step="0.01" min="0" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-floppy2-fill"></i>
                        Guardar
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
