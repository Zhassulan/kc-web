<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Обработка данных..</title>
</head>
<body>
<p>Обработка данных..</p>
<?php
require_once 'lib/func.inc';
if (isset($_POST['DelRow'])) {
  if (isset($_SESSION['AU04_rows']))
    if (intval($_SESSION['AU04_rows']) > 0) {
      unset($_SESSION['ArrClientsIds'][intval($_SESSION['AU04_rows'])]);
      $_SESSION['AU04_rows'] = intval($_SESSION['AU04_rows']) - 1;
    }
  goto_page('cabinet.php?p=au04');
}
if (isset($_POST["PostLoadClientData"])) {
  if (!empty($_POST["edt_client"])) {
    $id = $_POST["edt_client"];
    $start_post = strpos($id, "(ID=") + 4;
    $len = strlen($id) - ($start_post + 1);
    $id = substr($id, $start_post, $len);
    if (isset($_SESSION['ArrClientsIds']))
      $_SESSION['ArrClientsIds'][] = $id;
    else {
      $_SESSION['ArrClientsIds'] = array();
      $_SESSION['ArrClientsIds'][] = $id;
    }
    if (isset($_SESSION['AU04_rows']))
      $_SESSION['AU04_rows'] = intval($_SESSION['AU04_rows']) + 1;
    else
      $_SESSION['AU04_rows'] = 1;
    goto_page('cabinet.php?p=au04');
  } else goto_page('cabinet.php?p=au04&resp=noclient');
}
$url = 'cabinet.php?p=';
//Отправка таблицы на почту
global $mail;
$to = $mail['kc_operator'];
$to1 = $mail['kc_operator1'];
//$to2 = $mail['kc_operator2'];
$subject = 'Заявка AU04 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
$body = '
	
<p class="text-right"><b>Форма AU04</b></p>
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА ЗАКРЫТИЕ КОДОВ ТОРГОВЫХ СЧЕТОВ И РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ</b></p>
	
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
Прошу закрыть следующие Коды торговых счетов и разделов клиринговых регистров:
<div class="table-responsive">
		<table border="1">
    		<thead>
		      <tr class="success">
				<th>Код торгового счета</th>
				<th>БИН/ИИН</th>
				<th>Наименование</th>
				<th>Код раздела регистра учёта</th>
				<th>Код раздела регистра учёта</th>
				</tr>
		    </thead>
		    <tbody>';
for ($i = 1; $i <= intval($_SESSION['AU04_rows']); $i++) {
  $elem = 'edt_legal_code' . strval($i);
  $edt_legal_code = $_POST[$elem];
  $elem = 'edt_BIN' . strval($i);
  $bin = $_POST[$elem];
  $elem = 'edt_full_name' . strval($i);
  $edt_full_name = $_POST[$elem];
  $elem = 'edt_acc_code_g' . strval($i);
  $edt_acc_code_g = $_POST[$elem];
  $elem = 'edt_acc_code_p' . strval($i);
  $edt_acc_code_p = $_POST[$elem];
  $body .= ' 
		    <tr>
				<td>' . $edt_legal_code . '</td>
				<td>' . $bin . '</td>
				<td>' . $edt_full_name . '</td>
				<td>' . $edt_acc_code_g . '</td>
				<td>' . $edt_acc_code_p . '</td>
			</tr>';
}
$body .= '
			</tbody>
  		</table>
</div>
</br>
Дополнительная информация:
<textarea class="form-control" rows="3" id="comment" name="comment">' . $_POST['comment'] . '</textarea>
<p class="text-right">Дата: ' . date("d.m.Y") . '</p>';
unset($_SESSION['ArrClientsIds']);
unset($_SESSION['AU04_rows']);
//die();
send_email($to1, $to, $subject, $body);
$url .= 'sent';
goto_page($url);
?>
</body>
</html>