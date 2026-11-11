<?php
include 'conexion.php'; 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];  
    $sql_check = "SELECT * FROM cliente WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email); 
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($result_check->num_rows > 0) {
        echo "Este correo electrónico ya está registrado.";
    } else {
        $sql_registro = "INSERT INTO cliente (nombre, telefono, email, password) VALUES (?, ?, ?, ?)";
        $stmt_registro = $conn->prepare($sql_registro);
        $stmt_registro->bind_param("ssss", $nombre, $telefono, $email, $password);
        if ($stmt_registro->execute()) {
            $sql_sesion = "INSERT INTO cuenta (email, password) VALUES (?, ?)";
            $stmt_sesion = $conn->prepare($sql_sesion);
            $stmt_sesion->bind_param("ss", $email, $password);
            if ($stmt_sesion->execute()) {
                echo "<script>
                        alert('¡Ahora continuemos! ');
                        window.location.href = 'validar_cuenta.html'; //  ...
                      </script>";
            } else {
                echo "Error al guardar los datos de la cuenta: " . $conn->error;
            }
            $stmt_sesion->close();
        } else {
            echo "Error al registrar los datos del cliente: " . $conn->error;
        }
        $stmt_registro->close();
    }
    $stmt_check->close();
    $conn->close();
}
?>
