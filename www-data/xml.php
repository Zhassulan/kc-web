<!--  <section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
			<?php 
			
			$xml = simplexml_load_file("20151231.xml") or die("Error: Cannot create object");
			
			//print_r($xml);
			//echo $xml->Broker[0]->FullName.'</br>';
			//echo $xml->Broker[0]->BIN.'</br>';
			//echo $xml->Broker[0]->Total_amount.'</br>';
			if ($xml === false) {
				echo "Failed loading XML: ";
				foreach(libxml_get_errors() as $error) {
					echo "<br>", $error->message;
				}
			}
			else
			{
			echo $xml->getName().'</br>';
			//echo $xml->attributes()->ActualData.'</br>';
			$dt_string = $xml->attributes()->ActualData;
			$datetime = new DateTime($dt_string, new DateTimeZone('Asia/Almaty'));
			//$dt1 = $datetime->format('Y-m-d H:i:s');
			//$dt = new DateTime($st1);
			echo $datetime->format('Y-m-d H:i:s').'</br>';
			//очистка таблиц
			xml_truncate_all();
			xml_add_root($datetime->format('Y-m-d H:i:s'));
			foreach($xml->children() as $brokers) {
				//echo '-------------------------Брокер--------------------------------</br>';
				//echo 'Брокер: '.$brokers->FullName.'</br>';
				//echo 'БИН: '.$brokers->BIN.'</br>';
				//echo 'ВСЕГО: '.$brokers->Total_amount.'</br>';
				//echo '</br>';
				
				xml_add_broker($brokers->FullName, $brokers->BIN, $brokers->Total_amount);
				
				foreach ($brokers->children() as $cust)	{
					//echo '-------------------------клиент--------------</br>';
					//echo 'Наименование клиента: '.$cust->FullName.'</br>';
					//echo 'БИН: '.$cust->BIN.'</br>';
					$cust_part_code = '';
					$cust_legal_code = '';
					$cust_acc_code = '';
					$cust_total = 0;
					foreach ($cust->children() as $account)	{
						if (!empty($account->Part_code) && !empty($account->Legal_code) && !empty($account->Acc_code) && !empty($account->Total_amount))
							{
							//echo 'Код брокера: '.$account->Part_code.'</br>';
							$cust_part_code = $account->Part_code;
							//echo 'Код торг. счёта: '.$account->Legal_code.'</br>';
							$cust_legal_code = $account->Legal_code;
							//echo 'Код раздела регистра: '.$account->Acc_code.'</br>';
							$cust_acc_code = $account->Acc_code;
							//echo 'Средства: '.$account->Total_amount.'</br>';
							$cust_total = (float)$account->Total_amount;
							xml_add_customer($cust->FullName, $cust->BIN, $cust_total, $cust_part_code, $cust_acc_code, $cust_legal_code);
							}
					}
				}
			}
			echo 'Импорт завершён.';
			}
			?>
			</div>
		</div>
<!-- </section>  -->