<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "truebeauty"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "truebeauty"; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>