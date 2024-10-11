<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia si usas otro servidor
$username = "root"; // Cambia por tu usuario de MySQL
$password = ""; // Cambia por tu contraseña de MySQL
$database = "marketplace"; // Cambia por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
