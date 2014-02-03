<?php
$name = $_POST['name'];
$contact = $_POST['contact'];
$message = $_POST['message'];
$to = 'razbakov@futurity.pro';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: Futurity <hello@futurity.pro>' . "\r\n" .
    'Reply-To: Futurity <hello@futurity.pro>';

$body = "

<h2 style='background: #ff0;padding: 3px;display: inline-block'>Новый заказ</h2>
<br>
<p><strong>Имя:</strong> $name</p>
<p><strong>Контакты:</strong> $contact</p>
<p><strong>Сообщение:</strong></p>
<pre style='font-family:Open Sans; font-size: 18px;'>
$message
</pre>
";

mail($to, 'Заказ от '.$name.' - '.$contact, $body, $headers);
header('Location:/');