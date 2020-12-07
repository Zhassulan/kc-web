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
$check = true;
$url = 'cabinet.php?p=';

$_SESSION['full_name'] = $_POST['edt_full_name'];
$_SESSION['legal_code'] = $_POST['edt_legal_code'];
$_SESSION['bin'] = $_POST['edt_BIN'];
$_SESSION['legal_code'] = $_POST['edt_legal_code'];
$_SESSION['email'] = $_POST['edt_email'];
$_SESSION['acc_code_p'] = $_POST['edt_acc_code_p'];
$_SESSION['acc_code_g'] = $_POST['edt_acc_code_g'];

//проверка на пустые поля
if (empty($_POST['edt_BIN']) || empty($_POST['edt_legal_code']) || empty($_POST['edt_full_name'])
    || empty($_POST['edt_acc_code_g']) || empty($_POST['edt_acc_code_p'])) {
  $url .= 'C01_empty';
  $check = false;
  goto_page($url);
}

//проверка на длину
if (!isset($_POST['NotResident'])) {
  if (strlen($_POST['edt_BIN']) > 12 || strlen($_POST['edt_legal_code']) > 32
      || strlen($_POST['edt_acc_code_g']) > 32 || strlen($_POST['edt_acc_code_p']) > 32
      || strlen($_POST['edt_full_name']) > 255) {
    $url .= 'C01_length';
    $check = false;
    goto_page($url);
  }
} else {
  if (strlen($_POST['edt_legal_code']) > 32
      || strlen($_POST['edt_acc_code_g']) > 32 || strlen($_POST['edt_acc_code_p']) > 32
      || strlen($_POST['edt_full_name']) > 255) {
    $url .= 'C01_length';
    $check = false;
    goto_page($url);
  }
}

if (!isset($_POST['Restore'])) {
  //проверка на БИН
//	if (db_chk_customer_bin_exists($_POST['edt_BIN']))
//		{
//		$url .= 'C01_bin_exists';
//		$check = false;
//		goto_page($url);
//		}
  //проверка на расчетную пару
  if (db_chk_customer_legal_exists($_POST['edt_legal_code'])) {
    $url .= 'C01_legal_exists';
    $check = false;
    goto_page($url);
  }
}

if ($check) {
  $Restore = '';
  if ($_POST['Restore'] == "Restore") {
    $Restore = '<div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" checked id="Restore" name="Restore" value="Restore">Восстановление
        </label>
      </div>
 	</div>';
  }
//Отправка таблицы на почту
  global $mail;
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
//$to2 = $mail['kc_operator2'];
  $subject = 'Заявка C01 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
  $body = '
        
    <p class="text-right"><b>Форма C01</b></p>
    <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
    <p class="text-center"><b>ЗАЯВЛЕНИЕ НА РЕГИСТРАЦИЮ КОДОВ ТОРГОВЫХ СЧЕТОВ И ОТКРЫТИЕ РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ</b></p>
        
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
    Прошу зарегистрировать следующие Коды торговых счетов:
    <div class="table-responsive">
            <table border="1">
                <thead>
                  <tr class="success">
                    <th>Код торгового счета</th>
                    <th>БИН/ИИН</th>
                    <th>Наименование</th>
                    <th>E-mail для биржевой рассылки</th>
                    <th>Код раздела регистра учёта гарантийного обеспечения</th>
                    <th>Код раздела регистра учёта денег для оплаты Товара</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>' . $_SESSION['legal_code'] . '
                    </td>
                    <td>' . $_SESSION['bin'] . '
                    </td>
                    <td>' . $_SESSION['full_name'] . '
                    </td>
                    <td>' . $_SESSION['email'] . '
                    </td>
                    <td>' . $_SESSION['acc_code_g'] . '
                    </td>
                    <td>' . $_SESSION['acc_code_p'] . '
                </tr>
                </tbody>
            </table>
    </div>
    </br>
    Дополнительная информация:
    <textarea class="form-control" rows="3" id="comment" name="comment">' . $_POST['comment'] . '</textarea>
    
    ' . $Restore . '
                            
    <p class="text-right">Дата: ' . date("d.m.Y") . '</p>';
  send_email($to1, $to, $subject, $body);
  $url .= 'sent';
  goto_page($url);
}
?>
</body>
</html>