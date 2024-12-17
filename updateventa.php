
<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM ventas WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $venta = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE ventas SET estado = :estado WHERE id = :id");
    $stmt->bindValue(":estado", $estado);
    $stmt->bindValue(":id", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Venta actualizada correctamente.');
                window.location.href = 'readventas.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar la venta.');
                window.location.href = 'readventas.php';
              </script>";
    }
}

include "header.php";
?>
<h5><b><i class="fa fa-pencil"></i> Actualizar Venta</b></h5>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $venta['id']; ?>" />
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-control" id="estado" name="estado" required>
            <option value="Pendiente" <?php echo $venta['estado'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
            <option value="Completada" <?php echo $venta['estado'] == 'Completada' ? 'selected' : ''; ?>>Completada</option>
            <option value="Cancelada" <?php echo $venta['estado'] == 'Cancelada' ? 'selected' : ''; ?>>Cancelada</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
<?php include "footer.php"; ?>
