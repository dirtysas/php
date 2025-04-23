<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>книга отзывов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Оставьте ваш отзыв</h1>
        
        <!-- Форма отправки сообщения -->
        <form action="save.php" method="post">
            <input type="text" name="name" placeholder="Ваше имя" required>
            <input type="email" name="email" placeholder="Ваш email" required>
            <textarea name="message" placeholder="Ваше сообщение" rows="5" required></textarea>
            <button type="submit">Отправить</button>
        </form>

        <!-- Список сообщений -->
        <div class="messages">
            <?php
            if (file_exists('messages.json')) {
                $messages = json_decode(file_get_contents('messages.json'), true);
                if (!empty($messages)) {
                    foreach ($messages as $msg) {
                        echo '<div class="message">';
                        echo '<h3>' . htmlspecialchars($msg['name']) . '</h3>';
                        echo '<p class="meta">' . htmlspecialchars($msg['email']) . ' | ' . $msg['date'] . '</p>';
                        echo '<p>' . nl2br(htmlspecialchars($msg['message'])) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Пока нет сообщений.</p>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>