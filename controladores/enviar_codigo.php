<?php
session_start();
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Validación básica
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Correo no válido'); window.location.href='../index.php#login';</script>";
        exit;
    }

    // Generar código aleatorio de 6 dígitos
    $codigo = rand(100000, 999999);

    // Guardar en sesión (puedes guardarlo en DB si prefieres)
    $_SESSION['codigo_recuperacion'] = $codigo;
    $_SESSION['correo_recuperacion'] = $email;

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'armandorex2@gmail.com';
        $mail->Password = 'bgan ajze crln icyr';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('armandorex2@gmail.com', 'Creaciones Ivy');
        $mail->addAddress($email);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Creaciones Ivy';
        $mail->Body    = "Hola,<br><br>Tu código de recuperación es: <strong>$codigo</strong><br><br>¡No lo compartas con nadie!";

        $mail->send();
        echo "<script>alert('Código enviado a tu correo.'); window.location.href='../controladores/verificar_codigo.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Error al enviar el correo. Inténtalo más tarde.'); window.location.href='../index.php#login';</script>";
    }
} else {
    header('Location: ../index.php');
}
?>