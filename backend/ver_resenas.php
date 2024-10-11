<?php
// Incluir el archivo de conexión
include '../backend/conexion.php';

// Suponiendo que tienes el ID del proveedor almacenado en una variable
$id_proveedor = 1; // Cambia esto según sea necesario, posiblemente del usuario logueado

// Consulta para obtener todas las reseñas del proveedor específico
$sql = "
    SELECT 
        Reseñas.calificacion,
        Reseñas.comentarios,
        Clientes.nombre AS nombre_cliente,
        Servicios.descripcion AS descripcion_servicio
    FROM 
        Reseñas
    JOIN 
        Clientes ON Reseñas.id_cliente = Clientes.id_cliente
    JOIN 
        Servicios ON Reseñas.id_servicio = Servicios.id_servicio
    WHERE 
        Servicios.id_proveedor = ? -- Agregar la condición para filtrar por id_proveedor
    ORDER BY 
        Reseñas.calificacion DESC
";

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
        // Iniciar la salida HTML
        echo '<div id="review-list">';
        
        // Salida de datos de cada fila
        while ($row = $result->fetch_assoc()) {
            // Convertir la calificación numérica en estrellas
            $calificacion = str_repeat('★', $row["calificacion"]) . str_repeat('☆', 5 - $row["calificacion"]);
            
            echo '<div class="review-item">';
            echo '<p>Cliente: ' . htmlspecialchars($row["nombre_cliente"]) . '</p>';
            echo '<p>Comentario: "' . htmlspecialchars($row["comentarios"]) . '"</p>';
            echo '<p>Calificación: ' . $calificacion . '</p>';
            echo '</div>'; // cerrar review-item
        }
        
        // Cerrar el contenedor de reseñas
        echo '</div>';
    } else {
        echo '<p>No se encontraron reseñas.</p>';
    }
    
    // Cerrar la declaración
    $stmt->close();
} else {
    echo '<p>Error en la preparación de la consulta: ' . $conn->error . '</p>';
}

// Cerrar la conexión
$conn->close();
?>
