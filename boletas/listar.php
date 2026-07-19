<?php include '../conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>📄 Boletas Registradas</title>
  <style>
  body {
    background: linear-gradient(120deg, #0D1117, #1F2937, #161B22);
    background-size: 400% 400%;
    animation: fondoAnimado 15s ease infinite;
    color: #C9D1D9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    overflow-x: hidden;
  }

  @keyframes fondoAnimado {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  header {
    width: 100%;
    background-color: rgba(22, 27, 34, 0.9);
    padding: 1rem 2rem;
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    border-bottom: 1px solid #30363D;
    box-shadow: 0 2px 4px rgba(0,0,0,0.4);
    backdrop-filter: blur(6px);
  }

  main {
  max-width: 95%;
  width: 100%;
  padding: 2rem;
  margin-top: 2rem;
  background-color: rgba(22, 27, 34, 0.85);
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.5);
  animation: fadeInSlide 0.8s ease-in-out both;
}

input:focus {
      border-color: #58a6ff;
      outline: none;
    }

.tabla-scroll {
  width: 100%;
  overflow-x: auto;
}

  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .btn-nueva {
    background-color: #001d47;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 1rem;
    display: inline-block;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
  }

  .btn-nueva:hover {
    background-color: #000;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.6);
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
  }

  th, td {
    border: 1px solid #30363D;
    padding: 8px;
    text-align: center;
  }

  th {
    background-color: #21262D;
  }

  td {
    background-color: #161B22;
  }

  .acciones a {
    display: inline-block;
    padding: 6px 10px;
    margin: 2px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    font-size: 0.9rem;
    transition: all 0.3s ease;
  }

  .btn-editar {
    background-color: #2D7BE5;
    color: white;
  }

  .btn-editar:hover {
    background-color: #4594f5;
    transform: translateY(-1px);
  }

  .btn-eliminar {
    background-color: #D3393E;
    color: white;
  }

  .btn-eliminar:hover {
    background-color: #E55353;
    transform: translateY(-1px);
  }

  .btn-pdf {
    background-color: #6C6CFF;
    color: white;
  }

  .btn-pdf:hover {
    background-color: #8888FF;
    transform: translateY(-1px);
  }

  .btn-regresar {
    display: inline-block;
    margin-top: 2rem;
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

  .tabla-scroll {
  width: 100%;
  overflow-x: auto;
  max-height: 100%;
  padding-bottom: 0.5rem;
  scrollbar-width: thin;
  scrollbar-color: #30363D transparent;
}

.tabla-scroll::-webkit-scrollbar {
  height: 8px;
}

.tabla-scroll::-webkit-scrollbar-track {
  background: transparent;
}

.tabla-scroll::-webkit-scrollbar-thumb {
  background-color: #30363D;
  border-radius: 4px;
}

  /* Animación de entrada */
  @keyframes fadeInSlide {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Notificación base */
  #notificacion {
    padding: 0.8rem 1rem;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 1.5rem;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(0, 255, 13, 1);
    animation: fadeInSlide 0.5s ease-in-out both;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    transition: opacity 0.5s ease, transform 0.5s ease, max-height 0.5s ease, margin-bottom 0.5s ease;
    overflow: hidden;
  }

  /* Colores notificación */
  .noti-error {
    background-color: #bb2c2c;
    color: white;
  }

  .noti-ok {
    background-color: #161B22;
    color: white;
  }

  /* Animación de salida suave */
  @keyframes fadeOutSlideUp {
    from {
      opacity: 1;
      transform: translateY(0);
      max-height: 100px;
      margin-bottom: 1.5rem;
    }
    to {
      opacity: 0;
      transform: translateY(-20px);
      max-height: 0;
      margin-bottom: 0;
    }
  }

  .fade-out-remove {
    animation: fadeOutSlideUp 0.7s ease forwards;
  }
</style>
</head>
<body>
  <header>📋 Sistema Facturador</header>

  <main>
    <?php if (isset($_GET['mensaje'])) : ?>
      <div id="notificacion" class="<?= $_GET['mensaje'] == 'eliminado' ? 'noti-error' : 'noti-ok' ?>">
        <?= $_GET['mensaje'] == 'eliminado' ? '🗑️ Boleta eliminada correctamente. 😎' : '✅ Boleta editada correctamente. 😎' ?>
      </div>
    <?php endif; ?>

    <h2>📄 Boletas Registradas</h2>
    <a href="registrar.php" class="btn-nueva">➕ Registrar nueva boleta</a>
    <a href="../index.php" class="btn-regresar">⬅️ Volver al inicio</a>

<div class="tabla-scroll">
      <table>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>DNI</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Razón</th>
          <th>Producto</th>
          <th>Servicio</th>
          <th>Costo (S/)</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
        <?php
          $stmt = $pdo->query("SELECT * FROM boletas ORDER BY fecha_emision DESC");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre_cliente']}</td>
                    <td>{$row['dni_cliente']}</td>
                    <td>{$row['telefono_cliente']}</td>
                    <td>{$row['correo_cliente']}</td>
                    <td>{$row['rason']}</td>
                    <td>{$row['producto_dejado']}</td>
                    <td>{$row['servicio_a_realizar']}</td>
                    <td>S/ {$row['costo_total']}</td>
                    <td>{$row['fecha_emision']}</td>
                    <td class='acciones'>
                      <a class='btn-pdf' href='generar_pdf.php?id={$row['id']}' target='_blank'>📄 PDF</a>
                      <a class='btn-editar' href='editar.php?id={$row['id']}'>✏️ Editar</a>
                      <a class='btn-eliminar' href='eliminar.php?id={$row['id']}' onclick=\"return confirm('¿Estás seguro de eliminar esta boleta?');\">🗑️ Eliminar</a>
                    </td>
                  </tr>";
          }
        ?>
      </table>
    </div>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const notificacion = document.getElementById("notificacion");
      if (notificacion) {
        setTimeout(() => {
          notificacion.style.transition = "opacity 0.6s ease, transform 0.6s ease, max-height 0.6s ease, margin-bottom 0.6s ease";
          notificacion.style.opacity = "0";
          notificacion.style.transform = "translateY(-20px)";
          notificacion.style.maxHeight = "0";
          notificacion.style.marginBottom = "0";
          setTimeout(() => {
            notificacion.remove();
          }, 700);
        }, 4000);
      }
    });
  </script>
</body>
