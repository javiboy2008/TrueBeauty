<?php
include 'conexion.php';

$nombre_cliente = $_POST['nombre_cliente'];
$metodo_pago = $_POST['pago'];
$total = $_POST['total_hidden'];
$productos = $_POST['carrito_data']; // viene en JSON

$nombre_tarjeta = $_POST['nombre_tarjeta'] ?? '';
$numero_tarjeta = $_POST['numero_tarjeta'] ?? '';
$expiracion = $_POST['expiracion'] ?? '';
$cvv = $_POST['cvv'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$referencia = $_POST['referencia'] ?? '';

$stmt = $conn->prepare("INSERT INTO compras (nombre_cliente, metodo_pago, nombre_tarjeta, numero_tarjeta, expiracion, cvv, direccion, referencia, productos, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssd", $nombre_cliente, $metodo_pago, $nombre_tarjeta, $numero_tarjeta, $expiracion, $cvv, $direccion, $referencia, $productos, $total);

if($stmt->execute()){
    echo "<script>alert('¡Compra realizada y guardada en la base de datos con éxito!'); localStorage.removeItem('carrito'); window.location.href='PAG4.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}
?>