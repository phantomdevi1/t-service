<?php
session_start();

include 'config.php';

// Проверка на получение ID услуги
if (isset($_GET['service_id'])) {
    $service_id = intval($_GET['service_id']);
    $booked_dates = [];

    // Если передана дата, выбираем только временные слоты на эту дату
    if (isset($_GET['appointment_date'])) {
        $appointment_date = $_GET['appointment_date'];

        // Запрос занятых временных слотов для указанной даты
        $sql = "SELECT TIME(appointment_date) AS booked_time FROM service_bookings WHERE service_id = ? AND DATE(appointment_date) = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $service_id, $appointment_date);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $booked_dates[] = $row['booked_time'];
        }
    } else {
        // Если дата не передана, выбираем все занятые даты для данной услуги
        $sql = "SELECT DATE(appointment_date) AS booked_date FROM service_bookings WHERE service_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $service_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $booked_dates[] = $row['booked_date'];
        }
    }

    $stmt->close();
    $conn->close();

    // Возвращаем занятые даты или временные слоты в формате JSON
    header('Content-Type: application/json');
    echo json_encode($booked_dates);
    exit();
}
?>
