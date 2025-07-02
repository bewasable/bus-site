<?php
// Токен и ID чата Telegram (замени на свои)
$token = "ВАШ_ТОКЕН_БОТА";
$chat_id = "ВАШ_CHAT_ID";

// Получаем данные из формы
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Формируем текст сообщения
$text = "Новая заявка с сайта:\n";
$text .= "Имя: " . strip_tags($name) . "\n";
$text .= "Телефон: " . strip_tags($phone) . "\n";
$text .= "Комментарий: " . strip_tags($message);

// Отправляем запрос в Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $text,
    'parse_mode' => 'HTML'
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type:application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data),
    ],
];
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// После отправки — перенаправляем обратно на главную страницу (можно изменить)
header("Location: index.html#contacts");
exit;
?>
