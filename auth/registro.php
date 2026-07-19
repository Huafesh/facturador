<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro de Usuario</title>
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
    }

    @keyframes fondoAnimado {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    header {
  margin-top: 40px; /* Esto baja la barra como querías */
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
      margin-top: 2.5rem;
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
      background-color: #000000ff;
      transform: translateY(-2px);
    }

    .mensaje {
      margin-top: 1.5rem;
      background-color: #161B22;
      color: white;
      padding: 1rem;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(9, 255, 0, 1);
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
  </style>
</head>
<body onload="document.body.style.opacity='1'">
  <header>🔐 Registro inicial 👤</header>
  <main>
    <h2>Crear usuario administrador</h2>
    <form method="POST" action="">
      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" name="nombre" required />

      <label for="correo">Correo electrónico</label>
      <input type="email" id="correo" name="correo" required />

      <label for="clave">Contraseña</label>
      <input type="password" id="clave" name="clave" required />

      <button type="submit">Registrarme</button>
    </form>

    <?php
  include '../conexion.php';
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $stmt = $pdo->query("SELECT COUNT(*) FROM usuarios");
      if ($stmt->fetchColumn() > 0) {
          echo "<div class='mensaje'>Ya existe un usuario registrado.</div>";
          exit;
      }

      $nombre = $_POST['nombre'];
      $correo = $_POST['correo'];
      $contrasena = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$nombre, $correo, $contrasena])) {
          echo "<div class='mensaje'>✅ Usuario registrado correctamente.</div>";
      } else {
          echo "<div class='mensaje'>❌ Error al registrar.</div>";
      }
  }
?>
  </main>
</body>
</html>
