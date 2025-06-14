<?php
$tipo = $_GET['tipo'] ?? 'desconocido';

switch ($tipo) {
    case 'campos':
        $mensaje = "Por favor, completa todos los campos.";
        break;
    case 'usuario':
        $mensaje = "El usuario ingresado no está registrado.";
        break;
    case 'contrasena':
        $mensaje = "La contraseña es incorrecta.";
        break;
    default:
        $mensaje = "Ha ocurrido un error inesperado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Error de Inicio de Sesión</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" href="img/logo.png" type="image/png">
  <style>
    body {
      background-color: #fff0f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .error-container {
      text-align: center;
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      max-width: 400px;
    }

    .error-container img {
      width: 100px;
      margin-bottom: 20px;
    }

    .error-container h2 {
      color: #ff85d5;
      margin-bottom: 15px;
    }

    .error-container p {
      font-size: 1.2em;
      color: #555;
      margin-bottom: 25px;
    }

    .error-container a {
      text-decoration: none;
      background-color: #ff85d5;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .error-container a:hover {
      background-color: #e072bd;
    }
  </style>
</head>
<body>

  <div class="error-container">
    <img src="img/logo.png" alt="Creaciones Ivy">
    <h2>Ocurrió un error</h2>
    <p><?= htmlspecialchars($mensaje) ?></p>
    <a href="index.php#login">Volver al inicio de sesión</a>
  </div>

</body>
</html>