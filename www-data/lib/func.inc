<?php

session_start();
checkSession();

include 'model/AU021RowsData.php';
include 'model/AU022RowsData.php';
include 'model/AU031RowsData.php';
include 'model/AU032RowsData.php';
include 'model/AU04RowsData.php';

use lib\AU021RowsData;
use lib\AU022RowsData;
use lib\AU031RowsData;
use lib\AU032RowsData;
use lib\AU04RowsData;

// Use globals as '.$GLOBALS['name'].'
date_default_timezone_set("Asia/Almaty");
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
//turnOffErrorReporting();
turnOnErrorReporting();
//require_once($_SERVER['DOCUMENT_ROOT'].'/lib/phpmailer/class.phpmailer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/phpmailer/PHPMailerAutoload.php');
#include "GoogleRecaptcha.php";
include "FreakMailer.php";


function turnOnErrorReporting()
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ERROR);
}

function turnOffErrorReporting()
{
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  //error_reporting(0);
  error_reporting(E_ERROR | E_PARSE);
}


//Соединение с базой MySQL
function iconnect()
{
  global $db;
  $mysqli = new mysqli($db['server'], $db['user'], $db['pwd'], $db['db']);
  if (mysqli_connect_errno()) die('Connect failed: ' . mysqli_connect_error());
  return $mysqli;
}

//Соединение с промежуточной базой MySQL 172.25.72.6
function iconnect1()
{
  global $db1;
  $mysqli = new mysqli($db1['server'], $db1['user'], $db1['pwd'], $db1['db']);
  if (mysqli_connect_errno()) die('Connect failed: ' . mysqli_connect_error());
  return $mysqli;
}

//Соединение с базой MS SQL
function msconn()
{
  global $msdb;
  $conn = mssql_connect($msdb['db'], $msdb['user'], $msdb['pwd']) or die ("Can't connect to Microsoft SQL Server");
  return $conn;
}

function goto_page($page_name)
{
  echo '<script type="text/javascript">window.location = "' . $page_name . '"</script>';
}

function send_email($to, $bcc, $subject, $body)
{
// Читаем настройки config
//require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
// инициализируем класс
  $mailer = new FreakMailer();
// Устанавливаем тему письма
  $mailer->Subject = $subject;
// Задаем тело письма
  $mailer->Body = $body;
// Добавляем адрес в список получателей
  $mailer->AddAddress($to);
  $mailer->AddBCC($bcc);
//$mailer->AddBCC('support@ets.kz');
  if (!$mailer->Send())
    return false;
  $mailer->ClearAddresses();
  $mailer->ClearAttachments();
  return true;
}

//проверка логина и пароля при входе
function check_login($login, $pwd)
{
  $b = false;
  $conn = iconnect();
  if ($res = $conn->query('SELECT COUNT(*) FROM db_kc.users WHERE login = \'' . $login . '\' AND pwd = md5(\'' . $pwd . '\');'))
    while ($row = $res->fetch_row()) {
      if ($row[0] > 0) $b = true;
    }
  mysqli_free_result($res);
  mysqli_close($conn);
  return $b;
}

//проверка на существование логина
function check_login_exist($login)
{
  $b = false;
  $conn = iconnect();
  if ($res = $conn->query("SELECT func_check_login_exist('$login')"))
    while ($row = $res->fetch_row())
      if ($row[0] > 0) $b = true;
  mysqli_free_result($res);
  mysqli_close($conn);
  return $b;
}

//проверка на смену пароля
function check_pwd_ischanged($login)
{
  $b = false;
  $conn = iconnect();
  if ($res = $conn->query("SELECT func_check_pwd_ischanged('$login')"))
    while ($row = $res->fetch_row())
      if ($row[0]) $b = true;
  mysqli_free_result($res);
  mysqli_close($conn);
  return $b;
}

//Смена пароля
function change_pwd($login, $newpwd)
{
  $conn = iconnect();
  $res = $conn->query("CALL proc_change_pwd('$login','$newpwd')");
  mysqli_free_result($res);
  mysqli_close($conn);
}

//очистки ипортируемых таблиц
function xml_truncate_all()
{
  $conn = iconnect();
  $res = $conn->query("CALL proc_xml_truncate_all()");
  mysqli_free_result($res);
  mysqli_close($conn);
}

//резервная копия таблиц
function xml_copy_all()
{
  $conn = iconnect();
  $res = $conn->query("CALL proc_xml_copy_all()");
  mysqli_free_result($res);
  mysqli_close($conn);
}

//запись xml root
function xml_add_root($dt, $file, $filename)
{
  $conn = iconnect();
  echo 'Actual date & time: ' . $dt . '</br>';
  echo 'Uploaded file: ' . $file . '</br>';
  echo 'Original filename: ' . $filename . '</br></br>';
  if (!$res = $conn->query("CALL proc_xml_add_import('$dt', '$file', '$filename');"))
    die($conn->error);
  mysqli_free_result($res);
  mysqli_close($conn);
}

//запись брокера
function xml_add_broker($full_name, $code, $BIN, $total)
{
  $conn = iconnect();
  $res = $conn->query("CALL proc_xml_add_broker('$full_name','$code','$BIN',$total)");
  mysqli_free_result($res);
  mysqli_close($conn);
}

//запись поставщика
function xml_add_customer($full_name, $BIN, $total, $part_code, $acc_code, $legal_code)
{
  $conn = iconnect();
  $res = $conn->query("CALL proc_xml_add_customer('$full_name','$BIN',$total,'$part_code','$acc_code','$legal_code')");
  mysqli_free_result($res);
  mysqli_close($conn);
}

//redirect
function redirect($url)
{
  echo '<script type="text/javascript">
			redirect("' . $url . '");
      </script>';
}

//Общий список клиентов брокера
function table_all_clients()
{
  $conn = iconnect();
  $query = null;
  if ($_SESSION['login'] == "ADMIN") {
    $query = 'SELECT distinct c.full_name, c.`BIN` FROM db_kc.customers c
		JOIN db_kc.users u on u.login is not null
		JOIN db_kc.brokers b ON b.part_code = u.broker_code
		where c.id_broker = b.id
		order by c.full_name;';
  } else {
    $query = 'SELECT distinct c.full_name, c.`BIN` FROM db_kc.customers c
		JOIN db_kc.users u on u.login = \'' . $_SESSION['login'] . '\'
		JOIN db_kc.brokers b ON b.part_code = u.broker_code
		where c.id_broker = b.id
		order by c.full_name;';
  }
  $k = 1;
  if ($res = $conn->query($query)) {
    echo '
	<h4>Список клиентов <small>(кол. ' . db_get_customers_count($_SESSION['login']) . ', на состояние ' . db_get_last_import_datetime() . ')</small></h4>
	<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>#</th>
		        <th>Наименование
			</th>
		        <th>БИН</th>
		      </tr>
		    </thead>
		    <tbody>';
    while ($row = $res->fetch_row()) {
      echo
        '
				<tr>
					<td>' . $k++ . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
				</tr>
				';
    }
    echo '
		    </tbody>
  		</table>
	</div>';
  }
  mysqli_close($conn);
}

//Счета с остатками
function table_all_accounts()
{
  $conn = iconnect();
  $query = null;
  if ($_SESSION['login'] == "ADMIN") {
    $query = 'SELECT c.full_name, c.legal_code, ca.acc_code, ca.total_amount FROM db_kc.customers c 
            JOIN db_kc.users u on u.login is not null
            JOIN db_kc.brokers b ON b.part_code = u.broker_code
              JOIN db_kc.customer_accounts ca ON ca.id_customer = c.id 
          WHERE c.id_broker = b.id 
          order by u.broker_code;';
  } else {
    $query = 'SELECT c.full_name, c.legal_code, ca.acc_code, ca.total_amount FROM db_kc.customers c 
          JOIN db_kc.users u on u.login = \'' . $_SESSION["login"] . '\'
          JOIN db_kc.brokers b ON b.part_code = u.broker_code
            JOIN db_kc.customer_accounts ca ON ca.id_customer = c.id 
        WHERE c.id_broker = b.id order by c.id;';
  }
  $k = 1;
  if ($res = $conn->query($query)) {
    echo '
	<h4>Регистры учёта <small>(на состояние ' . db_get_last_import_datetime() . ')</small></h4>
	<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>#</th>
		        <th>Наименование</th>
		        <th>Код торгового счёта</th>
				<th>Код раздела регистра</th>
				<th>Средства</th>
		      </tr>
		    </thead>
		    <tbody>';
    while ($row = $res->fetch_row()) {
      echo
        '
				<tr>
					<td>' . $k++ . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td>
					<td>' . $row[3] . '</td>
				</tr>
				';
    }
    echo '
		    </tbody>
  		</table>
	</div>';
  }
  mysqli_close($conn);
}

//Наименование брокера по коду
function db_get_broker_name_by_code($part_code)
{
  $name = '';
  $conn = iconnect();
  if ($res = $conn->query('SELECT full_name FROM db_kc.brokers WHERE part_code = \'' . $part_code . '\';'))
    while ($row = $res->fetch_row())
      $name = $row[0];
  mysqli_free_result($res);
  mysqli_close($conn);
  return $name;
}

//Наименование брокера по логину
function db_get_broker_name_by_login($login)
{
  $broker_name = null;
  $conn = iconnect();
  if ($res = $conn->query('select b.full_name from db_kc.brokers b join db_kc.users u on u.login = \'' . $login . '\' and u.broker_code = b.part_code;'))
    while ($row = $res->fetch_row())
      $broker_name = $row[0];
  mysqli_free_result($res);
  mysqli_close($conn);
  return $broker_name;
}

//Наименование брокера по логину
function db_get_broker_code_by_login($login)
{
  $broker_code = null;
  $conn = iconnect();
  if ($res = $conn->query('select b.part_code from db_kc.brokers b join db_kc.users u on u.login = \'' . $login . '\' and u.broker_code = b.part_code;'))
    while ($row = $res->fetch_row())
      $broker_code = $row[0];
  mysqli_free_result($res);
  mysqli_close($conn);
  return $broker_code;
}

//Проверка на сущ БИН в списках клиентов в БД СС (My SQL)
function db_chk_customer_bin_exists($p_bin)
{
  $k = 0;
  $conn = iconnect1();
  if ($res = $conn->query('select count(*) as kolfrom db_kc1.legal l where 
	l.deleted !=\'*\' and l.inn = LTrim(RTrim(\'' . $p_bin . '\')) 
	and l.rm_broker = \'' . $_POST['edt_broker_code'] . '\';'))
    while ($row = $res->fetch_row())
      $k = $row[0];
  mysqli_close($conn);
  if ($k > 0) return true; else return false;
}

/*
//Клиенты с существующим БИНом
function table_customers_bin_exists($p_bin) {
$conn = msconn();
$k = 1;
mssql_select_db('CCMAIN', $conn) or die ("Can't select databases");
if ($res = mssql_query('select l.long_name, l.inn, l.rts_code, l.rm_broker from CCMAIN.db_owner.Legal l where l.deleted !=\'*\' and l.inn = LTrim(RTrim(\''.$p_bin.'\')) order by l.long_name;'))	{
	echo '
		<p class="text-danger">ВНИМАНИЕ!</p>
		<h4>Список клиентов с совпадающими БИН:</h4>
		<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>#</th>
		        <th>Наименование</th>
		        <th>БИН\ИИН</th>
				<th>Код в ТС</th>
				<th>Код брокера</th>
		      </tr>
		    </thead>
		    <tbody>';
	for ($i = 0; $i < mssql_num_rows( $res ); ++$i)	{
		$row = mssql_fetch_row($res);
		echo
		'
		<tr>
		<td>'.$k++.'</td>
		<td>'.$row[0].'</td>
		<td>'.$row[1].'</td>
		<td>'.$row[2].'</td>
		<td>'.$row[3].'</td>
		</tr>
		';
		}
		echo '</tbody> 
				</table>
				</div>';
	}
mssql_close($conn);
echo '<a class="btn btn-default" href="cabinet.php?p=retry_c01" role="button">Исправить</a>';
echo '&nbsp&nbsp&nbsp';
echo '<a class="btn btn-default" href="cabinet.php?p=cancel" role="button">Отмена</a>';
}
*/


//Проверка на сущ брокера с указанной расчётной парой в БД СС
function db_chk_customer_legal_exists($p_legal_code)
{
  $k = 0;
  $conn = iconnect1();
  if ($res = $conn->query('select count(*) as kol from db_kc1.part_account  p where 
	lower(p.legal_code) = \'' . strtolower($p_legal_code) . '\';'))
    //and p.part_code = \''.$broker.'\';'))
    while ($row = $res->fetch_row())
      $k = $row[0];
  mysqli_close($conn);
  if ($k > 0) return true; else return false;
}


/*
//Клиенты с существующей расчётноц парой
function table_customers_legal_exists($p_legal_code) {
	$conn = msconn();
	$k = 1;
	mssql_select_db('CCMAIN', $conn) or die ("Can't select databases");
	if ($res = mssql_query('select p.part_code, p.owner_name, p.legal_code, p.acc_code from CCMAIN.db_owner.part_account  p where p.legal_code = \''.$p_legal_code.'\' order by p.part_code'))	{
		echo '
		<p class="text-danger">ВНИМАНИЕ!</p>
		<h4>Список клиентов с существующим кодом торгового счёта:</h4>
		<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>#</th>
		        <th>Код брокера</th>
		        <th>БИН\ИИН</th>
				<th>Код в ТС</th>
				<th>Код брокера</th>
		      </tr>
		    </thead>
		    <tbody>';
		for ($i = 0; $i < mssql_num_rows( $res ); ++$i)	{
			$row = mssql_fetch_row($res);
			echo
			'
		<tr>
		<td>'.$k++.'</td>
		<td>'.$row[0].'</td>
		<td>'.$row[1].'</td>
		<td>'.$row[2].'</td>
		<td>'.$row[3].'</td>
		</tr>
		';
		}
		echo '</tbody>
				</table>
				</div>';
	}
	mssql_close($conn);
	echo '<a class="btn btn-default" href="cabinet.php?p=retry_c01" role="button">Исправить</a>';
	echo '&nbsp&nbsp&nbsp';
	echo '<a class="btn btn-default" href="cabinet.php?p=cancel" role="button">Отмена</a>';
}
*/

//История импорта
function table_import_history()
{
  $conn = iconnect();
  $k = 1;
  if ($res = $conn->query('SELECT actual_dtime, created, modified, xmlfilename  FROM db_kc.xml order by created desc;')) {
    echo '
	<h4>История импорта данных:</h4>
	<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>#</th>
		        <th>Актуальность данных на дату</th>
		        <th>Дата выполнения импорта</th>
				<th>Дата изменения данных</th>
				<th>Название файла</th>
		      </tr>
		    </thead>
		    <tbody>';
    while ($row = $res->fetch_row()) {
      echo
        '
				<tr>
					<td>' . $k++ . '</td>
					<td>' . $row[0] . '</td>
					<td>' . $row[1] . '</td>
					<td>' . $row[2] . '</td>
					<td>' . $row[3] . '</td>
				</tr>
				';
    }
    echo '
		    </tbody>
  		</table>
	</div>';
  }
  mysqli_close($conn);
}

function alert_success($msg)
{
  echo '<div class="alert alert-success" role="alert">' . $msg . '</div>';
}

function alert_danger($msg)
{
  echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
}

//получить название поставщика по коду брокера
function db_get_customer_by_broker($broker)
{
  $conn = iconnect();
  if ($res = $conn->query('SELECT c.id, c.full_name FROM db_kc.customers c JOIN db_kc.brokers b ON b.part_code = \'' . $broker . '\' WHERE c.id_broker = b.id ORDER BY c.full_name'))
    while ($row = $res->fetch_row()) {
      echo '<li><a href="cabinet.php?p=delete_client&id=' . $row[0] . '">' . $row[1] . '</a></li>';
    }
  mysqli_close($conn);
}

//получить поле поставщика по его ID
function db_get_customer_by_id($id, $colname)
{
  $ret = null;
  $conn = iconnect();
  if ($res = $conn->query('SELECT c.' . $colname . ' FROM db_kc.customers c WHERE c.id = ' . $id . ';'))
    while ($row = $res->fetch_row())
      $ret = $row[0];
  mysqli_close($conn);
  return $ret;
}

function html_quot($text)
{
  return str_replace('"', '&quot;', $text);
}

//получить поле поставщика по его ID и типую счёта (p - поставка товара, g - гарант, s - спец)
function db_get_customer_account_by_id($id, $acc_num)
{
  $ret = '';
  $conn = iconnect();
  if ($res = $conn->query('SELECT ca.acc_code FROM db_kc.customers c JOIN db_kc.customer_accounts ca ON ca.id_customer = c.id  WHERE c.id = ' . $id . ';'))
    while ($row = $res->fetch_row()) {
      if ($acc_num == 1) $ret = $row[0];
      if ($acc_num == 2)
        if (mysqli_num_rows($res) == 2) $ret = $row[1];
      if ($acc_num == 3)
        if (mysqli_num_rows($res) == 2) $ret = $row[2];
    }
  mysqli_close($conn);
  return $ret;
}

//Количество клиентов брокеа
function db_get_customers_count($broker)
{
  $ret = 0;
  $conn = iconnect();
  if ($res = $conn->query('CALL proc_count_clients(\'' . $broker . '\');'))
    while ($row = $res->fetch_row())
      $ret = $row[0];
  mysqli_close($conn);
  return $ret;
}

//Получить дату и время последнего импорта данных из 1C
function db_get_last_import_datetime()
{
  $ret = null;
  $conn = iconnect();
  if ($res = $conn->query('select created  FROM db_kc.xml order by actual_dtime desc limit 1;'))
    while ($row = $res->fetch_row())
      $ret = $row[0];
  mysqli_close($conn);
  return format_dtime($ret);
}

//форматировать время в локальный формат
function format_dtime($tstamp)
{
  $objDateTime = new DateTime($tstamp);
  return $objDateTime->format(DateTime::RFC1123);
}

//Получить поле профиля MS SQL
function db_get_profile_field_($login, $field_name)
{

  $ret = null;
  $conn = msconn();
  mssql_select_db('STAT', $conn) or die ("Can't select database.");
  if ($res = mssql_query('select ' . $field_name . '  FROM db_kc1.members where firm = \'' . $login . '\';')) {
    for ($i = 0; $i < mssql_num_rows($res); ++$i) {
      $row = mssql_fetch_row($res);
      $ret = $row[0];
    }
  }
  switch ($field_name) {
    case 'name':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'name_e':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'address':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'address_e':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'post_address':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'post_address_e':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    default:
      break;
  }
  mssql_close($conn);
  return $ret;
}

//Получить поле профиля
function db_get_profile_field($login, $field_name)
{
  $broker = db_get_broker_code_by_login($login);
  $ret = null;
  $conn = iconnect1();
  $conn->query("SET NAMES 'utf8'");
  $conn->query("SET CHARACTER SET 'utf8'");
  if ($res = $conn->query('select ' . $field_name . '  FROM db_kc1.members where firm = \'' . $broker . '\';'))
    while ($row = $res->fetch_row())
      $ret = $row[0];
  switch ($field_name) {
    case 'name':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'name_e':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'address':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'address_e':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'post_address':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    case 'post_address_e':
      $ret = str_replace('"', '&quot;', $ret);
      break;
    default:
      break;
  }
  mysqli_close($conn);
  return $ret;
}

//Массовая отправка
function send_email_mass($section, $limit, $offset)
{
  $subject = $_POST['edtSubject'];
  $body = $_POST['edtBody'];
  $conn = iconnect();
//require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
  $mailer = new FreakMailer();
  $mailer->Subject = $subject;
  $mailer->Body = '
<html lang="ru">
		<head>
			<meta charset="utf-8">
		<style>
		body {
			  font-family: Verdana, Arial, Helvetica, sans-serif;
			  font-size:12px;
			}
		p {
			  font-family: Verdana, Arial, Helvetica, sans-serif;
			  font-size:12px;
		}
		</style>
		</head>
		<body>
		<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px">
		' . $body .
    '</span>
	</body>
<html>';
  $k = 1;
  if ($res = $conn->query('select email from db_kc.emails where section_id = ' . $section . ' LIMIT ' . $limit . ' OFFSET ' . $offset . ';')) {
    while ($row = $res->fetch_row()) {
      echo $k++ . ') ' . $row[0] . '</br>';
      try {
        $mailer->AddBCC($row[0]);
      } catch (phpmailerException $e) {
        echo $e->errorMessage();
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    if (isset($_FILES['fileToUpload'])) {
      if ($_FILES["fileToUpload"]["tmp_name"] != '')
        if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
          $mailer->AddAttachment($_FILES['fileToUpload']['tmp_name'], $_FILES['fileToUpload']['name']);
        } else {
          die('Ошибка загрузки вложения!');
        }
    }
    if (!$mailer->Send()) {
      die('Не могу отослать письмо! ' . $mailer->ErrorInfo);
    }
    $mailer->ClearAddresses();
    $mailer->ClearAttachments();
  }
  mysqli_close($conn);
}

function db_get_mail_list($section)
{
  $conn = iconnect();
  $k = 1;
  if ($res = $conn->query('select email from db_kc.emails where section_id = ' . $section . ' order by email;'))
    while ($row = $res->fetch_row()) {
      echo '<tr>';
      echo '<td>' . $k++ . '</td>';
      echo '<td colspan="2">' . $row[0] . '</td>';
      echo '</tr>';
    }
  mysqli_close($conn);
}

function db_addmail($section, $address)
{
  $conn = iconnect();
  $conn->query('insert into emails (section_id, email) values (' . $section . ', \'' . $address . '\');');
  mysqli_close($conn);
}

function SavePics()
{
  for ($i = 0; $i < count($_FILES['pics']['name']); $i++) {
    $tmpFilePath = $_FILES["pics"]["tmp_name"][$i];
    if ($tmpFilePath != '') {
      $newFilePath = "img/uploads/" . $_FILES["pics"]["name"][$i];
      try {
        if (!move_uploaded_file($tmpFilePath, $newFilePath))
          throw new RuntimeException('Ошибка загрузки изображения!');
      } catch (RuntimeException $e) {
        echo $e->getMessage();
      }
    }
  }
}

//Добавить новость
function proc_add_news($content)
{
  $conn = iconnect();
  $res = $conn->query("CALL proc_add_news('$content');");
  mysqli_free_result($res);
  mysqli_close($conn);
}

function show_news()
{
  $conn = iconnect();
  if ($res = $conn->query('select id, publish_date, content from db_kc.news order by publish_date DESC;'))
    while ($row = $res->fetch_row()) {
      echo '
	<table border="0" cellpadding="1" cellspacing="1">
	<tbody>
		<tr>
			<td style="vertical-align:top; width:100px; ">' . date('d.m.Y', strtotime($row[1])) . '</td>
			<td style="text-align: justify;">' . substr($row[2], 0, 455) . '
				<a href="index.php?p=news&id=' . $row[0] . '">подробнее..</a>
			</td>			
		</tr>
	</tbody>
	</table>';
    }
  mysqli_close($conn);
}

function ShowNewsOnMainPage()
{
  $conn = iconnect();
  if ($res = $conn->query('select id, publish_date, content from db_kc.news order by publish_date DESC limit 3;'))
    while ($row = $res->fetch_row()) {
      $txt = substr($row[2], 0, 150);
      $txt = str_replace('<strong>', '', $txt);
      $txt = str_replace('</strong>', '', $txt);
      $txt = str_replace('<p>', '', $txt);
      $txt = str_replace('</p>', '', $txt);
      $txt = str_replace('<em>', '', $txt);
      $txt = str_replace('</em>', '', $txt);
      $txt .= '...';
      echo '
				<p style="font-size: small;">
					<a href="index.php?p=news&id=' . $row[0] . '">' . $txt . '</a>
				</p>';
    }
  mysqli_close($conn);
}

function open_news($id)
{
  $conn = iconnect();
  if ($res = $conn->query('select id, publish_date, content from db_kc.news where id = ' . $id . ' order by publish_date;'))
    while ($row = $res->fetch_row()) {
      echo '
<table border="0" cellpadding="1" cellspacing="1">
<tbody>
	<tr>
		<td style="vertical-align:top; width:100px; "><strong>' . date('d.m.Y', strtotime($row[1])) . '<strong></td>
		<td style="text-align: justify;">' . $row[2] . '
	</tr>
</tbody>
</table>';
    }
  mysqli_close($conn);
}

//найти e-mail в списках рассылок
function db_find_email($param)
{
  $conn = iconnect();
  //выводим результаты поиска в список
  if ($res = $conn->query('
			select e.id, s.name, e.email, e.modified from db_kc.emails e 
			  inner JOIN sections s on s.id = e.section_id
			  WHERE e.email like \'%' . $param . '%\';')) {
    echo '
		<div class="row">
		<div class="form-group">
		<p class="text-left">Результаты поиска <span class="badge">' . $res->num_rows . '</span></p>
		<div class="col-sm-5">';
    while ($row = $res->fetch_row()) {
      echo '
			<div class="checkbox">
				<label>
					<input type="checkbox" value="' . $row[0] . '" name="chkbox[]"><b>' . $row[2] . '</b>
					 <br>(находится в секции "' . $row[1] . '", изменена ' . $row[3] . '
				</label>
			</div>';
    }
  }
  echo '
		</div>
 	</div>
	</div>';
  mysqli_close($conn);
}

function alert($msg)
{
  echo "<script type='text/javascript'>alert('$msg');</script>";
}

function console($msg)
{
  echo "<script type='text/javascript'>console.log('$msg');</script>";
}

function db_delmail($id)
{
  $conn = iconnect();
  $conn->query('delete from db_kc.emails WHERE emails.id = ' . $id . ';');
  mysqli_close($conn);
}

function db_get_sent_form($id)
{
  $conn = iconnect();
  $ret = null;
  $sql = 'select m.msg from db_kc.msg m where id = ' . strval($id) . ';';
  if ($res = $conn->query($sql))
    while ($row = $res->fetch_row())
      $ret = $row[0];
  mysqli_close($conn);
  return $ret;
}

function SendAU02()
{
  global $mail;
  $url = 'cabinet.php?p=';

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
    . $_SESSION['login'] . '" "' . base64_encode($_POST['cms_plain_data']) . '" "' . $_POST['signature'] . '"';
  $locale = 'ru_RU.UTF-8';
  setlocale(LC_ALL, $locale);
  putenv('LC_ALL=' . $locale);
  exec('locale charmap');
  exec($cmd, $output);
  $check_stat = null;
  foreach ($output as $key => $value)
    $check_stat = $value;

  //Отправка таблицы на почту
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
  $subject = 'Заявка AU02 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
  $body = '
				
<p class="text-right"><b>Форма AU03</b></p>
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
  if (!isset($_SESSION['AU02_rows'])) {
    $_SESSION['AU02_rows'] = 1;
  }
  for ($i = 1; $i <= intval($_SESSION['AU02_rows']); $i++) {
    $body .= '<tr>
			<td>
				<input type="text" class="form-control" id="edtAccCode' . $i . '" name="edtAccCode' . $i . '" value="' . $_POST["edtAccCode$i"] . '">
			</td>
<!--
			<td>
				<input type="text" class="form-control" id="edtLotCode' . $i . '" name="edtLotCode' . $i . '" value="' . $_POST["edtLotCode$i"] . '">
			</td>
-->
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
		<table class="table table-bordered" id="myTable">
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

  if ($check_stat == 'true') {
    send_email($to, $to1, $subject, $body);
    $url .= 'sent';
  } else {
    $url .= 'check_error';
  }
  if (isset($_SESSION['AU02_rows'])) {
    unset($_SESSION['AU02_rows']);
  }
  goto_page($url);
}

function SendAU03()
{
  global $mail;
  $url = 'cabinet.php?p=';
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
    . $_SESSION['login'] . '" "' . base64_encode($_POST['cms_plain_data']) . '" "' . $_POST['signature'] . '"';
  $locale = 'ru_RU.UTF-8';
  setlocale(LC_ALL, $locale);
  putenv('LC_ALL=' . $locale);
  exec('locale charmap');
  exec($cmd, $output);
  $check_stat = null;
  foreach ($output as $key => $value)
    $check_stat = $value;

  //Отправка таблицы на почту
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
  $subject = 'Заявка AU03 Форма 2 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
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

  if ($check_stat == 'true') {
    send_email($to, $to1, $subject, $body);
    $url .= 'sent';
  } else {
    $url .= 'check_error';
  }
  if (isset($_SESSION['AU03_rows']))
    unset($_SESSION['AU03_rows']);
  goto_page($url);
}

function SendAU01()
{
  global $mail;
  $url = 'cabinet.php?p=';
  //echo 'БИН: '.$_POST['edt_BIN'];

  $_SESSION['full_name'] = $_POST['edt_full_name'];

  //db_insert_msg($_POST['cms_plain_data']);
  $cmd = '/usr/local/linux-oracle-jdk1.8.0/bin/java -jar /usr/java/egov/kalkan/eds-0.0.1-SNAPSHOT-jar-with-dependencies.jar "'
    . $_SESSION['login'] . '" "' . base64_encode($_POST['cms_plain_data']) . '" "' . $_POST['signature'] . '"';
  $locale = 'ru_RU.UTF-8';
  setlocale(LC_ALL, $locale);
  putenv('LC_ALL=' . $locale);
  exec('locale charmap');
  exec($cmd, $output);
  $check_stat = null;
  foreach ($output as $key => $value)
    $check_stat = $value;

  //Отправка таблицы на почту
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
  $subject = 'Заявка AU01 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
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
  if (!isset($_SESSION['AU01_rows'])) {
    $_SESSION['AU01_rows'] = 1;
  }
  for ($i = 1; $i <= intval($_SESSION['AU01_rows']); $i++) {
    $body .= '<tr>
			<td>
			' . $i . '
			</td>
			<td>
				<input type="text" class="form-control" id="edtAccCode' . $i . '" name="edtAccCode' . $i . '" value="' . $_POST["edtAccCode$i"] . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtLotCode' . $i . '" name="edtLotCode' . $i . '" value="' . $_POST["edtLotCode$i"] . '">
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

  if ($check_stat == 'true') {
    send_email($to, $to1, $subject, $body);
    $url .= 'sent';
  } else {
    $url .= 'check_error';
  }
  if (isset($_SESSION['AU01_rows'])) {
    unset($_SESSION['AU01_rows']);
  }
  if (isset($_SESSION['client_id'])) {
    unset($_SESSION['client_id']);
  }
  goto_page($url);
}

function generateUUID($length)
{
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
  }
  return strtoupper($random);
}

function sessGetVal($name)
{
  return unserialize($_SESSION[$name]);
}

function sessSetVal($name, $val)
{
  $_SESSION[$name] = serialize($val);
}

function postSignature()
{
  $_SESSION['signed'] = $_POST['signed'];
  $_SESSION['signature'] = $_POST['signature'];
  $_SESSION['cms_plain_data'] = $_POST['cms_plain_data'];
}

function postAU021()
{
  $_SESSION['edtRecipient'] = $_POST['edtRecipient'];
  $_SESSION['edtBIN'] = $_POST['edtBIN'];
  $_SESSION['edtAccount'] = $_POST['edtAccount'];
  $_SESSION['edtBank'] = $_POST['edtBank'];
  $_SESSION['edtBIK'] = $_POST['edtBIK'];
  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['edtSum'] = $_POST['edtSum'];
  postSignature();

  if (isset($_POST["clearClient"])) {
    unset($_SESSION['client_id']);
    unset($_SESSION['edtClientBin']);
  }
  if (isset($_POST["LoadData"])) {
    if (!empty($_POST["edtClient"])) {
      if (!isset($_SESSION['client_id'])) {
        $id = $_POST['edtClient'];
        $start_post = strpos($id, "(ID=") + 4;
        $len = strlen($id) - ($start_post + 1);
        $id = substr($id, $start_post, $len);
        $_SESSION['client_id'] = $id;
        $_SESSION['edtClientBin'] = db_get_customer_by_id(intval($_SESSION['client_id']), 'BIN');
      }
    }
    goto_page('cabinet.php?p=AU021');
  }
  $arr = array();
  for ($i = 1; $i <= intval($_SESSION['AU021_ROWS']); $i++) {
    $postedRow = new \lib\AU021RowsData(
      $_POST["edtAccCode$i"],
      $_POST["edtLotCode$i"],
      intval($_POST["edtAmount$i"]));
    array_push($arr, $postedRow);
  }
  sessSetVal('AU021_ARR', $arr);
  if (isset($_POST['AddRow'])) {
    $_SESSION['AU021_ROWS'] = intval($_SESSION['AU021_ROWS']) + 1;
    $newRow = new \lib\AU021RowsData("", "0G", 0);
    array_push($arr, $newRow);
    sessSetVal('AU021_ARR', $arr);
    goto_page('cabinet.php?p=AU021');
  }
  if (isset($_POST['DelRow'])) {
    if (count($arr) > 1) {
      $_SESSION['AU021_ROWS'] = intval($_SESSION['AU021_ROWS']) - 1;
      array_pop($arr);
      sessSetVal('AU021_ARR', $arr);
    }
    goto_page('cabinet.php?p=AU021');
  }
  sendAU021();
}

function postAU022()
{
  $_SESSION['edt_login'] = $_POST['edt_login'];
  $_SESSION['edt_broker_name'] = $_POST['edt_broker_name'];
  $_SESSION['edt_broker_code'] = $_POST['edt_broker_code'];

  $_SESSION['edtRecipient'] = $_POST['edtRecipient'];
  $_SESSION['edtBIN'] = $_POST['edtBIN'];
  $_SESSION['edtAccount'] = $_POST['edtAccount'];
  $_SESSION['edtBank'] = $_POST['edtBank'];
  $_SESSION['edtBIK'] = $_POST['edtBIK'];
  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['edtSum'] = $_POST['edtSum'];
  postSignature();

  $arr = array();
  for ($i = 1; $i <= intval($_SESSION['AU022_ROWS']); $i++) {
    $postedRow = new \lib\AU022RowsData(
      $_POST["edtAccCode$i"],
      intval($_POST["edtAmount$i"]));
    array_push($arr, $postedRow);
  }
  sessSetVal('AU022_ARR', $arr);

  if (isset($_POST['AddRow'])) {
    $_SESSION['AU022_ROWS'] = intval($_SESSION['AU022_ROWS']) + 1;
    $newRow = new \lib\AU022RowsData("", 0);
    array_push($arr, $newRow);
    sessSetVal('AU022_ARR', $arr);
    goto_page('cabinet.php?p=AU022');
  }

  if (isset($_POST['DelRow'])) {
    if (count($arr) > 1) {
      $_SESSION['AU022_ROWS'] = intval($_SESSION['AU022_ROWS']) - 1;
      array_pop($arr);
      sessSetVal('AU022_ARR', $arr);
    }
    goto_page('cabinet.php?p=AU022');
  }
  sendAU022();
}

function sendAU021()
{
  console('Sending AU021..');
  $arr = sessGetVal('AU021_ARR');
  global $mail;
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
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
  $res = send_email($to1, $to, $subject, $body);
  if ($res)
    goto_page('cabinet.php?p=AU021&sent=true&new=true');
  else
    goto_page('cabinet.php?p=AU021&sent=false');
}

function postAU032()
{
  $rowsValName = 'AU032_ROWS';
  $arrValName = 'AU032_ARR';
  $form = 'AU032';
  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['edtSum'] = $_POST['edtSum'];
  $arr = array();
  for ($i = 1; $i < intval($_SESSION[$rowsValName]) + 1; $i++) {
    $postedRow = new \lib\AU032RowsData(
      $_POST["edtMinusForLegal$i"],
      $_POST["edtAddForLegal$i"],
      $_POST["edtLotNumber$i"],
      intval($_POST["edtAmount$i"]));
    array_push($arr, $postedRow);
  }
  sessSetVal($arrValName, $arr);
  if (isset($_POST['AddRow'])) {
    $_SESSION[$rowsValName] = intval($_SESSION[$rowsValName]) + 1;
    $newRow = new \lib\AU032RowsData("", "", "0G", 0);
    array_push($arr, $newRow);
    sessSetVal($arrValName, $arr);
    goto_page('cabinet.php?p=' . $form);
  }
  if (isset($_POST['DelRow'])) {
    if (count($arr) > 1) {
      $_SESSION[$rowsValName] = intval($_SESSION[$rowsValName]) - 1;
      array_pop($arr);
      sessSetVal($arrValName, $arr);
    }
    goto_page('cabinet.php?p=' . $form);
  }
  sendAU032();
}

function sendAU032()
{
  $arr = sessGetVal('AU032_ARR');
  global $mail;
  $_SESSION['full_name'] = $_POST['edt_full_name'];
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
  $subject = 'Заявка AU03 Форма 2 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
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
      <textarea class="form-control" rows="3" id="comment" name="comment">' . $_SESSION['comment'] . '</textarea>
      </br>
      <p class="text-right">Дата: ' . date("d.m.Y") . '</p>';
  $res = send_email($to1, $to, $subject, $body);
  if ($res)
    goto_page('cabinet.php?p=AU032&sent=true&new=true');
  else
    goto_page('cabinet.php?p=AU032&sent=false');
}

function chkC01Empty()
{
  //проверка на пустые поля формы C01
  if (empty($_POST['edt_BIN']) || empty($_POST['edt_legal_code']) || empty($_POST['edt_full_name'])
    || empty($_POST['edt_acc_code_g']) || empty($_POST['edt_acc_code_p']))
    return false;
  return true;
}

function chkC01LengthNotResident()
{
  if (strlen($_POST['edt_BIN']) > 12 || strlen($_POST['edt_legal_code']) > 32
    || strlen($_POST['edt_acc_code_g']) > 32 || strlen($_POST['edt_acc_code_p']) > 32
    || strlen($_POST['edt_full_name']) > 255)
    return false; else return true;
}

function chkC01LengthResident()
{
  if (strlen($_POST['edt_legal_code']) > 32
    || strlen($_POST['edt_acc_code_g']) > 32 || strlen($_POST['edt_acc_code_p']) > 32
    || strlen($_POST['edt_full_name']) > 255)
    return false; else return true;
}

function chkC01BINExists()
{
  //проверка на БИН
  if (db_chk_customer_bin_exists($_POST['edt_BIN'])) return false; else return true;
}

function chkC01LegalCodeExists()
{
  //проверка на расчетную пару
  if (db_chk_customer_legal_exists($_POST['edt_legal_code'])) return false; else return true;
}


function showSignBtnHtml($form)
{
  echo '<div class="row">
          <p class="text-right">
              <button type="button" class="btn btn-info" onclick="SignAndVerify(\'' . $form . '\');">
                  Подписать
              </button>
          </p>
      </div>';
}

function showSignBtn($form)
{
  if (isset($_SESSION['signed'])) {
    if ($_SESSION['signed'] == 'Не подписано') {
      showSignBtnHtml($form);
    }
  } else
    showSignBtnHtml($form);
}

function showSignedFld()
{
  if (!isset($_SESSION['signed'])) $_SESSION['signed'] = 'Не подписано';
  if (!isset($_SESSION['signature'])) $_SESSION['signature'] = '';
  if (!isset($_SESSION['cms_plain_data'])) $_SESSION['cms_plain_data'] = '';
  echo '
   <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
            <p class="text-right" >
               <div id="signedLabel" name="signedLabel">' . $_SESSION['signed'] . '</div>
                <input type="hidden" id="signed" name="signed" type="text" value="' . $_SESSION['signed'] . '" />
                <input type="hidden" id="signature" name="signature" value="' . $_SESSION['signature'] . '"/>
                <input type="hidden" id="cms_plain_data" name="cms_plain_data" value="' . $_SESSION['cms_plain_data'] . '"/>
            </p>
        </div>
    </div>';
}

function unsetC01()
{
  unset($_SESSION['edt_full_name']);
  unset($_SESSION['edt_legal_code']);
  unset($_SESSION['edt_BIN']);
  unset($_SESSION['edt_legal_code']);
  unset($_SESSION['edt_email']);
  unset($_SESSION['edt_acc_code_p']);
  unset($_SESSION['edt_acc_code_g']);
  unset($_SESSION['edt_acc_code_s']);
  unset($_SESSION['comment']);
  unsetSignature();
}

function unsetSignature()
{
  unset($_SESSION['signed']);
  unset($_SESSION['signature']);
  unset($_SESSION['cms_plain_data']);
}

function postC01()
{
  $_SESSION['edt_full_name'] = $_POST['edt_full_name'];
  $_SESSION['edt_legal_code'] = $_POST['edt_legal_code'];
  $_SESSION['edt_BIN'] = $_POST['edt_BIN'];
  $_SESSION['edt_legal_code'] = $_POST['edt_legal_code'];
  $_SESSION['edt_email'] = $_POST['edt_email'];
  $_SESSION['edt_acc_code_p'] = $_POST['edt_acc_code_p'];
  $_SESSION['edt_acc_code_g'] = $_POST['edt_acc_code_g'];
  $_SESSION['edt_acc_code_s'] = $_POST['edt_acc_code_s'];
  $_SESSION['comment'] = $_POST['comment'];
  postSignature();

  if (!chkC01Empty())
    goto_page('cabinet.php?p=C01&error=empty');
  if (!isset($_POST['NotResident']))
    if (!chkC01LengthNotResident())
      goto_page('cabinet.php?p=C01&error=length');
    else
      if (!chkC01LengthResident())
        goto_page('cabinet.php?p=C01&error=length');
  if (!isset($_POST['Restore'])) {
    if (!chkC01BINExists())
      goto_page('cabinet.php?p=C01&error=bin');
    /*if (!chkC01LegalCodeExists())
      goto_page('cabinet.php?p=C01&error=legalCode');*/
  }
  sendC01();
}

function sendC01()
{
  console('Sending C01..');
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
  global $mail;
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
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
  $res = send_email($to1, $to, $subject, $body);
  if ($res)
    goto_page('cabinet.php?p=C01&sent=true&new=true');
  else
    goto_page('cabinet.php?p=C01&sent=false');
}

function writeModal()
{
  echo '<div class="modal fade" id="modalMsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Сообщение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body" name="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>';
}

function unsetAU021()
{
  unset($_SESSION['AU021_ROWS']);
  unset($_SESSION['AU021_ARR']);
  unset($_SESSION['client_id']);
  unset($_SESSION['edtRecipient']);
  unset($_SESSION['edtBIN']);
  unset($_SESSION['edtAccount']);
  unset($_SESSION['edtBank']);
  unset($_SESSION['edtBIK']);
  unset($_SESSION['comment']);
  unset($_SESSION['edtSum']);
  unset($_SESSION['edtClientBin']);
  unsetSignature();
}

function showComment()
{
  echo '
    <div class="row">
          <div class="col-md-5">
              Дополнительная информация:
              <div class="form-group">';
  if (isset($_SESSION['comment']))
    echo '<textarea class="form-control" rows="3" id="comment" name="comment">' . $_SESSION['comment'] . '</textarea>';
  else
    echo '<textarea class="form-control" rows="3" id="comment" name="comment" ></textarea>';
  echo '
            </div>
        </div>
    </div>';
}

function checkSession()
{
  if (!isset($_SESSION)) {
    goto_page('index.php?p=login');
  }
}

function sendAU022()
{
  console('Sending AU022..');
  $arr = sessGetVal('AU022_ARR');
  global $mail;
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
  $subject = 'Заявка AU02 Форма 2 от брокера ' . $_SESSION['edt_broker_name'] . ' (' . $_SESSION['edt_broker_code'] . ')';
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
                  <td>' . $_SESSION['edt_broker_name'] . '</td>
                  <td>' . $_SESSION['edt_broker_code'] . '</td>
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
  $i = 0;
  foreach ($arr as $r => $item) {
    $i += 1;
    $body .= '<tr>
				<td>
					<input type="text" class="form-control" id="edtAccCode' . $i . '" name="edtAccCode' . $i . '" value="' . $item->account . '">
				</td>
				<td>
					<input type="text" class="form-control" id="edtAmount' . $i . '" name="edtAmount' . $i . '" value="' . $item->amount . '">
				</td>
		 	</tr>';
  }
  $body .= '
		<tr>
	    	<td>
				<b>Итого:</b>
			</td>
			<td>
				' . $_SESSION["edtSum"] . '
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
						' . $_SESSION['edtRecipient'] . '
					</td>
				</tr>
		      <tr>
					<td class="success">БИН/ИИН</td>
					<td  class="col-md-9">
						' . $_SESSION['edtBIN'] . '
					</td>
				</tr>
				<tr>
					<td class="success">Номер счета</td>
					<td  class="col-md-9">
						' . $_SESSION['edtAccount'] . '
					</td>
				</tr>
				<tr>
					<td class="success">Наименование банка получателя</td>
					<td  class="col-md-9">
						' . $_SESSION['edtBank'] . '
					</td>
				</tr>
				<tr>
					<td class="success">БИК</td>
					<td  class="col-md-9">
						' . $_SESSION['edtBIK'] . '
					</td>
				</tr>
		    </thead>
		    <tbody>
		   </tbody>
  		</table>
        </div>
    </br>
    Дополнительная информация:
    <textarea class="form-control" rows="3" id="comment" name="comment">' . $_SESSION['comment'] . '</textarea>
    </br>
    <p class="text-right">Дата: ' . date("d.m.Y") . '</p>';
  $res = send_email($to1, $to, $subject, $body);
  if ($res)
    goto_page('cabinet.php?p=AU022&sent=true&new=true');
  else
    goto_page('cabinet.php?p=AU022&sent=false');
}

function unsetAU022()
{
  unset($_SESSION['AU022_ROWS']);
  unset($_SESSION['AU022_ARR']);
  unset($_SESSION['edt_login']);
  unset($_SESSION['edt_broker_name']);
  unset($_SESSION['edt_broker_code']);
  unset($_SESSION['edtRecipient']);
  unset($_SESSION['edtBIN']);
  unset($_SESSION['edtAccount']);
  unset($_SESSION['edtBank']);
  unset($_SESSION['edtBIK']);
  unset($_SESSION['comment']);
  unset($_SESSION['edtSum']);
  unsetSignature();
}

function postAU031()
{
  $rowsVarName = 'AU031_ROWS';
  $arrVarName = 'AU031_ARR';
  $form = 'AU031';

  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['edtSum'] = $_POST['edtSum'];
  postSignature();
  $arr = array();
  for ($i = 1; $i <= intval($_SESSION[$rowsVarName]); $i++) {
    $postedRow = new \lib\AU031RowsData(
      $_POST["edtMinusForLegal$i"],
      $_POST["edtAddForLegal$i"],
      intval($_POST["edtAmount$i"]));
    array_push($arr, $postedRow);
  }
  sessSetVal($arrVarName, $arr);
  if (isset($_POST['AddRow'])) {
    $_SESSION[$rowsVarName] = intval($_SESSION[$rowsVarName]) + 1;
    $newRow = new \lib\AU031RowsData("", "", 0);
    array_push($arr, $newRow);
    sessSetVal($arrVarName, $arr);
    goto_page('cabinet.php?p=' . $form);
  }
  if (isset($_POST['DelRow'])) {
    if (count($arr) > 1) {
      $_SESSION[$rowsVarName] = intval($_SESSION[$rowsVarName]) - 1;
      array_pop($arr);
      sessSetVal($arrVarName, $arr);
    }
    goto_page('cabinet.php?p=' . $form);
  }
  sendAU031();
}

function sendAU031()
{
  global $mail;
  $arr = sessGetVal('AU031_ARR');
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];
  $subject = 'Заявка AU03 Форма 1 от брокера ' . $_POST['edt_broker_name'] . ' (' . $_POST['edt_broker_code'] . ')';
  $body = '
      <p class="text-right"><b>Заявка AU03 Форма 1</b></p>
      <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
      <p class="text-center"><b>ЗАЯВЛЕНИЕ для всех видов торгов ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ </br>ПО УЧЕТУ БИРЖЕВОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА в разрезе регистров</b></p>
                              
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
                      <th>Сумма, тенге</th>
                    </tr>
                  </thead>
                  <tbody>';
  $i = 0;
  foreach ($arr as $r => $item) {
    $i += 1;
    $body .= '<tr>
			<td>
				<input type="text" class="form-control" id="edtMinusForLegal' . $i . '" name="edtMinusForLegal' . $i . '" value="' . $item->fromLegalCode . '">
			</td>
			<td>
				<input type="text" class="form-control" id="edtAddForLegal' . $i . '" name="edtAddForLegal' . $i . '" value="' . $item->toLegalCode . '">
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
    <textarea class="form-control" rows="3" id="comment" name="comment">' . $_SESSION['comment'] . '</textarea>
    </br>
    <p class="text-right">Дата: ' . date("d.m.Y") . '</p>';
  $res = send_email($to1, $to, $subject, $body);
  if ($res)
    goto_page('cabinet.php?p=AU031&sent=true&new=true');
  else
    goto_page('cabinet.php?p=AU031&sent=false');
}

function unsetAU031()
{
  unset($_SESSION['AU031_ROWS']);
  unset($_SESSION['AU031_ARR']);
  unset($_SESSION['edtSum']);
  unset($_SESSION['comment']);
  unsetSignature();
}

function unsetAU032()
{
  unset($_SESSION['AU032_ROWS']);
  unset($_SESSION['AU032_ARR']);
  unset($_SESSION['edtSum']);
  unset($_SESSION['comment']);
  unsetSignature();
}

function postAU04()
{
  $_SESSION['comment'] = $_POST['comment'];
  $_SESSION['edt_login'] = $_POST['edt_login'];
  $_SESSION['edt_broker_name'] = $_POST['edt_broker_name'];
  $_SESSION['edt_broker_code'] = $_POST['edt_broker_code'];

  $arrVarName = 'AU04_ARR';
  $rowsVarName = 'AU04_ROWS';
  $form = 'AU04';

  $arr = array();
  if (!isset($_SESSION[$arrVarName])) sessSetVal($arrVarName, $arr);
  $arr = sessGetVal($arrVarName);

  if (isset($_POST["PostLoadClientData"])) {
    if (!empty($_POST["edt_client"])) {
      $id = $_POST["edt_client"];
      $start_post = strpos($id, "(ID=") + 4;
      $len = strlen($id) - ($start_post + 1);
      $id = substr($id, $start_post, $len);
      $accCodeG = db_get_customer_account_by_id($id, 1);
      $accCodeP = db_get_customer_account_by_id($id, 3);
      array_push($arr, new \lib\AU04RowsData(
        db_get_customer_by_id($id, 'legal_code'),
        db_get_customer_by_id($id, 'BIN'),
        db_get_customer_by_id($id, 'full_name'),
        $accCodeG,
        $accCodeP));
      sessSetVal($arrVarName, $arr);
      $_SESSION[$rowsVarName] = count($arr);
      if ($accCodeG == '' || $accCodeP == '')
        goto_page('cabinet.php?p=' . $form. '&error=account');
    } else
      goto_page('cabinet.php?p=' . $form. '&error=client');
  }

  if (isset($_POST['DelRow'])) {
    if (isset($_SESSION[$arrVarName]))
      if (intval($_SESSION[$rowsVarName]) > 0) {
        array_pop($arr);
        sessSetVal($arrVarName, $arr);
        $_SESSION[$rowsVarName] = count($arr);
      }
    goto_page('cabinet.php?p=' . $form);
  }

  sendAU04();
}

function unsetAU04()
{
  unset($_SESSION['AU04_ROWS']);
  unset($_SESSION['AU04_ARR']);
  unsetSignature();
}

function sendAU04()
{
  global $mail;
  $arr = sessGetVal('AU04_ARR');
  $to = $mail['kc_operator'];
  $to1 = $mail['kc_operator1'];

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
  $i = 0;
  foreach ($arr as $r => $item) {
    $i += 1;
    $body .= ' 
		    <tr>
				<td>' . $item->legalCode . '</td>
				<td>' . $item->bin . '</td>
				<td>' . $item->name . '</td>
				<td>' . $item->accCodeG . '</td>
				<td>' . $item->accCodeP . '</td>
			</tr>';
  }
  $body .= '
			</tbody>
  		</table>
    </div>
    </br>
    Дополнительная информация:
    <textarea class="form-control" rows="3" id="comment" name="comment">' . $_SESSION['comment'] . '</textarea>
    <p class="text-right">Дата: ' . date("d.m.Y") . '</p>';
  $res = send_email($to1, $to, $subject, $body);
  if ($res)
    goto_page('cabinet.php?p=AU04&sent=true&new=true');
  else
    goto_page('cabinet.php?p=AU04&sent=false');
}

function unsetAll()
{
  unsetC01();
  unsetAU021();
  unsetAU022();
  unsetAU031();
  unsetAU032();
  unsetAU04();
}