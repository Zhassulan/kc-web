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
<p>Проверка входа для пользователя '<?php echo $_POST['frm_login']; ?>'..</p>
<?php
$_SESSION["login"] = $_POST['frm_login'];
//проверка на сущ логина
if (check_login_exist($_POST['frm_login'])) {
  //проверка на пароль
  if (check_login($_POST['frm_login'], $_POST['frm_pwd'])) {
    $_SESSION['logged'] = 'yes';
    $_SESSION['login'] = $_POST['frm_login'];
    goto_page('index.php?p=login');
  } else
    goto_page("index.php?p=login&pwd=bad");
} else goto_page("index.php?p=login&login=bad");
?>
</body>
</html>