<?php
session_start();
include '../controladores/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar reCAPTCHA
    $recaptcha_secret = "6Lfb7VgrAAAAAFmJVNYKOK7hg8lb6mE62QMEjND6";
    $recaptcha_response = $_POST['g-recaptcha-response'];

    if (empty($recaptcha_response)) {
        $_SESSION['error_recaptcha'] = "⚠️ Por favor valida que no eres un robot realizando el reCAPTCHA.";
        header("Location: ../index.php#register");
        exit();
    }

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $response = json_decode($verify);

    if (!$response->success) {
        $_SESSION['error_recaptcha'] = "❌ Verificación fallida del reCAPTCHA. Intenta nuevamente.";
        header("Location: ../index.php#register");
        exit();
    }

    // Validaciones del formulario
    $usuario = trim($_POST['usuario']);
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $codigo_pais = trim($_POST['codigo_pais']);
    $whatsapp = trim($_POST['whatsapp']);
    $password = $_POST['password'];

    if (!preg_match('/^[A-Za-z0-9_]{4,20}$/', $usuario)) {
        $_SESSION['error_recaptcha'] = "⚠️ Usuario inválido.";
        header("Location: ../index.php#register"); exit();
    }

    if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ ]{3,50}$/', $nombre)) {
        $_SESSION['error_recaptcha'] = "⚠️ Nombre inválido.";
        header("Location: ../index.php#register"); exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_recaptcha'] = "⚠️ Correo electrónico inválido.";
        header("Location: ../index.php#register"); exit();
    }

    if (!preg_match('/^[0-9]{10}$/', $whatsapp)) {
        $_SESSION['error_recaptcha'] = "⚠️ WhatsApp debe tener exactamente 10 números.";
        header("Location: ../index.php#register"); exit();
    }

    if (strlen($password) < 6 || strlen($password) > 20) {
        $_SESSION['error_recaptcha'] = "⚠️ La contraseña debe tener entre 6 y 20 caracteres.";
        header("Location: ../index.php#register"); exit();
    }

    // Comprobar si usuario o correo existen
    $check_user = "SELECT id FROM usuarios WHERE usuario = '$usuario' LIMIT 1";
    $check_email = "SELECT id FROM usuarios WHERE email = '$email' LIMIT 1";

    $user_result = $conn->query($check_user);
    $email_result = $conn->query($check_email);

    if ($user_result->num_rows > 0) {
        $_SESSION['error_recaptcha'] = "⚠️ El nombre de usuario ya existe.";
        header("Location: ../index.php#register"); exit();
    }

    if ($email_result->num_rows > 0) {
        $_SESSION['error_recaptcha'] = "⚠️ El correo electrónico ya está registrado.";
        header("Location: ../index.php#register"); exit();
    }

    // Si todo está bien, registramos
    $telefono_completo = $codigo_pais . $whatsapp;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (usuario, nombre, email, whatsapp, password) 
            VALUES ('$usuario', '$nombre', '$email', '$telefono_completo', '$password_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('¡Registro exitoso!'); window.location.href='../index.php';</script>";
    } else {
        $_SESSION['error_recaptcha'] = "❌ Error al registrar: " . $conn->error;
        header("Location: ../index.php#register");
    }
}

$conn->close();
?>