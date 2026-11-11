<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (empty($email) || empty($password)) {
        echo "<p>El email o la contraseña están vacíos. Por favor, ingresa ambos campos.</p>";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Por favor, ingresa un email válido.</p>";
        exit;
    }
    $sql = "SELECT * FROM cuenta WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            echo "<script>
                    alert('¡Felicidades tu inicio de sesión ha sido exitoso! Bienvenido a casa...');
                    window.location.href = 'PAG4.html';
                  </script>";
        } else {
            echo "<p>Ups! contraseña incorrecta. Por favor, inténtalo de nuevo.</p>";
        }
    } else {
        echo "<p>No seas tramposillx. ¡Por favor, regístrate primero!.</p>";
    }
    $stmt->close();
    $conn->close();
}
?>
