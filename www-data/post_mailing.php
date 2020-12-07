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
if(array_key_exists( 'UploadEmbedPics', $_POST ))
	{
	SavePics();
	}
if (isset($_POST['Agree']))
	{
	if(empty($_POST['chkbox']))
		{
		goto_page('cabinet.php?p=list_notchecked_mailing');
		}
	if(empty($_POST['edtSubject']))
		{
		goto_page('cabinet.php?p=no_subject_mailing');
		}
	if(empty($_POST['edtBody']))
		{
		goto_page('cabinet.php?p=no_body_mailing');
		}
	echo '<p>Начало рассылки, на закрывайте эту страницу в браузере до окончания рассылки.</p>';
	
	$arr= $_POST['chkbox'];
	$N = count($arr);
	for	($i = 0; $i < $N; $i++)
		{
		send_email_mass($arr[$i], 1993, 0);
		if ($arr[$i] == 1)
			send_email_mass($arr[$i], 1993, 1993);
		}
	goto_page('cabinet.php?p=sent_mailing');
	}
else
	{
	goto_page('cabinet.php?p=not_agree_mailing');
	}
?>
</body>
</html>