<?php
include 'config.php';

// Проверяем, передан ли ID категории
if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);

    // Получаем услуги для выбранной категории
    $sql = "SELECT id, name, description, price FROM services WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $services = [];
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }

    $stmt->close();
    $conn->close();

    // Возвращаем услуги в формате JSON
    header('Content-Type: application/json');
    echo json_encode($services);
    exit();
}
?>
