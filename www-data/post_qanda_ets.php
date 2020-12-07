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
$url = 'https://kc-ets.kz/qanda_ets.php';
date_default_timezone_set ("Asia/Almaty");
$dtime = 'Дата и время отправки сообщения с сайта: '.date("d/m/Y H:i:s",time());
$to = 'ets@ets.kz';
$bcc = 'sagadi@ets.kz';
$subject = 'Обращение с сайта Биржи ЕТС www.ets.kz';
$body = '
	<b><p>Текст обращения:</p></b>
	<textarea class="form-control" rows="3" id="comment" name="comment">'.$_POST['edtText'].'</textarea>
	<b><p>E-Mail для ответа: '.$_POST['edtEmail'].'</p></b>
	<p>'.$dtime.'</p>';
send_email($to, $bcc, $subject, $body);
$url.='?p=sent';
goto_page($url);
?>
</body>
</html>