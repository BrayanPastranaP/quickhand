<?php
// Consulta para obtener todos los servicios con sus categorías y tags
$sql = "
SELECT 
    s.id_servicio,
    s.id_proveedor,
    s.descripcion,
    s.ubicacion,
    s.precio,
    GROUP_CONCAT(DISTINCT c.nombre SEPARATOR ', ') AS categorias,
    GROUP_CONCAT(DISTINCT t.nombre SEPARATOR ', ') AS tags
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
GROUP BY 
    s.id_servicio;
";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo '<div class="service-item">';
        echo '<h3>' . htmlspecialchars($row["descripcion"]) . '</h3>';
        echo '<p><strong>Descripción:</strong> ' . htmlspecialchars($row["descripcion"]) . '</p>';
        echo '<p><strong>Ubicación:</strong> ' . htmlspecialchars($row["ubicacion"]) . '</p>';
        echo '<p><strong>Precio:</strong> $' . htmlspecialchars($row["precio"]) . '</p>';
        echo '<p><strong>Categorías:</strong> ' . htmlspecialchars($row["categorias"]) . '</p>';
        echo '<p><strong>Tags:</strong> ' . htmlspecialchars($row["tags"]) . '</p>';
        echo '<div class="service-buttons">';
        echo '<button class="edit">Editar</button>';
        echo '<button class="delete">Eliminar</button>';
        echo '</div>';
        echo '</div>'; // cerrar service-item
    }
} else {
    echo '<p>No se encontraron servicios.</p>';
}

// Cerrar la conexión
$conn->close();
?>
