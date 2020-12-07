<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Смена пароля..</title>
</head>
<body>
<?php
require_once 'lib/func.inc';
echo '<p>Смена пароля для пользователя '.$_SESSION["login"].'</p>';
if	(!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,12}/', $_POST['frm_pwd_new']))
	goto_page('index.php?p=login&pwd=bad');
else
	if ($_POST['frm_pwd_new'] == $_POST['frm_pwd_new1'])	{
		change_pwd($_SESSION["login"], $_POST['frm_pwd_new']);
		goto_page('cabinet.php');
		}
	else
		goto_page('index.php?p=login&pwd=repeat');
?>
</body>
</html>