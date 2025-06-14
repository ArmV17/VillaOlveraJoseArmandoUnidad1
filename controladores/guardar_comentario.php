<?php 
session_start();
require '../controladores/conexion.php'; 

if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesión para enviar un comentario.'); window.location.href='../index.php#login';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = trim($_POST['comentario']);
    if (!empty($comentario)) {
        $usuario = $_SESSION['usuario'];

        $stmt = $conn->prepare("INSERT INTO comentarios (usuario, comentario) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $comentario);

        if ($stmt->execute()) {
            echo "<script>alert('Comentario publicado correctamente.'); window.location.href='../vista/creaciones_ivy.php#buzon';</script>";
        } else {
            echo "<script>alert('Error al guardar el comentario.'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('El comentario no puede estar vacío.'); window.history.back();</script>";
    }
} else {
    header("Location: ../index.php");
}
?>