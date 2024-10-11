<?php
// config.php
$host = 'localhost'; // Cambia esto si tu servidor es diferente
$db = 'marketplace'; // Cambia esto por el nombre de tu base de datos
$user = 'root'; // Cambia esto por tu usuario
$pass = ''; // Cambia esto por tu contraseña

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
