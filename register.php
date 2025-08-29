<?php
require_once('db.php');

$login = $_POST['login'];
$pass = $_POST['pass'];
$repeatpass = $_POST['repeatpass'];
$email = $_POST['email'];

if(empty($login) || empty($pass) || empty($repeatpass) || empty($email)){
    echo "Заполните все поля";
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Неверный формат email";
        exit;
    }
    
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $emailResult = $checkEmail->get_result();
    
    if ($emailResult->num_rows > 0) {
        echo "Email уже зарегистрирован";
        exit;
    }
    
    $checkLogin = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $checkLogin->bind_param("s", $login);
    $checkLogin->execute();
    $loginResult = $checkLogin->get_result();
    
    if ($loginResult->num_rows > 0) {
        echo "Логин уже занят";
        exit;
    }
    
    if($pass != $repeatpass){
        echo "Пароли не совпадают";
    } else {
        $sql = "INSERT INTO users (login, pass, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $login, $pass, $email);
        
        if($stmt->execute()){
            echo "Успешная регистрация";
        } else {
            echo "Ошибка: " . $conn->error;
        }
    }
}
?>