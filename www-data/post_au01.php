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

if (!isset($_POST["edtClientBin"]))
	{
	if (!empty($_POST["edtClient"]))
		{
		$id = $_POST["edtClient"];
		$start_post = strpos($id, "(ID=") + 4;
		$len = strlen($id) - ($start_post + 1);
		$id = substr($id, $start_post, $len);
		goto_page('cabinet.php?p=AU01&id='.$id);
		}
	else goto_page('cabinet.php?p=AU01&resp=noclient');
	}
else
{
$url = 'cabinet.php?p=';
//echo 'БИН: '.$_POST['edt_BIN'];

$_SESSION['full_name'] = $_POST['edt_full_name'];

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
$subject = 'Заявка AU01 от брокера '.$_POST['edt_broker_name'].' ('.$_POST['edt_broker_code'].')';
$body = '
	
<p class="text-right"><b>Форма AU01</b></p>
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ</b></p>
	
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
Прошу возвратить денежные средства Участника клиринга:
<div class="table-responsive">
 		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				 <th>Участник</th>
				 <th>БИН/ИИН</th>
			  </tr>
		    </thead>
		    <tbody>
		     <tr>
				<td class="col-md-9">  
					'.$_POST['edtClient'].'
				</td>
				<td class="col-md-3">
					'.$_POST['edtClientBin'].'
				</td>
			 </tr>
			</tbody>
  		</table>
</div>


<div class="table-responsive">
		<table border="1">
    		<thead>
		      <tr class="success">
				<th>№</th>
				<th>Код раздела</th>
				<th>Код лота</th>
				<th>Сумма, тенге</th>
			  </tr>
		    </thead>
		    <tbody>';
if (!isset($_SESSION['AU01_rows']))
	{
	$_SESSION['AU01_rows'] = 1;
	}
	for ($i=1; $i <= intval($_SESSION['AU01_rows']); $i++)
		{
		$body .= '<tr>
			<td>
			'.$i.'
			</td>
			<td>
				<input type="text" class="form-control" id="edtAccCode'.$i.'" name="edtAccCode'.$i.'" value="'.$_POST["edtAccCode$i"].'">
			</td>
			<td>
				<input type="text" class="form-control" id="edtLotCode'.$i.'" name="edtLotCode'.$i.'" value="'.$_POST["edtLotCode$i"].'">
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
по следующим реквизитам (<b>*</b>):
	<div class="table-responsive">
		<table class="table table-bordered" id="myTable" name="myTable">
    		<thead>
    			<tr>
					<td class="success">Наименование получателя</td>
					<td  class="col-md-9">
						'.$_POST['edtRecipient'].'
					</td>
				</tr>
		      <tr>
					<td class="success">БИН/ИИН</td>
					<td  class="col-md-9">
						'.$_POST['edtBIN'].'
					</td>
				</tr>	
				<tr>
					<td class="success">Номер счета</td>
					<td  class="col-md-9">
						'.$_POST['edtAccount'].'
					</td>
				</tr>
				<tr>
					<td class="success">Наименование банка получателя</td>
					<td  class="col-md-9">
						'.$_POST['edtBank'].'
					</td>
				</tr>	
				<tr>
					<td class="success">БИК</td>
					<td  class="col-md-9">
						'.$_POST['edtBIK'].'
					</td>
				</tr>
		    </thead>
		    <tbody>
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
if (isset($_SESSION['AU02_rows']))
	{
	unset($_SESSION['AU02_rows']);
	}
goto_page($url);
}
?>
</body>
</html>