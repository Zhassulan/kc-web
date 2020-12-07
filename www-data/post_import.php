<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Отправка данных..</title>
</head>
<body>
<p>Импорт данных..</p>
<?php
set_time_limit(1200);
require_once 'lib/func.inc';
if ($_FILES["edtFile"]["error"] > 0) die ('Ошибка файла: '.$_FILES["edtFile"]["error"].'</br>');
$xml = simplexml_load_file($_FILES["edtFile"]["tmp_name"]) or die("XML Error: Cannot create object");
if ($xml === false) {
	foreach(libxml_get_errors() as $error) {
		echo "<br>", $error->message;
	}
	die ("Failed loading XML: ");
}
else
	{
	echo $xml->getName().'</br>';
	$dt_string = $xml->attributes()->ActualData;
	$datetime = new DateTime($dt_string, new DateTimeZone('Asia/Almaty'));
	echo $datetime->format('Y-m-d H:i:s').'</br>';
	echo 'Очистка таблиц..</br>';
	xml_copy_all();
	xml_truncate_all();
	echo 'Идёт импорт, не закрывайте браузер..</br>';
	echo '</br>';
	xml_add_root($datetime->format('Y-m-d H:i:s'), $_FILES['edtFile']['tmp_name'], $_FILES['edtFile']['name']);
	
	$i = 1;
	foreach ($xml->children() as $brokers) 
		{
		$i++;
		//if ($i == 4) break;
		//echo $i.') '.$brokers->FullName.'</br>';
		//echo $i.') '.$brokers->BIN.'</br>';
		//echo $i.') '.$brokers->Total_amount.'</br>';
		$BrokerCode = null;
		foreach ($brokers->children() as $cust)	
			{
			$j = 1;
			/*
			echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$j++.') '.$cust->FullName.'</br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$j++.') '.$cust->BIN.'</br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$j++.') '.$cust->Account->Part_code.'</br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$j++.') '.$cust->Account->Legal_code.'</br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$j++.') '.$cust->Account->Acc_code.'</br>';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$j++.') '.$cust->Account->Total_amount.'</br>';
			*/
			if (!empty($cust->Account->Part_code))
				{
				if (is_null($BrokerCode))
					{
					$BrokerCode = $cust->Account->Part_code;
					echo '</br>';
					echo 'Добавляется брокер:';
					echo '</br>';
					echo $brokers->FullName.'</br>';
					echo $BrokerCode.'</br>';
					echo $brokers->BIN.'</br>';
					echo $brokers->Total_amount.'</br>';
					if (empty($brokers->Total_amount))
						$amount = 0;
					else 
						$amount = intval($brokers->Total_amount);
					xml_add_broker($brokers->FullName, $BrokerCode, $brokers->BIN, $amount);
					}
				}
			if (!empty($cust->FullName))
				{
				echo '</br>';
				echo 'Добавляется клиент брокера:</br>';
				echo $cust->FullName.'</br>';
				echo $cust->BIN.'</br>';
				echo $cust->Account->Total_amount.'</br>';
				echo $cust->Account->Part_code.'</br>';
				echo $cust->Account->Acc_code.'</br>';
				echo $cust->Account->Legal_code.'</br>';
				xml_add_customer($cust->FullName, $cust->BIN, $cust->Account->Total_amount, 
					$cust->Account->Part_code, $cust->Account->Acc_code, $cust->Account->Legal_code);
				}
			}
		}
	unlink($_FILES["edtFile"]["tmp_name"]);
	//die();
	goto_page('cabinet.php?p=import_done');
	}
?>
</body>
</html>