<?php
session_start();

// Credenciales fijas para validar el inicio de sesión de administrador
$correo_valido = "admin@gmail.com";
$contrasena_valida = "admin123";

$mensaje_error = "";

// Cerrar sesión si se envía ?salir=1
if (isset($_GET["salir"])) {
    session_unset();
    session_destroy();
    header("Location: sesion_admin.php");
    exit;
}

// Validar cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo_ingresado = trim($_POST["correo"] ?? "");
    $contrasena_ingresada = $_POST["contrasena"] ?? "";

    if ($correo_ingresado === $correo_valido && $contrasena_ingresada === $contrasena_valida) {
        $_SESSION["rol"] = "Administrador";
        $_SESSION["correo_admin"] = $correo_ingresado;
        header("Location: PAG_ADMIN.html");
        exit;
    } else {
        $mensaje_error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Administrador - TrueBeauty</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .caja {
            background: #ffffff;
            padding: 24px;
            border-radius: 8px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 16px;
            width: 100%;
            padding: 10px;
            cursor: pointer;
        }
        .error {
            color: #b00020;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="caja">
        <h2>Acceso Administrador</h2>

        <?php if ($mensaje_error !== ""): ?>
            <p class="error"><?php echo htmlspecialchars($mensaje_error); ?></p>
        <?php endif; ?>

        <form method="POST" action="sesion_admin.php">
            <label for="correo">Correo</label>
            <input
                type="email"
                id="correo"
                name="correo"
                value="admin@gmail.com"
                onfocus="this.value=''"
                required
            >

            <label for="contrasena">Contraseña</label>
            <input
                type="text"
                id="contrasena"
                name="contrasena"
                value="admin123"
                onfocus="this.value=''"
                required
            >

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>