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
//Отправка таблицы на почту
global $mail;
$to = $mail['kc_operator'];
$to1 = $mail['kc_operator1'];
//$to2 = $mail['kc_operator2'];
$subject = 'Заявка AU02 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
$subject = 'Заявка AU02 Форма 2 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
$body = '
<p class="text-right"><b>Заявка AU02 Форма 2</b></p>
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ</b></p>
<p class="text-center"><b>(двойной встречный аукцион, режим классической биржевой торговли)</b></p>
		
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
				<td>' . $_POST['edt_broker_name'] . '</td>
				<td>' . $_POST['edt_broker_code'] . '</td>
			</tr>
			</tbody>
  		</table>
	</div>
</br>
Прошу возвратить денежные средства, обязательства по перечислению которых учитываются на разделах клирингового регистра:
<div class="table-responsive">
		<table border="1">
    		<thead>
		      <tr class="success">
				<th>Код раздела</th>
				<!-- <th>Код лота</th> -->
				<th>Сумма, тенге</th>
			  </tr>
		    </thead>
		    <tbody>';
if (!isset($_SESSION['AU022_rows'])) {
  $_SESSION['AU022_rows'] = 1;
}
for ($i = 1; $i <= intval($_SESSION['AU022_rows']); $i++) {
  $body .= '<tr>
				<td>
					<input type="text" class="form-control" id="edtAccCode' . $i . '" name="edtAccCode' . $i . '" value="' . $_POST["edtAccCode$i"] . '">
				</td>
				<td>
					<input type="text" class="form-control" id="edtAmount' . $i . '" name="edtAmount' . $i . '" value="' . $_POST["edtAmount$i"] . '">
				</td>
		 	</tr>';
}
$body .= '
		<tr>
	    	<td>
				<b>Итого:</b>
			</td>
			<td>
				' . $_POST["edtSum"] . '
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
						' . $_POST['edtRecipient'] . '
					</td>
				</tr>
		      <tr>
					<td class="success">БИН/ИИН</td>
					<td  class="col-md-9">
						' . $_POST['edtBIN'] . '
					</td>
				</tr>
				<tr>
					<td class="success">Номер счета</td>
					<td  class="col-md-9">
						' . $_POST['edtAccount'] . '
					</td>
				</tr>
				<tr>
					<td class="success">Наименование банка получателя</td>
					<td  class="col-md-9">
						' . $_POST['edtBank'] . '
					</td>
				</tr>
				<tr>
					<td class="success">БИК</td>
					<td  class="col-md-9">
						' . $_POST['edtBIK'] . '
					</td>
				</tr>
		    </thead>
		    <tbody>
		   </tbody>
  		</table>
	</div>
</br>
Дополнительная информация:
<textarea class="form-control" rows="3" id="comment" name="comment">' . $_POST['comment'] . '</textarea>
</br>
<p class="text-right">Дата: ' . date("d.m.Y") . '</p>';

send_email($to1, $to, $subject, $body);
$url .= 'sent';
if (isset($_SESSION['AU022_rows']))
  unset($_SESSION['AU022_rows']);
if (isset($_SESSION['client_id']))
  unset($_SESSION['client_id']);
goto_page($url);
?>
</body>
</html>