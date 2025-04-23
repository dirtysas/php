<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f0f0;
        }

        .calculator {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        button {
            background: rgb(235, 132, 63);
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        /* Стили для поля результата */
        .result-field {
            margin-top: 15px;
            padding: 10px;
            background: rgb(0, 0, 0);
            border-radius: 5px;
            color: white; /* Белый текст на черном фоне */
            border: none;
            pointer-events: none; /* Запрет взаимодействия */
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Калькулятор</h2>
        <form method="post" action="">
            <input type="number" step="any" name="num1" placeholder="Первое число" required>
            
            <select name="operator" required>
                <option value="">Выберите операцию</option>
                <option value="+">Сложение (+)</option>
                <option value="-">Вычитание (-)</option>
                <option value="*">Умножение (×)</option>
                <option value="/">Деление (÷)</option>
            </select>

            <input type="number" step="any" name="num2" placeholder="Второе число" required>
            
            <button type="submit">Посчитать</button>

            <!-- Поле для вывода результата -->
            <?php if (isset($result)): ?>
                <input 
                    type="text" 
                    class="result-field" 
                    value="Результат: <?php echo htmlspecialchars($result); ?>"
                    readonly
                >
            <?php endif; ?>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $num1 = (float)$_POST['num1'];
        $num2 = (float)$_POST['num2'];
        $operator = $_POST['operator'];
        $result = '';

        switch ($operator) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                $result = ($num2 != 0) ? $num1 / $num2 : 'Ошибка: деление на ноль!';
                break;
            default:
                $result = 'Неверная операция';
        }
    }
    ?>
</body>
</html>