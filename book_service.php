<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header('Location: auth.php');
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$service_id = $_POST['service_id'];
$appointment_date = $_POST['appointment_date'];

$sql = "INSERT INTO service_bookings (user_id, service_id, appointment_date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $user_id, $service_id, $appointment_date);

if ($stmt->execute()) {
    echo "Запись успешно добавлена!";
} else {
    echo "Ошибка при записи: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
