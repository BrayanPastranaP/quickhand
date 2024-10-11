<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro pa chambear</title>
    <link rel="stylesheet" href="css/registro-estilos.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-content">
                <p>Por favor, completa el formulario para crear una cuenta.</p>
                <form action="app/insertar.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="nombre" placeholder="Nombre completo" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="correo" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="pass" placeholder="Contraseña" required>
                    </div>
                    <div class="input-group">
                        <input type="number" name="edad" placeholder="Edad" required min="0">
                    </div>
                    <div class="input-group">
                        <select name="estado" required>
                            <option value="">Selecciona tu estado</option>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Mexico">Estado de México</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <select name="genero" required>
                            <option value="">Selecciona tu género</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <textarea name="descripcion" placeholder="Descripción de la persona" required></textarea>
                    </div>
                    <button type="submit">Registrar</button>
                    <p class="signin-link">¿Ya tienes una cuenta? <a href="index.html">Inicia sesión aquí</a></p>
                </form>


            </div>
        </div>
        <div class="image-container">
        </div>
    </div>
</body>

</html>