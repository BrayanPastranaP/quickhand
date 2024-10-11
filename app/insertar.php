<?php
// Datos de la conexión a la base de datos
include 'config.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];

    // Encriptar la contraseña
    $password_hash = password_hash($pass, PASSWORD_BCRYPT);

    // Preparar la consulta de inserción
    $sql = "INSERT INTO usuarios (usuario, nombre, correo, pass) VALUES (?, ?, ?, ?)";

    // Preparar la sentencia SQL
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        $stmt->bind_param("ssss", $usuario, $nombre, $correo, $password_hash);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro exitoso.";
            header("Location: usuario.php");
            exit(); // Siempre es una buena práctica usar exit después de redirigir
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
