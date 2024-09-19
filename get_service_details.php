<?php
include 'config.php';

$service_id = $_GET['service_id'];

$sql = "SELECT id, name, description, price FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

$service = $result->fetch_assoc();

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($service);
?>
