<?php
// Incluir el archivo de conexión
include '../backend/conexion.php';

// Suponiendo que el ID del proveedor está almacenado en la sesión o es pasado como un parámetro
$id_proveedor = 1; // Cambia esto según sea necesario

// Inicializar variables para almacenar los resultados
$solicitudes_pendientes = 0;
$servicios_proximos = 0;
$servicios_completados = 0;
$promedio_calificacion = 0;
$total_valoraciones = 0;

// Consulta para obtener el número de solicitudes pendientes
$sql_pendientes = "SELECT COUNT(*) AS solicitudes_pendientes 
                   FROM Solicitudes 
                   WHERE estado = 'pendiente' AND id_servicio IN 
                   (SELECT id_servicio FROM Servicios WHERE id_proveedor = ?)";
$stmt_pendientes = $conn->prepare($sql_pendientes);
$stmt_pendientes->bind_param("i", $id_proveedor);
$stmt_pendientes->execute();
$result_pendientes = $stmt_pendientes->get_result();
if ($result_pendientes->num_rows > 0) {
    $row = $result_pendientes->fetch_assoc();
    $solicitudes_pendientes = $row['solicitudes_pendientes'];
}

// Consulta para obtener el número de servicios próximos
$sql_proximos = "SELECT COUNT(*) AS servicios_proximos 
                 FROM Solicitudes 
                 WHERE fecha_servicio > CURDATE() AND id_servicio IN 
                 (SELECT id_servicio FROM Servicios WHERE id_proveedor = ?)";
$stmt_proximos = $conn->prepare($sql_proximos);
$stmt_proximos->bind_param("i", $id_proveedor);
$stmt_proximos->execute();
$result_proximos = $stmt_proximos->get_result();
if ($result_proximos->num_rows > 0) {
    $row = $result_proximos->fetch_assoc();
    $servicios_proximos = $row['servicios_proximos'];
}

// Consulta para obtener el número de servicios completados
$sql_completados = "SELECT COUNT(*) AS servicios_completados 
                    FROM Solicitudes 
                    WHERE estado = 'completado' AND id_servicio IN 
                    (SELECT id_servicio FROM Servicios WHERE id_proveedor = ?)";
$stmt_completados = $conn->prepare($sql_completados);
$stmt_completados->bind_param("i", $id_proveedor);
$stmt_completados->execute();
$result_completados = $stmt_completados->get_result();
if ($result_completados->num_rows > 0) {
    $row = $result_completados->fetch_assoc();
    $servicios_completados = $row['servicios_completados'];
}

// Consulta para obtener el promedio de las calificaciones y el total de valoraciones
$sql_valoraciones = "SELECT AVG(calificacion) AS promedio_calificacion, COUNT(*) AS total_valoraciones 
                     FROM Reseñas 
                     WHERE id_servicio IN 
                   (SELECT id_servicio FROM Servicios WHERE id_proveedor = ?)";
$stmt_valoraciones = $conn->prepare($sql_valoraciones);
$stmt_valoraciones->bind_param("i", $id_proveedor);
$stmt_valoraciones->execute();
$result_valoraciones = $stmt_valoraciones->get_result();
if ($result_valoraciones->num_rows > 0) {
    $row = $result_valoraciones->fetch_assoc();
    $promedio_calificacion = number_format($row['promedio_calificacion'], 1); // Redondear a un decimal
    $total_valoraciones = $row['total_valoraciones'];
}

// Cerrar la conexión
$conn->close();
?>

<section class="overview">
    <h2>Resumen</h2>
    <div class="overview-boxes">
        <div class="box">
            <h3>Solicitudes Pendientes</h3>
            <p id="pending-requests"><?php echo $solicitudes_pendientes; ?></p>
        </div>
        <div class="box">
            <h3>Servicios Próximos</h3>
            <p id="upcoming-bookings"><?php echo $servicios_proximos; ?></p>
        </div>
        <div class="box">
            <h3>Historial de Servicios</h3>
            <p id="service-history"><?php echo $servicios_completados; ?> completados</p>
        </div>
        <div class="box">
            <h3>Valoraciones</h3>
            <p id="rating">⭐ <?php echo $promedio_calificacion; ?> (<?php echo $total_valoraciones; ?>)</p>
        </div>
    </div>
</section>
