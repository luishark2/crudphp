<?php
include "config.php";

if ($_POST) {
    $cliente_id = $_POST['cliente_id'];
    $total = $_POST['total'];

    try {
        $stmt = $conn->prepare("INSERT INTO ventas(cliente_id, total) VALUES(:cliente_id, :total)");
        $stmt->bindParam(":cliente_id", $cliente_id);
        $stmt->bindParam(":total", $total);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                Venta registrada correctamente <a href="readventas.php" class="alert-link">Ver ventas</a>.
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Error al registrar la venta <a href="readventas.php" class="alert-link">Intenta nuevamente</a>.
            </div>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- Formulario para registrar una venta -->
<div class="modal" id="createVenta" tabindex="-1" aria-labelledby="modalVentaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVentaLabel">Registrar Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select class="form-control" id="cliente_id" name="cliente_id" required>
                            <option value="" disabled selected>Selecciona un cliente</option>
                            <?php
                            $clientes = $conn->query("SELECT id, nombre FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
foreach ($clientes as $cliente) {
    echo '<option value="' . $cliente['id'] . '">' . $cliente['nombre'] . '</option>';
}
?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" class="form-control" id="total" name="total" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
