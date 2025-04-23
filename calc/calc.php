<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $result = ($num2 != 0) ? $num1 / $num2 : "Ошибка деления на ноль";
            break;
        default:
            $result = "Неизвестная операция";
    }

    // Возвращаемся обратно с результатом
    header("Location: index.php?result=" . urlencode($result));
    exit;
}
?>