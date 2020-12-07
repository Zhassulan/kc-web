<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Новости</title>
</head>
<body>
<?php
if(empty($_POST['Agree']))
	goto_page('cabinet.php?p=section_not_checked_addnews');
if(empty($_POST['edtBody']))
	goto_page('cabinet.php?p=empty_body');
proc_add_news($_POST['edtBody']);
goto_page('cabinet.php?p=news_added');
?>
</body>
</html>