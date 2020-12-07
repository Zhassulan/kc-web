<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Удаление данных..</title>
</head>
<body>
<p>Отправка данных..</p>
<?php
require_once 'lib/func.inc';
$url = 'cabinet.php?p=delmail';
$param = $_POST['edtFindmail'];

//проверка на пустые поля
if (isset($_POST['edtFindmail']))
	if (empty($param))
		{
		$url .= '&post=empty';
		}
	else
		{
		$url .= '&post=find&email='.$param;
		goto_page($url);
		}
if (isset($_POST['chkbox']))
	{
	if(!empty($_POST['chkbox']))
		{
		$arr= $_POST['chkbox'];
		$N = count($arr);
		for	($i = 0; $i < $N; $i++)
			{
			db_delmail($arr[$i]);
			$url .= '&post=deleted';
			goto_page($url);
			}
		}
	}
?>
</body>
</html>