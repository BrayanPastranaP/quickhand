<?php

if (!isset($serviceId) || $serviceId <= 0) {
    echo json_encode(['error' => 'ID de servicio no proporcionado o inválido.']);
    return; // Termina la ejecución si no hay un ID válido
}

// Consulta para obtener la información del servicio
$sql_service = "
SELECT 
    s.id_servicio,
    s.id_proveedor,
    s.descripcion,
    s.ubicacion,
    s.precio,
    GROUP_CONCAT(DISTINCT c.nombre SEPARATOR ', ') AS categorias,
    GROUP_CONCAT(DISTINCT t.nombre SEPARATOR ', ') AS tags,
    p.nombre AS proveedor_nombre,
    p.ubicacion_trabajo,
    p.areas_expertise,
    p.idiomas
FROM 
    Servicios s
LEFT JOIN 
    Servicio_Categoria sc ON s.id_servicio = sc.id_servicio
LEFT JOIN 
    Categorias c ON sc.id_categoria = c.id_categoria
LEFT JOIN 
    Servicio_Tag st ON s.id_servicio = st.id_servicio
LEFT JOIN 
    Tags t ON st.id_tag = t.id_tag
LEFT JOIN 
    Proveedores p ON s.id_proveedor = p.id_proveedor
WHERE 
    s.id_servicio = ?
GROUP BY 
    s.id_servicio;
";

$stmt_service = $conn->prepare($sql_service);
$stmt_service->bind_param('i', $serviceId);
$stmt_service->execute();
$result_service = $stmt_service->get_result();

if ($result_service->num_rows > 0) {
    $service = $result_service->fetch_assoc();

    // Inicializar el arreglo para reseñas
    $service['reseñas'] = [];

    // Consulta para obtener las reseñas del servicio
    $sql_reviews = "
    SELECT 
        r.calificacion,
        r.comentarios,
        DATE_FORMAT(r.fecha, '%Y-%m-%d %H:%i:%s') AS fecha, -- Formato de fecha
        cl.nombre AS cliente_nombre
    FROM 
        Reseñas r
    LEFT JOIN 
        Clientes cl ON r.id_cliente = cl.id_cliente
    WHERE 
        r.id_servicio = ?  -- Asegúrate de filtrar por el id_servicio
    ORDER BY 
        r.fecha DESC;
    ";

    $stmt_reviews = $conn->prepare($sql_reviews);
    $stmt_reviews->bind_param('i', $serviceId);
    $stmt_reviews->execute();
    $result_reviews = $stmt_reviews->get_result();

    // Solo se almacenan las reseñas que corresponden al servicio
    while ($row_review = $result_reviews->fetch_assoc()) {
        $service['reseñas'][] = $row_review;  // Agregar la reseña al servicio
    }

    // Retornar la información como JSON
   

} else {
    echo json_encode(['error' => 'No se encontró información para el servicio con ID ' . $serviceId . '.']);
}

$stmt_service->close();
$stmt_reviews->close();
$conn->close();
?>



