<?php
require_once 'lib/func.inc';
console('Post AU021..');
if (isset($_POST["LoadData"])) {
    console('Load data..');
    if (!empty($_POST["edtClient"])) {
        console('edtClient not empty');
        if (!isset($_SESSION['client_id'])) {
            console('client_id is isset');
            $id = $_POST["edtClient"];
            console('id = '.$id);
            $start_post = strpos($id, "(ID=") + 4;
            $len = strlen($id) - ($start_post + 1);
            $id = substr($id, $start_post, $len);
            $_SESSION['client_id'] = $id;
            console('id = '.$id);
            goto_page('cabinet.php?p=AU021');
        } else {
            console('client_id is NOT isset');
        }
    } else {
        console('edtClient is empty');
        goto_page('cabinet.php?p=AU021&resp=noclient');
    }
}
$arr = array();
for ($i = 1; $i < intval($_SESSION['AU021_ROWS']) + 1; $i++) {
    $postedRow = new \lib\AU021RowsData(
        $_POST["edtAccCode$i"],
        $_POST["edtLotCode$i"],
        intval($_POST["edtAmount$i"]));
    console('Posted row: ' . serialize($postedRow));
    array_push($arr, $postedRow);
}
console('Array: ' . serialize($arr));
$_SESSION['AU021_ARR'] = $arr;
if (isset($_POST['AddRow'])) {
    $_SESSION['AU021_ROWS'] = intval($_SESSION['AU021_ROWS']) + 1;
    $newRow = new \lib\AU021RowsData("", "0G", 0);
    array_push($arr, $newRow);
    console('Incremented array: ' . serialize($arr));
    $_SESSION['AU021_ARR'] = $arr;
    unset($_SESSION['id']);
    goto_page('cabinet.php?p=AU021');
}
if (isset($_POST['DelRow'])) {
    if (count($arr) > 1) {
        $_SESSION['AU021_ROWS'] = intval($_SESSION['AU021_ROWS']) - 1;
        array_pop($arr);
        console('Dicremented array: ' . serialize($arr));
        $_SESSION['AU021_ARR'] = $arr;
    }
    unset($_SESSION['id']);
    goto_page('cabinet.php?p=AU021');
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
$url = 'cabinet.php?p=';
//Отправка таблицы на почту
global $mail;
$to = $mail['kc_operator'];
$to1 = $mail['kc_operator1'];
//$to2 = $mail['kc_operator2'];
$subject = 'Заявка AU02 Форма 1 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
$body = '
<p class="text-right"><b>Заявка AU02 Форма 1</b></p>
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ</b></p>
<p class="text-center"><b>(стандартный аукцион)</b></p>
						
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
					' . $_POST['edtClient'] . '
				</td>
				<td class="col-md-3">
					' . $_POST['edtClientBin'] . '
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
$i = 0;
foreach ($arr as $r => $item) {
    $i += 1;
    $body .= '<tr>
			<td>
			' . $i . '
			</td>
			<td>
				<input type="text" class="form-control" id="edtAccCode' . $i . '" name="edtAccCode' . $i . '" value="' . $item->account . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtLotCode' . $i . '" name="edtLotCode' . $i . '" value="' . $item->lot . '">
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

$url .= 'sent';
console('Unsetting..');
unset($_SESSION['AU021_ROWS']);
unset($_SESSION['AU021_ARR']);
unset($_SESSION['client_id']);
send_email($to1, $to, $subject, $body);
goto_page($url);
?>
</body>
</html>