<?php
include '../conexion.php';

// Validar si se pasó el ID
if (!isset($_GET['id'])) {
  die("❌ ID de boleta no especificado.");
}

$id = $_GET['id'];

// Obtener datos actuales
$stmt = $pdo->prepare("SELECT * FROM boletas WHERE id = ?");
$stmt->execute([$id]);
$boleta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$boleta) {
  die("❌ Boleta no encontrada.");
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sql = "UPDATE boletas SET 
    nombre_cliente = ?, 
    dni_cliente = ?, 
    telefono_cliente = ?, 
    correo_cliente = ?, 
    rason = ?, 
    producto_dejado = ?, 
    servicio_a_realizar = ?, 
    costo_total = ?, 
    fecha_emision = ?
    WHERE id = ?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $_POST['nombre_cliente'],
    $_POST['dni_cliente'],
    $_POST['telefono_cliente'],
    $_POST['correo_cliente'] ?: null,
    $_POST['rason'],
    $_POST['producto_dejado'],
    $_POST['servicio_a_realizar'],
    $_POST['costo_total'],
    $_POST['fecha_emision'],
    $id
  ]);

  header("Location: ./listar.php?mensaje=editado");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>✏️ Editar Boleta</title>
  <style>
  body {
    background: linear-gradient(120deg, #0D1117, #161B22);
    color: #C9D1D9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 2rem;
  }

  h2 {
    text-align: center;
  }

  form {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: rgba(22, 27, 34, 0.9);
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    animation: fadeInSlide 0.8s ease-in-out both;
  }

  label {
    display: block;
    margin-top: 1rem;
    font-weight: bold;
  }

  input, textarea {
    width: 100%;
    padding: 0.6rem;
    margin-top: 0.3rem;
    border: none;
    border-radius: 8px;
    background-color: #21262D;
    color: #C9D1D9;
  }

  input {
      padding: 0.7rem;
      border-radius: 8px;
      background-color: #161b22;
      border: 1px solid #30363d;
      color: white;
      font-size: 1rem;
    }
    
  input:focus {
      border-color: #58a6ff;
      outline: none;
    }

  button {
    margin-top: 1.5rem;
    background-color: #001d47;
    color: white;
    border: none;
    padding: 0.7rem 1.2rem;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  button:hover {
    background-color: #000000ff;
    transform: translateY(-2px);
  }

  .btn-regresar {
    display: inline-block;
    margin: 2rem auto 0;
    padding: 0.75rem 1.2rem;
    background-color: #30363D;
    color: #fff;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1rem;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.4);
    transition: background-color 0.3s ease, transform 0.2s;
  }

  .btn-regresar:hover {
    background-color: #484f58;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.6);
  }

  @keyframes fadeInSlide {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
</head>
<body>
  <h2>✏️ Editar Boleta</h2>
  <div style="text-align:center;">
  <a href="../index.php" class="btn-regresar">⬅️ Volver al inicio</a>
</div>
  <form method="POST">
    <label>Nombre del cliente:</label>
    <input type="text" name="nombre_cliente" value="<?= htmlspecialchars($boleta['nombre_cliente']) ?>" required>

    <label>DNI:</label>
    <input type="text" name="dni_cliente" value="<?= htmlspecialchars($boleta['dni_cliente']) ?>" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono_cliente" value="<?= htmlspecialchars($boleta['telefono_cliente']) ?>" required>

    <label>Correo:</label>
    <input type="email" name="correo_cliente" value="<?= htmlspecialchars($boleta['correo_cliente']) ?>">

    <label>Razón del cobro:</label>
    <textarea name="rason" required><?= htmlspecialchars($boleta['rason']) ?></textarea>

    <label>Producto que deja:</label>
    <input type="text" name="producto_dejado" value="<?= htmlspecialchars($boleta['producto_dejado']) ?>" required>

    <label>Servicio a realizar:</label>
    <input type="text" name="servicio_a_realizar" value="<?= htmlspecialchars($boleta['servicio_a_realizar']) ?>" required>

    <label>Costo total (S/):</label>
    <input type="number" name="costo_total" step="0.01" value="<?= htmlspecialchars($boleta['costo_total']) ?>" required>

    <label>Fecha de emisión:</label>
    <input type="date" name="fecha_emision" value="<?= $boleta['fecha_emision'] ?>" required>

    <button type="submit">💾 Guardar cambios</button>
  </form>
</body>
</html>
