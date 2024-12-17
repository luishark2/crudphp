
<?php
include "header.php";

// Obtener todas las ventas
$stmt = $conn->prepare("SELECT v.id, c.nombre AS cliente, v.fecha_venta, v.total, v.estado FROM ventas v JOIN clientes c ON v.cliente_id = c.id");
$stmt->execute();
$ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h5><b><i class="fa fa-file-text"></i> Ventas</b></h5>

<div class="row">
    <div class="col-md-2 text-right">
        <h1><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createVenta">
            <i class="bi bi-box-seam"></i> Nueva Venta
        </button></h1>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ventas as $venta) { ?>
            <tr>
                <td><?php echo $venta['id']; ?></td>
                <td><?php echo $venta['cliente']; ?></td>
                <td><?php echo $venta['fecha_venta']; ?></td>
                <td><?php echo $venta['total']; ?></td>
                <td><?php echo $venta['estado']; ?></td>
                <td>
                    <a href="updateventa.php?id=<?php echo $venta['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                    <a onclick="return confirm('¿Seguro de eliminar esta venta?')" href="deleteventa.php?id=<?php echo $venta['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
include "createventa.php"; // Archivo para crear ventas
include "footer.php";
?>
