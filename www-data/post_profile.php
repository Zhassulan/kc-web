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
$url = 'cabinet.php?p=';

if ($_POST['chkbox'] == 'on')
{
//Отправка профиля почтой
$to = 'baytleuov@ets.kz';
$subject = 'Профиль от брокера '.db_get_broker_name_by_code($_SESSION['login']).' ('.$_SESSION['login'].')';
$body = '

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-erlg{font-weight:bold;background-color:#efefef;vertical-align:top}
.tg .tg-yzt1{background-color:#efefef;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
		
<table class="tg">
  <tr>
    <th class="tg-erlg">Название</th>
    <th class="tg-yw4l">'.$_POST['edtName'].'</th>
  </tr>
  <tr>
    <td class="tg-erlg">Название (англ.)</td>
    <td class="tg-yw4l">'.$_POST['edtNameEng'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">БИН</td>
    <td class="tg-yw4l">'.$_POST['edtBIN'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Адрес</td>
    <td class="tg-yw4l">'.$_POST['edtAddress'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Адрес (англ.)</td>
    <td class="tg-yw4l">'.$_POST['edtAddressEng'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Почтовый адрес</td>
    <td class="tg-yw4l">'.$_POST['edtPostAddress'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Почтовый адрес (англ.)</td>
    <td class="tg-yw4l">'.$_POST['edtPostAddressEnd'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Телефон</td>
    <td class="tg-yw4l">'.$_POST['edtPhone'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Моб. телефон</td>
    <td class="tg-yw4l">'.$_POST['edtMobile'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Факс</td>
    <td class="tg-yw4l">'.$_POST['edtFax'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">E-Mail</td>
    <td class="tg-yw4l">'.$_POST['edtEmail'].'</td>
  </tr>
  <tr>
    <td class="tg-erlg">Веб сайт</td>
    <td class="tg-yw4l">'.$_POST['edtSite'].'</td>
  </tr>
</table>
';

send_email($to, 'support@ets.kz', $subject, $body);
$url .= 'sent';
}
else
	{
	$url .= 'no_confirmation';
	}
goto_page($url);
?>
</body>
</html>