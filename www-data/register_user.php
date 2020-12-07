<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Регистрация нового пользователя..</title>
</head>
<body>
<p>Регистрация нового пользователя '<?php echo $_POST['frm_login']; ?>' с паролем '<?php echo $_POST['frm_pwd']; ?>'</p>
<?php
include_once("lib/func.inc");
session_start();
$_SESSION["login"] = $_POST['frm_login'];
$_SESSION["email"] = $_POST['frm_email'];
$param = 'index.php?p=register';
if	(!preg_match('/^[a-z0-9]{4,12}$/i', $_POST['frm_login']))
	{
	$param .= '&login=bad';
	}
else
	{
	if (check_login_exist($_POST['frm_login']))
		{
		$param .= '&login=exist';
		}
	}
if	(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['frm_pwd'])) 
	{
	$param .= '&pwd=bad';
	}
if (empty($_POST['frm_email']) || !filter_var($_POST['frm_email'], FILTER_VALIDATE_EMAIL))
	{
	$param .= '&email=bad';
	}
goto_page($param);
?>
</body>
</html>