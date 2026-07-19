<?php
include '../conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar boleta por ID
    $stmt = $pdo->prepare("DELETE FROM boletas WHERE id = ?");
    $stmt->execute([$id]);

    // Redirige de vuelta a la lista con mensaje
    header("Location: listar.php?mensaje=eliminado");
    exit();
} else {
    echo "❌ ID no válido.";
}
?>
