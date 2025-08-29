<?php
require_once('db.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['available' => false, 'message' => 'Неверный формат email']);
            exit;
        }
        
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode(['available' => false, 'message' => 'Email уже зарегистрирован']);
        } else {
            echo json_encode(['available' => true, 'message' => 'Email доступен']);
        }
    } else {
        echo json_encode(['available' => false, 'message' => 'Email не предоставлен']);
    }
} else {
    echo json_encode(['available' => false, 'message' => 'Неверный метод запроса']);
}
?>