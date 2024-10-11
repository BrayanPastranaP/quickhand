<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/registro-estilos.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-content">
                <h1>Registro usuario</h1>
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
