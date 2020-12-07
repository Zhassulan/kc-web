<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Отправка данных..</title>
</head>
<body>
<p>Отправка данных..</p>
<?php
require_once 'lib/func.inc';
$url = 'https://www.kc-ets.kz/index.php?p=contacts';
date_default_timezone_set ("Asia/Almaty");
$dtime = 'Дата и время отправки сообщения с сайта: '.date("d/m/Y H:i:s",time());
$subject = 'Обращение с сайта Клирингового Центра www.kc-ets.kz';
$body = '
<b><p>Текст обращения:</p></b>
<textarea class="form-control" rows="3" id="comment" name="comment">'.$_POST['edtText'].'</textarea>
<b><p>E-Mail для ответа: '.$_POST['edtEmail'].'</p></b>
<p>'.$dtime.'</p>';
global $mail;
$to = $mail['members_operator'];
send_email($to, 'support@ets.kz', $subject, $body);
$url.='&qanda=sent';
goto_page($url);
?>
</body>
</html>