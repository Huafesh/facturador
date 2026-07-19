<?php include '../conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>➕ Registrar Boleta</title>
  <style>
  html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* ✨ Elimina scroll lateral innecesario */
  }

  body {
    background: linear-gradient(120deg, #0D1117, #1F2937, #161B22);
    background-size: 400% 400%;
    animation: fondoAnimado 15s ease infinite;
    color: #C9D1D9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    opacity: 0;
    transition: opacity 0.8s ease;
    box-sizing: border-box;
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
    box-sizing: border-box;
  }

  main {
    max-width: 600px;
    width: 100%;
    padding: 2rem;
    margin-top: 2rem;
    background-color: rgba(22, 27, 34, 0.85);
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.5);
    box-sizing: border-box;
  }

  h2 {
    text-align: center;
    margin-bottom: 1.5rem;
  }

  form {
    display: flex;
    flex-direction: column;
  }

  label {
    margin-top: 1rem;
    margin-bottom: 0.3rem;
    font-weight: bold;
  }

  input, textarea {
    padding: 0.6rem;
    border-radius: 8px;
    border: 1px solid #30363D;
    background-color: #0D1117;
    color: #C9D1D9;
    font-size: 1rem;
  }

  textarea {
    resize: vertical;
  }

  button {
    margin-top: 2rem;
    padding: 0.75rem;
    background-color: #001d47;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.4);
    transition: background-color 0.3s ease, transform 0.2s;
  }

  input:focus {
      border-color: #58a6ff;
      outline: none;
    }

  button:hover {
    background-color: #000;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.6);
  }

  .mensaje {
    margin-top: 1.5rem;
    background-color: #161B22;
    color: white;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 6px rgba(21, 255, 0, 1);
    transition: max-height 0.6s ease, margin 0.6s ease, opacity 0.6s ease;
  }

  .fade-out-remove {
    animation: fadeOutSlideUp 0.7s ease forwards;
  }

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
</style>
</head>
<body>
  <header>📋 Sistema Facturador</header>
  <main>
    <h2>➕ Registrar Boleta</h2>

    <?php
    $mensaje = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $sql = "INSERT INTO boletas (
            nombre_cliente, dni_cliente, telefono_cliente, correo_cliente,
            rason, producto_dejado, servicio_a_realizar, costo_total, fecha_emision
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
            $_POST['fecha_emision']
        ]);

        $mensaje = "✅ Boleta registrada correctamente. 😎";
    }
    ?>

    <?php if ($mensaje): ?>
      <div class="mensaje" id="notificacion"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <a href="../index.php" class="btn-regresar">⬅️ Volver al inicio</a>

      <label>Nombre del cliente:</label>
      <input type="text" name="nombre_cliente" required>

      <label>DNI:</label>
      <input type="text" name="dni_cliente" required>

      <label>Teléfono:</label>
      <input type="text" name="telefono_cliente" required>

      <label>Correo (opcional):</label>
      <input type="email" name="correo_cliente">

      <label>Razón del cobro:</label>
      <textarea name="rason" required></textarea>

      <label>Producto que deja:</label>
      <input type="text" name="producto_dejado" required>

      <label>Servicio a realizar:</label>
      <input type="text" name="servicio_a_realizar" required>

      <label>Costo total (S/):</label>
      <input type="number" name="costo_total" step="0.01" required>

      <label>Fecha de emisión:</label>
      <input type="date" name="fecha_emision" required>

      <button type="submit">Registrar Boleta</button>
    </form>
  </main>

  <style>
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

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      document.body.style.opacity = 0;
      requestAnimationFrame(() => {
        document.body.style.opacity = 1;
      });

      const enlaces = document.querySelectorAll("a[href]");
      enlaces.forEach(enlace => {
        enlace.addEventListener("click", function (e) {
          const destino = this.getAttribute("href");
          if (destino && !destino.startsWith("#") && !this.target) {
            e.preventDefault();
            document.body.style.opacity = 0;
            setTimeout(() => {
              window.location.href = destino;
            }, 500);
          }
        });
      });

      const notificacion = document.getElementById("notificacion");
      if (notificacion) {
        setTimeout(() => {
          notificacion.classList.add("fade-out-remove");
          setTimeout(() => {
            notificacion.remove();
          }, 800);
        }, 3000);
      }
    });
  </script>
</body>
