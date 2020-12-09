<?php
require_once 'lib/func.inc';
console('Post AU032..');
$arr = array();
for ($i = 1; $i < intval($_SESSION['AU032_ROWS']) + 1; $i++) {
  console('val: '.$_POST["edtMinusForLegal$i"]);
  $postedRow = new \lib\AU032RowsData(
      $_POST["edtMinusForLegal$i"],
      $_POST["edtAddForLegal$i"],
      $_POST["edtLotNumber$i"],
      intval($_POST["edtAmount$i"]));
  console('Posted row: ' . serialize($postedRow));
  array_push($arr, $postedRow);
}
console('Array: ' . serialize($arr));
$_SESSION['AU032_ARR'] = $arr;
if (isset($_POST['AddRow'])) {
  $_SESSION['AU032_ROWS'] = intval($_SESSION['AU032_ROWS']) + 1;
  $newRow = new \lib\AU032RowsData("", "", "", 0);
  array_push($arr, $newRow);
  console('Incremented array: ' . serialize($arr));
  $_SESSION['AU032_ARR'] = $arr;
  unset($_SESSION['id']);
  goto_page('cabinet.php?p=AU032');
}
if (isset($_POST['DelRow'])) {
  if (count($arr) > 1) {
    $_SESSION['AU032_ROWS'] = intval($_SESSION['AU032_ROWS']) - 1;
    array_pop($arr);
    console('Dicremented array: ' . serialize($arr));
    $_SESSION['AU032_ARR'] = $arr;
  }
  unset($_SESSION['id']);
  goto_page('cabinet.php?p=AU032');
}
?>
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
$arr = $_SESSION['AU03_ARR'];
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
$i = 0;
foreach ($arr as $r => $item) {
  $i += 1;
  $body .= '<tr>
			<td>
				<input type="text" class="form-control" id="edtMinusForLegal' . $i . '" name="edtMinusForLegal' . $i . '" value="' . $item->minus . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAddForLegal' . $i . '" name="edtAddForLegal' . $i . '" value="' . $item->plus . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtLotNumber' . $i . '" name="edtLotNumber' . $i . '" value="' . $item->lot . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAmount' . $i . '" name="edtAmount' . $i . '" value="' . $item->amount . '">
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
unset($_SESSION['AU032_ROWS']);
unset($_SESSION['AU032_ARR']);
goto_page($url);
?>
</body>
</html>