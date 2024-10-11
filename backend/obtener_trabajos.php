<?php
// Incluir el archivo de conexión a la base de datos
include '../backend/conexion.php';

// ID del proveedor, este valor podría ser dinámico según el usuario logueado
$id_proveedor = 1; // Cambia esto según sea necesario

// Consulta para obtener los trabajos reservados
$sql = "
SELECT 
    S.descripcion AS title,                      -- Título del servicio
    DATE(So.fecha_servicio) AS start,          -- Fecha del servicio (start date) sin hora
    DATE(So.fecha_servicio) AS end,            -- Fecha del servicio (end date) sin hora
    So.comentarios_cliente AS description        -- Descripción del trabajo
FROM 
    Servicios S
JOIN 
    Solicitudes So ON S.id_servicio = So.id_servicio
JOIN 
    Proveedores P ON S.id_proveedor = P.id_proveedor
WHERE 
    P.id_proveedor = ?";                         // Filtrar por ID del proveedor

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_proveedor);
$stmt->execute();
$result = $stmt->get_result();

// Inicializar un array para almacenar los trabajos reservados
$reservedJobs = [];

if ($result->num_rows > 0) {
    // Obtener los datos y llenar el array
    while ($row = $result->fetch_assoc()) {
        $reservedJobs[] = [
            'title' => $row['title'],
            'start' => $row['start'],               // Solo fecha
            'end' => $row['end'],                   // Solo fecha
            'description' => $row['description']
        ];
    }
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Establecer el encabezado de la respuesta como JSON
header('Content-Type: application/json');

// Devolver los trabajos reservados en formato JSON
echo json_encode($reservedJobs);
?>
