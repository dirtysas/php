<?php
// Валидация данных
$errors = [];
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Проверка имени
if (empty($name)) {
    $errors[] = "Имя обязательно для заполнения.";
}

// Проверка email
if (!filter_var($email, с)) {
    $errors[] = "Некорректный email.";
}

// Проверка сообщения
if (empty($message)) {
    $errors[] = "Сообщение не может быть пустым.";
}

// Если есть ошибки — показываем их
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
    echo '<a href="index.php">Вернуться</a>';
    exit;
}

// Чтение и обновление сообщений
$messages = [];
if (file_exists('messages.json')) {
    $messages = json_decode(file_get_contents('messages.json'), true);
}

// Добавление нового сообщения
$messages[] = [
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'date' => date('d.m.Y H:i')
];

// Сохранение в JSON
file_put_contents('messages.json', json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Перенаправление на главную
header('Location: index.php');
exit;