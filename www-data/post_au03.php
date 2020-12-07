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
//echo 'БИН: '.$_POST['edt_BIN'];

$_SESSION['full_name'] = $_POST['edt_full_name'];

/*
//проверка на пустые поля
if (empty($_POST['edt_BIN']) || empty($_POST['edt_legal_code']) || empty($_POST['edt_full_name']) 
		|| empty($_POST['edt_acc_code_g']) || empty($_POST['edt_acc_code_p']))	{
	$url .= 'empty';
	goto_page($url);
}

//проверка на длину
if (strlen($_POST['edt_BIN']) != 12 || strlen($_POST['edt_legal_code']) > 32 
		|| strlen($_POST['edt_acc_code_g']) > 32 || strlen($_POST['edt_acc_code_p']) > 32
		|| strlen($_POST['edt_full_name']) > 255)
	{
	$url .= '&p=length';
	goto_page($url);
	}

//проверка на БИН
if (db_chk_customer_bin_exists($_POST['edt_BIN']))	
	{
	$url .= '&p=bin_exists';
	goto_page($url);
	}

//проверка на расчетную пару
if (db_chk_customer_legal_exists($_POST['edt_legal_code']))
	{
	$url .= '&p=legal_exists';
	goto_page($url);
	}
*/

//$cmd = '/usr/local/linux-oracle-jdk1.8.0/bin/java -jar /usr/java/egov/kalkan/eds-0.0.1-SNAPSHOT-jar-with-dependencies.jar "'
//.$_SESSION['login'].'" "'.$_POST['cms_plain_data'].'" "'.$_POST['signature'].'"';

//db_insert_msg($_POST['cms_plain_data']);

$cmd = '/usr/local/linux-oracle-jdk1.8.0/bin/java -jar /usr/java/egov/kalkan/eds-0.0.1-SNAPSHOT-jar-with-dependencies.jar "'
.$_SESSION['login'].'" "'.base64_encode($_POST['cms_plain_data']).'" "'.$_POST['signature'].'"';
$locale='ru_RU.UTF-8';
setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);
exec('locale charmap');
exec($cmd, $output);
$check_stat = null;
foreach ($output as $key => $value)
	$check_stat = $value;

//Отправка таблицы на почту
$to = $mail['kc_operator'];
$to1 = $mail['kc_operator1'];
//$to2 = $mail['kc_operator2'];
$subject = 'Заявка AU03 от брокера '.$_POST['edt_broker_name'].' ('.$_POST['edt_broker_code'].')';
$body = '
	
<p class="text-right"><b>Форма AU03</b></p>
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ ПО УЧЕТУ ГАРАНТИЙНОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА</b></p>
	
От:
<div class="table-responsive">
  		<table border="1">
    		<thead>
		      <tr class="success">
				<th>Наименование:</th>
				<th>Код участника клиринга:</th>
				</tr>
		    </thead>
		    <tbody>
		    <tr>
				<td>'.$_POST['edt_broker_name'].'</td>
				<td>'.$_POST['edt_broker_code'].'</td>
			</tr>
			</tbody>
  		</table>
	</div>
</br>
Прошу изменить учет обязательств по перечислению денежных средств на разделах клирингового регистра:
<div class="table-responsive">
		<table border="1">
    		<thead>
		      <tr class="success">
				<th>Снять с учета на разделе</th>
				<th>Поставить на учет на разделе</th>
				<th>Номер лота</th>
				<th>Сумма, тенге</th>
			  </tr>
		    </thead>
		    <tbody>';
if (!isset($_SESSION['AU03_rows']))
	{
	$_SESSION['AU03_rows'] = 1;
	}
	for ($i=1; $i <= intval($_SESSION['AU03_rows']); $i++)
		{
		$body .= '<tr>
			<td>
				<input type="text" class="form-control" id="edtMinusForLegal'.$i.'" name="edtMinusForLegal'.$i.'" value="'.$_POST["edtMinusForLegal$i"].'">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAddForLegal'.$i.'" name="edtAddForLegal'.$i.'" value="'.$_POST["edtAddForLegal$i"].'">
			</td>
			<td>
				<input type="text" class="form-control" id="edtLotNumber'.$i.'" name="edtLotNumber'.$i.'" value="'.$_POST["edtLotNumber$i"].'">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAmount'.$i.'" name="edtAmount'.$i.'" value="'.$_POST["edtAmount$i"].'">
			</td>
		 </tr>';
		}
$body .= '
<tr>
			    <td>
				</td>
				<td>
				</td>
		    	<td>
					<b>Итого:</b>
				</td>
				<td>
					'.$_POST["edtSum"].'
				</td>
		    </tr>
			</tbody>
  		</table>
</div>
</br>
Дополнительная информация:
<textarea class="form-control" rows="3" id="comment" name="comment">'.$_POST['comment'].'</textarea>
</br>
<p class="text-right">Дата: '.date("d.m.Y").'</p>';

if ($check_stat == 'true')
	{
	send_email($to1, $to, $subject, $body);
	$url .= 'sent';
	}
else
	{
	$url .= 'check_error';
	}
goto_page($url);
?>
</body>
</html>