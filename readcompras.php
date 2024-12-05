<?php
include "header.php";
$stmt = $conn->prepare("SELECT * FROM compras");
$stmt->execute();
$compras = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h5><b><i class="fa fa-shopping-cart"></i> Compras</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <div class="row">
        <div class="col-md-2 text-right">
            <h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="bi bi-cart-plus"></i> Nueva Compra
                </button>
            </h1>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="20">No</th>
                <th>Fecha de Compra</th>
                <th>Producto</th>
                <th>Precio</th>
                <th width="100">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($compras as $compra) { ?>
                <tr>
                    <td><?php echo $compra['id']; ?></td>
                    <td><?php echo $compra['fecha_compra']; ?></td>
                    <td><?php echo $compra['producto']; ?></td>
                    <td><?php echo $compra['precio']; ?></td>
                    <td>
                        <?php 
                        if ($_SESSION['usuario']['tipo'] == 'Admin') {
                            ?>
                            <a href="updatecompras.php?id=<?php echo $compra['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a onclick="return confirm_delete()" href="delete.php?id=<?php echo $compra['id']; ?>" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="update.php?id=<?php echo $compra['id']; ?>" class="btn btn-warning btn-sm disabled">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a onclick="return confirm_delete()" href="delete.php?id=<?php echo $compra['id']; ?>" class="btn btn-danger btn-sm disabled">
                                <i class="bi bi-trash"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
function confirm_delete() {
    return confirm('¿Está seguro de eliminar esta compra?');
}
</script>

<script>
var mySidebar = document.getElementById("mySidebar");
var overlayBg = document.getElementById("myOverlay");

function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

<script src="bootstrap/js/bootstrap.min.js"></script>

<?php
include "createcompras.php";
include "footer.php";
?>
