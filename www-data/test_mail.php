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
global $mail;

$to=$mail['kc_operator'];
$to1=$mail['kc_operator1'];

$subject ='testmail';
$body='Если вы получили это письмо, позвоните Абылаю!';

send_email($to,$to1,$subject, $body);




?>