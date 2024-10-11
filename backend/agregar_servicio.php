<?php
// Incluir el archivo de conexión
include '../backend/conexion.php';

// Verificar si se han enviado datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_servicio = $_POST['service-name'];
    $descripcion = $_POST['service-description'];
    $ubicacion = $_POST['service-location'];
    $precio = $_POST['service-price'];
    $categorias = $_POST['service-categories'];
    $tags = $_POST['service-tags'];
    $id_proveedor = 1; // Cambia esto según sea necesario, por ejemplo, el ID del proveedor logueado

    // Consulta para insertar el nuevo servicio
    $sql = "INSERT INTO Servicios (id_proveedor, descripcion, ubicacion, precio) VALUES (?, ?, ?, ?)";

    // Preparar la consulta
    if ($stmt = $conn->prepare($sql)) {
        // Asignar los parámetros
        $stmt->bind_param("issd", $id_proveedor, $nombre_servicio, $ubicacion, $precio);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            $id_servicio = $stmt->insert_id; // Obtener el ID del nuevo servicio

            // Insertar categorías
            $categorias_array = explode(',', $categorias);
            foreach ($categorias_array as $categoria) {
                $categoria = trim($categoria); // Eliminar espacios en blanco
                // Asumimos que el nombre de la categoría es correcto
                $sql_categoria = "INSERT INTO servicio_categoria (id_servicio, id_categoria) 
                                  SELECT ?, id_categoria FROM categorias WHERE nombre = ?";
                if ($stmt_categoria = $conn->prepare($sql_categoria)) {
                    $stmt_categoria->bind_param("is", $id_servicio, $categoria);
                    $stmt_categoria->execute();
                    $stmt_categoria->close();
                }
            }

            // Insertar tags
            $tags_array = explode(',', $tags);
            foreach ($tags_array as $tag) {
                $tag = trim($tag); // Eliminar espacios en blanco
                // Asumimos que el nombre del tag es correcto
                $sql_tag = "INSERT INTO servicio_tag (id_servicio, id_tag) 
                            SELECT ?, id_tag FROM tags WHERE nombre = ?";
                if ($stmt_tag = $conn->prepare($sql_tag)) {
                    $stmt_tag->bind_param("is", $id_servicio, $tag);
                    $stmt_tag->execute();
                    $stmt_tag->close();
                }
            }

            echo json_encode(["status" => "success", "message" => "Servicio agregado exitosamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al agregar el servicio: " . $stmt->error]);
        }
        
        // Cerrar la declaración
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error al preparar la consulta: " . $conn->error]);
    }
}

// Cerrar la conexión
$conn->close();
?>
