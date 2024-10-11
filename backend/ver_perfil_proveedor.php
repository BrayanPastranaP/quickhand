<?php
// Incluir el archivo de conexión a la base de datos
include '../backend/conexion.php';

// Suponiendo que el ID del proveedor está almacenado en la sesión o es pasado como un parámetro
$id_proveedor = 1; // Reemplazar con el valor dinámico si es necesario

// Consulta para obtener los datos del proveedor
$sql = "SELECT 
            Proveedores.nombre,
            Proveedores.descripcion,
            Proveedores.areas_expertise,
            Proveedores.ubicacion_trabajo,
            Proveedores.idiomas,
            Imagenes.ruta AS imagen_perfil
        FROM 
            Proveedores
        LEFT JOIN
            Imagenes ON Proveedores.imagen_perfil = Imagenes.id_imagen
        WHERE 
            Proveedores.id_proveedor = ?";

// Preparar la declaración
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_proveedor);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Generar el HTML con los datos del proveedor
    echo '<form action="actualizar_perfil.php" method="POST" enctype="multipart/form-data">';
    
    // Mostrar la imagen del proveedor si existe
    if (!empty($row["imagen_perfil"])) {
        echo '<label for="provider-image">Imagen del Proveedor:</label>';
        echo '<div class="image-preview">';
        echo '<img src="' . htmlspecialchars($row["imagen_perfil"]) . '" alt="Imagen del Proveedor" id="provider-image" class="profile-image">';
        echo '</div>';
    }
    
    echo '<label for="new-image">Subir nueva imagen:</label>';
    echo '<input type="file" id="new-image" name="new-image" accept="image/*">';
    
    echo '<label for="service-description">Descripción del Servicio:</label>';
    echo '<textarea id="service-description" name="service-description" rows="3" required>' . htmlspecialchars($row["descripcion"]) . '</textarea>';
    
    echo '<label for="expertise-areas">Áreas de Expertise:</label>';
    echo '<input type="text" id="expertise-areas" name="expertise-areas" value="' . htmlspecialchars($row["areas_expertise"]) . '" required>';
    
    echo '<label for="work-location">Área de trabajo:</label>';
    echo '<select id="work-location" name="work-location" required>';
    echo '<option value="" disabled>Selecciona tu estado</option>';
    
    // Estados de México (puedes agregar todos los estados que necesites)
    $estados_mexico = [
        "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas", 
        "Chihuahua", "Coahuila", "Colima", "Durango", "Guanajuato", "Guerrero", "Hidalgo", 
        "Jalisco", "Mexico", "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca", 
        "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", "Sinaloa", "Sonora", 
        "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
    ];
    
    foreach ($estados_mexico as $estado) {
        $selected = ($estado == $row["ubicacion_trabajo"]) ? "selected" : "";
        echo '<option value="' . $estado . '" ' . $selected . '>' . $estado . '</option>';
    }
    
    echo '</select>';
    
    echo '<label for="languages">Idiomas:</label>';
    echo '<input type="text" id="languages" name="languages" value="' . htmlspecialchars($row["idiomas"]) . '" required>';
    
    echo '<button type="submit">Guardar Cambios</button>';
    echo '</form>';
} else {
    echo '<p>No se encontraron datos para este proveedor.</p>';
}

// Cerrar la conexión
$conn->close();
?>
