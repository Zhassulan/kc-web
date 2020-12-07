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
global $mail;
$url = 'cabinet.php?p=';
$_SESSION['full_name'] = $_POST['edt_full_name'];
//Отправка таблицы на почту
$to = $mail['kc_operator'];
$to1 = $mail['kc_operator1'];
$subject = 'Заявка AU03 Форма 1 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
$body = '
				
<p class="text-right"><b>Заявка AU03 Форма 2</b></p>
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ для спецаукциона ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ</br> ПО УЧЕТУ БИРЖЕВОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА в разрезе лотов</b></p>
				
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
Прошу изменить учет обязательств по перечислению денежных средств на разделах клирингового регистра:
<div class="table-responsive">
		<table border="1">
    		<thead>
		      <tr class="success">
				<th>Снять с учета на разделе Отправителя</th>
				<th>Поставить на учет на разделе Получателя</th>
				<th>Номер лота</th>
				<th>Сумма, тенге</th>
			  </tr>
		    </thead>
		    <tbody>';
if (!isset($_SESSION['AU03_rows'])) {
  $_SESSION['AU03_rows'] = 1;
}
for ($i = 1; $i <= intval($_SESSION['AU03_rows']); $i++) {
  $body .= '<tr>
			<td>
				<input type="text" class="form-control" id="edtMinusForLegal' . $i . '" name="edtMinusForLegal' . $i . '" value="' . $_POST["edtMinusForLegal$i"] . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAddForLegal' . $i . '" name="edtAddForLegal' . $i . '" value="' . $_POST["edtAddForLegal$i"] . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtLotNumber' . $i . '" name="edtLotNumber' . $i . '" value="' . $_POST["edtLotNumber$i"] . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAmount' . $i . '" name="edtAmount' . $i . '" value="' . $_POST["edtAmount$i"] . '">
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
					' . $_POST["edtSum"] . '
				</td>
		    </tr>
			</tbody>
  		</table>
</div>
</br>
Дополнительная информация:
<textarea class="form-control" rows="3" id="comment" name="comment">' . $_POST['comment'] . '</textarea>
</br>
<p class="text-right">Дата: ' . date("d.m.Y") . '</p>';

send_email($to, $to1, $subject, $body);
$url .= 'sent';
if (isset($_SESSION['AU03_rows']))
  unset($_SESSION['AU03_rows']);
goto_page($url);
?>
</body>
</html>