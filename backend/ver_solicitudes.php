<?php
// Incluir el archivo de conexión a la base de datos
include '../backend/conexion.php';

// Suponiendo que tienes el ID del proveedor almacenado en una variable
$id_proveedor = 1; // Cambia esto según sea necesario, posiblemente del usuario logueado

// Consulta para obtener todas las solicitudes y sus relaciones, filtrando por id_proveedor
$sql = "SELECT 
            Solicitudes.id_solicitud,
            Servicios.descripcion AS descripcion_servicio,
            Clientes.nombre AS nombre_cliente,
            Solicitudes.comentarios_cliente,
            Solicitudes.fecha_solicitud,
            Solicitudes.fecha_servicio,
            Solicitudes.estado
        FROM 
            Solicitudes
        JOIN 
            Servicios ON Solicitudes.id_servicio = Servicios.id_servicio
        JOIN 
            Clientes ON Solicitudes.id_cliente = Clientes.id_cliente
        WHERE 
            Servicios.id_proveedor = ?"; // Agregar la condición para filtrar por id_proveedor

// Preparar la consulta
if ($stmt = $conn->prepare($sql)) {
    // Asignar los parámetros
    $stmt->bind_param("i", $id_proveedor); // El id_proveedor es un entero
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener los resultados
    $result = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Iterar sobre los resultados y generar el HTML dinámicamente
        while ($row = $result->fetch_assoc()) {
            echo '<div class="request-item">';
            echo '<p>Solicitud de servicio: ' . htmlspecialchars($row["descripcion_servicio"]) . '</p>';
            echo '<p>Cliente: ' . htmlspecialchars($row["nombre_cliente"]) . '</p>';
            echo '<p class="client-comments">Comentarios del cliente: <span>' . htmlspecialchars($row["comentarios_cliente"] ? $row["comentarios_cliente"] : "No hay comentarios") . '</span></p>';
            echo '<p class="request-date">Fecha de solicitud: <span>' . htmlspecialchars($row["fecha_solicitud"]) . '</span></p>';
            echo '<p>Estado: <span class="status">' . htmlspecialchars($row["estado"]) . '</span></p>';
            echo '<div class="buttons-container">';
            echo '<button class="accept">Aceptar</button>';
            echo '<button class="reject">Rechazar</button>';
            echo '<button class="complete" style="display: none">Marcar como completada</button>';
            echo '</div>'; // Cerrar buttons-container
            echo '</div>'; // Cerrar request-item
        }
    } else {
        echo '<p>No se encontraron solicitudes.</p>';
    }
    
    // Cerrar la declaración
    $stmt->close();
} else {
    echo '<p>Error en la preparación de la consulta: ' . $conn->error . '</p>';
}

// Cerrar la conexión
$conn->close();
?>
