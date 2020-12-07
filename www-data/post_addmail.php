<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Рассылка</title>
</head>
<body>
<?php
if(empty($_POST['chkbox']))
	goto_page('cabinet.php?p=section_not_checked_addmail');
if(empty($_POST['edtNewmail']))
	goto_page('cabinet.php?p=empty_mail');

$arr = $_POST['chkbox'];
$N = count($arr);
for	($i = 0; $i < $N; $i++)
	db_addmail($arr[$i], $_POST['edtNewmail']);
goto_page('cabinet.php?p=mail_added');
?>
</body>
</html>