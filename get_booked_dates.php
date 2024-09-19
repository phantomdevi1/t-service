<?php
session_start();

include 'config.php';

// Проверка на получение ID услуги
if (isset($_GET['service_id'])) {
    $service_id = intval($_GET['service_id']);

    // Получение всех занятых дат для конкретной услуги
    $sql = "SELECT appointment_date FROM service_bookings WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $booked_dates = [];
    while ($row = $result->fetch_assoc()) {
        // Добавляем каждую занятую дату в массив
        $booked_dates[] = $row['appointment_date'];
    }

    $stmt->close();
    $conn->close();

    // Возвращаем занятые даты в формате JSON
    header('Content-Type: application/json');
    echo json_encode($booked_dates);
    exit();
}
?>
