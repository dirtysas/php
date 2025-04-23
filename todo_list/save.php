<?php
// Загрузка задач из файла
$tasks = file_exists('tasks.txt') ? file('tasks.txt', FILE_IGNORE_NEW_LINES) : [];

// Добавление задачи
if (!empty($_POST['task'])) {
    $newTask = trim($_POST['task']);
    if (!empty($newTask)) {
        $tasks[] = $newTask;
    }
}

// Удаление задачи
if (isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    if (isset($tasks[$id])) {
        unset($tasks[$id]);
    }
}

// Отметка как выполненной
if (isset($_POST['toggle_id'])) {
    $id = (int)$_POST['toggle_id'];
    if (isset($tasks[$id])) {
        $tasks[$id] = strpos($tasks[$id], '[DONE]') === false 
            ? "[DONE] " . $tasks[$id] 
            : str_replace('[DONE] ', '', $tasks[$id]);
    }
}

// Сохранение задач в файл
file_put_contents('tasks.txt', implode(PHP_EOL, $tasks));

// Возврат на главную
header('Location: index.php');
exit;