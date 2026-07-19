<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Facturador</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
  <header>📋Factura💸</header>
  <main>
    <h2>Bienvenido👋</h2>
    <ul>
      <li><a href="boletas/registrar.php">➕ Registrar nueva boleta</a></li>
      <li><a href="boletas/listar.php">📄 Boletas registradas</a></li>
      <li><a href="auth/logout.php">🚪 Cerrar sesión</a></li>
    </ul>
  </main>

  <!-- Marca de agua fija con imagen -->
  <div class="marca-agua">
    Hecho por Huafesh
    <img src="img/huafesh-toons.png" alt="Huafesh Toons" class="marca-img">
  </div>
</body>
</html>
