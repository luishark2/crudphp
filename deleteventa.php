
<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM ventas WHERE id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header('Location: readventas.php');
    } else {
        echo "Error al eliminar la venta.";
    }
}
?>
