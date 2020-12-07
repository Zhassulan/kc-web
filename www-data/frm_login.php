<?php
if (isset($_SESSION["logged"]))
	{
	if ($_SESSION["logged"] == 'no')
		{
		alert_danger('Ошибка входа. Попробуйте ввести данные заново.');
		require_once 'frm_login_design.php';
		}
	else
		{
		if (!check_pwd_ischanged($_SESSION["login"]))
			require_once 'frm_change_pwd.php';
		else
			{
			$to = 'support@ets.kz';
			//$subject = 'Логин: '.$_SESSION['login'];
			$body = 'Успешно вошёл в ЛК.';
			//send_email($to, 'support@ets.kz', $subject, $body);
			goto_page('cabinet.php');
			}
		}
	}
else 
	{
	require_once 'frm_login_design.php';
	if (isset($_GET['login'])) 
		{
		if ($_GET['login'] == 'bad')
			alert_danger('Нет такого пользователя.');
		}
	if (isset($_GET['pwd']))
		{
			if ($_GET['pwd'] == 'bad')
				alert_danger('Не верный пароль.');
		}
	if (isset($_GET['captcha']))
		{
		if ($_GET['captcha'] == 'bad')
			alert_danger('Подтвердите что вы не робот.');
		}
	}
?>