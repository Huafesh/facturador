<?php
session_start();
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once '../conexion.php';

    // Verificar contraseña
    $stmt = $pdo->query("SELECT contrasena FROM usuarios LIMIT 1");
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($_POST['contrasena'], $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = 1; // o cualquier valor simbólico, ya que solo hay un usuario
        header("Location: ../index.php");
        exit;
    } else {
        $mensaje = "⚠️ Contraseña incorrecta";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Iniciar Sesión 👤</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    html, body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
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
      color: #58a6ff;
    }

    main {
      max-width: 500px;
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
      color: #58a6ff;
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

    input {
      padding: 0.6rem;
      border-radius: 8px;
      border: 1px solid #30363D;
      background-color: #0D1117;
      color: #C9D1D9;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }

    input:focus {
      border-color: #58a6ff;
      outline: none;
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

    button:hover {
      background-color: #000;
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.6);
    }

    .mensaje {
  margin-top: 1.5rem;
  background-color: #768a07ff;
  color: white;
  padding: 1rem;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

/* ✅ Marca de agua fuera del bloque .mensaje */
.marca-agua {
  position: fixed;
  bottom: 10px;
  right: 10px;
  font-size: 0.85rem;
  color: #666;
  display: flex;
  align-items: center;
  gap: 8px;
  opacity: 0.5;
  pointer-events: none;
  user-select: none;
  z-index: 999;
  font-style: italic;
}

.marca-img {
  height: 22px;
  opacity: 50;

    }
  </style>
</head>
<body onload="document.body.style.opacity='1'">
  <header>
    🔐 Acceso al sistema
  </header>

  <main>
    <h2>🔒 Iniciar sesión</h2>
    <form method="POST" action="">
      <label for="contrasena">Contraseña:</label>
      <input type="password" name="contrasena" id="contrasena" required>

      <button type="submit">Entrar</button>
    </form>

    <?php if (!empty($mensaje)) : ?>
      <div class="mensaje"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>
  </main>
  <!-- Marca de agua -->
<div class="marca-agua">
  Hecho por Huafesh
  <img src="../img/huafesh-toons.png" alt="Huafesh Toons" class="marca-img">
</div>

</body>
</html>
