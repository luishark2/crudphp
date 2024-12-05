<?php

include "config.php";

if (isset($_GET['id'])) {
    $id = (isset($_GET['id']) ? $_GET['id'] : "");

    // Preparar la consulta para eliminar un proveedor
    $stmt = $conn->prepare("DELETE FROM proveedores WHERE id=:id");
    $stmt->bindParam(":id", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir al listado de proveedores después de la eliminación exitosa
        header('location: readproveedores.php');
    } else {
        // Mostrar mensaje de error si ocurre un problema
        echo '<div class="alert alert-danger" role="alert">
  Ocurrió un error al intentar eliminar el proveedor. <a href="readproveedores.php" class="alert-link">Volver a proveedores</a>.
</div>';
    }
}
?>
