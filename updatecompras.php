<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM compras WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $fecha_compra = $result['fecha_compra'];
    $producto = $result['producto'];
    $precio = $result['precio'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fecha_compra = $_POST['fecha_compra'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];

    // Actualizar compra
    $stmt = $conn->prepare("
        UPDATE compras 
        SET fecha_compra = :fecha_compra, producto = :producto, precio = :precio 
        WHERE id = :id
    ");
    $stmt->bindValue(":fecha_compra", $fecha_compra);
    $stmt->bindValue(":producto", $producto);
    $stmt->bindValue(":precio", $precio);
    $stmt->bindValue(":id", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Compra actualizada correctamente.');
                window.location.href = 'readcompras.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar la compra.');
                window.location.href = 'readcompras.php';
              </script>";
    }
}

include "header.php";
?>

<h5><b><i class="fa fa-pencil"></i> Actualizar Compras</b></h5>
</header>
<div class="row">
    <div class="col-md-2 text-right">
        <h1><a href="readcompras.php" class="btn btn-info">Regresar</a></h1>
    </div>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="mb-3">
            <label for="fecha_compra" class="form-label">Fecha de Compra</label>
            <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" value="<?php echo $fecha_compra; ?>" required>
        </div>
        <div class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" class="form-control" id="producto" name="producto" value="<?php echo $producto; ?>" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" step="0.01" min="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<?php include "footer.php"; ?>
