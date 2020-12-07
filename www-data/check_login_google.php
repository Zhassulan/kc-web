<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Проверка входа..</title>
</head>
<body>
<?php
//require_once('lib/recaptcha-master/src/autoload.php');
global $secret;
//echo $secret['captcha_key'];
//echo 'IP: '.$_SERVER['REMOTE_ADDR'].'</br>';
$key = $secret['key'];
//echo 'KEY: '.$key.'</br>';
$captcha = $_POST['g-recaptcha-response'];
if(!empty($captcha))
	{
	$cap = new GoogleRecaptcha();
	//echo 'CAPTCHA: '.$captcha.'</br>';
	$verified = $cap->VerifyCaptcha($captcha, $key);
	if	($verified) {
		$_SESSION["login"] = $_POST['frm_login'];
		//проверка на сущ логина
		if (check_login_exist($_POST['frm_login']))	
			{
			//проверка на пароль
			if (check_login($_POST['frm_login'],$_POST['pd']))	{
				$_SESSION['logged'] = 'yes';
				$_SESSION['login'] = $_POST['frm_login'];
				goto_page('index.php?p=login');
				}
			else
				goto_page("index.php?p=login&pwd=bad");
			}
		else {
			goto_page("index.php?p=login&login=bad");
			}
		}
	else
		{
		goto_page("index.php?p=login&captcha=bad");
		exit;
		}
	}
else 
	{
	goto_page("index.php?p=login&captcha=bad");
	exit;
	}
?>
</body>
</html>