<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Мой To-Do List</h1>
        
        <!-- Форма добавления задачи -->
        <form action="save.php" method="post">
            <input type="text" name="task" placeholder="Новая задача" required>
            <button type="submit">Добавить</button>
        </form>

        <!-- Список задач -->
        <ul>
            <?php
            // Чтение задач из файла
            if (file_exists('tasks.txt')) {
                $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES);
                foreach ($tasks as $id => $task) {
                    $isDone = strpos($task, '[DONE]') !== false;
                    $taskText = htmlspecialchars(str_replace('[DONE] ', '', $task));
                    echo "
                    <li class='" . ($isDone ? 'done' : '') . "'>
                        <form action='save.php' method='post' style='display:inline'>
                            <input type='hidden' name='delete_id' value='$id'>
                            <button type='submit'>❌</button>
                        </form>
                        <form action='save.php' method='post' style='display:inline'>
                            <input type='hidden' name='toggle_id' value='$id'>
                            $taskText
                            <button type='submit'>" . ($isDone ? '✅' : '⬜') . "</button>
                        </form>
                    </li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>