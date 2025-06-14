<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    if (empty($usuario) || empty($password)) {
        header('Location: ../error.php?tipo=campos');
        exit();
    }

    // Usamos consulta preparada para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? LIMIT 1");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['usuario'] = $usuario;
            header('Location: ../vista/creaciones_ivy.php');
            exit();
        } else {
            // Contraseña incorrecta
            header('Location: ../error.php?tipo=contrasena');
            exit();
        }
    } else {
        // Usuario no encontrado
        header('Location: ../error.php?tipo=usuario');
        exit();
    }
}

$conn->close();
?>