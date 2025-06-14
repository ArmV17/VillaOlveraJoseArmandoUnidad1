<?php
session_start();
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);

    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'armandorex2@gmail.com'; 
            $mail->Password = 'bgan ajze crln icyr';   
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configuración del correo
            $mail->setFrom('armandorex2@gmail.com', 'Creaciones Ivy');
            $mail->addAddress('armandorex2@gmail.com', 'Soporte Creaciones Ivy');

            $mail->isHTML(true);
            $mail->Subject = 'Consulta de Ayuda - Creaciones Ivy';
            $mail->Body = "
              <h3>Detalles de la Consulta</h3>
              <p><strong>Nombre:</strong> {$nombre}</p>
              <p><strong>Email:</strong> {$email}</p>
              <p><strong>Mensaje:</strong><br>{$mensaje}</p>
            ";

            $mail->send();

            // Detección del origen
            $referer = $_SERVER['HTTP_REFERER'];
            if (strpos($referer, 'creaciones_ivy.php') !== false) {
                echo "<script>alert('Tu consulta ha sido enviada correctamente. ¡Gracias por contactarnos!'); window.location.href='../vista/creaciones_ivy.php#contacto';</script>";
            } else {
                echo "<script>alert('Tu consulta ha sido enviada correctamente. ¡Gracias por contactarnos!'); window.location.href='../index.php#contacto';</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Error al enviar el correo. Intenta más tarde.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
    }
} else {
    header('Location: ../index.php');
}
?>
