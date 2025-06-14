<?php
session_start();
require '../controladores/conexion.php';

if (!isset($_SESSION['correo_recuperacion']) || !isset($_SESSION['codigo_recuperacion'])) {
    echo "<script>alert('No tienes un proceso de recuperación activo.'); window.location.href='../index.php#login';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_ingresado = trim($_POST['codigo']);
    $nueva_contra = trim($_POST['nueva_contrasena']);
    $confirmar_contra = trim($_POST['confirmar_contrasena']);
    $correo = $_SESSION['correo_recuperacion'];

    if ($codigo_ingresado == $_SESSION['codigo_recuperacion']) {
        if ($nueva_contra === $confirmar_contra) {
            $nueva_contra_hash = password_hash($nueva_contra, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $nueva_contra_hash, $correo);

            if ($stmt->execute()) {
                unset($_SESSION['correo_recuperacion']);
                unset($_SESSION['codigo_recuperacion']);

                echo "<script>
                    alert('Contraseña actualizada correctamente. Ahora puedes iniciar sesión.');
                    window.location.href='../index.php#login';
                </script>";
            } else {
                echo "<script>alert('Hubo un error actualizando la contraseña.'); window.location.href='../index.php#login';</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Código incorrecto. Inténtalo de nuevo.'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verificar Código - Creaciones Ivy</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <section class="hero" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="hero-form-card" style="max-width: 400px; width: 100%; margin: auto;">
      <h2 style="color: #ff85d5; text-align: center; margin-bottom: 10px;">Recuperar Contraseña</h2>
      <p style="text-align: center; margin-bottom: 20px;">Introduce el código que te enviamos a tu correo y elige tu nueva contraseña.</p>
      <form method="POST" action="">
        <input type="text" name="codigo" placeholder="Código de recuperación" pattern="\d{6}" maxlength="6" required>
        <div style="position: relative;">
          <input type="password" name="nueva_contrasena" id="nueva_contrasena" placeholder="Nueva Contraseña" pattern=".{6,20}" title="Entre 6 y 20 caracteres" required style="width: 100%; padding-right: 40px;">
          <span onclick="mostrarPassword('nueva_contrasena')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
            <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="#ccc">
              <path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12c-2.7 0-5-2.3-5-5s2.3-5 5-5 5 2.3 5 5-2.3 5-5 5z"/>
              <circle cx="12" cy="12" r="2.5"/>
            </svg>
          </span>
        </div>
        <div style="position: relative;">
          <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar Nueva Contraseña" pattern=".{6,20}" title="Entre 6 y 20 caracteres" required style="width: 100%; padding-right: 40px;">
          <span onclick="mostrarPassword('confirmar_contrasena')" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
            <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="#ccc">
              <path d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 12c-2.7 0-5-2.3-5-5s2.3-5 5-5 5 2.3 5 5-2.3 5-5 5z"/>
              <circle cx="12" cy="12" r="2.5"/>
            </svg>
          </span>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%;">Actualizar Contraseña</button>
      </form>
    </div>
  </section>

  <script>
    function mostrarPassword(inputId) {
      const passwordInput = document.getElementById(inputId);
      const eyeIcon = document.getElementById('eyeIcon' + (inputId === 'nueva_contrasena' ? '1' : '2'));

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('fill', '#fff');
      } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('fill', '#ccc');
      }
    }
  </script>
</body>
</html>