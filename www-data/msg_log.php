<?php
if (isset($_SESSION['login']))
	{
	$login = $_SESSION['login'];
	if ($_SESSION['logged'] == 'yes')
		if ($login == 'ADMIN' || $login == 'DEV')
			{
			$query = "SELECT * from msg where year(modified) = year(now()) order by modified desc;";
			}
		else
			{
			$query = "SELECT * from msg where login = '$login' and year(modified) = year(now()) 
			order by modified desc;";
			}
	}
$conn = iconnect();
$k = 1;
if ($res = $conn->query($query))
	{
	echo '
	<h4>Журнал отправленных документов:</h4>
	<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th class="title-table">#</th>
				<th class="title-table">Печать</th>
				<th class="title-table">ID</th>
		        <th class="title-table">Логин</th>
				<th class="title-table">Дата и время отправки</th>
		        <th class="title-table">Тело сообщения</th>
				<th class="title-table">Статус проверки ЭЦП</th>
				<th class="title-table">Информация о сертификате</th>
		      </tr>
		    </thead>
		    <tbody>';
		while ($row = $res->fetch_row())
			{
			$status = null;
			if ($row[7] == '1')
				$status = "Успешно";
			else 
				$status = "Ошибка";
			echo
			'
				<tr>
					<td>'.$k++.'</td>
					<td class="title-table"><a href="frm_msg_print.php?p=cab_print&id='.$row[0].'"><span class="glyphicon glyphicon-print"></span></a></td>
					<td>'.$row[0].'</td>
					<td class="col-md-1">'.$row[1].'</td>
					<td class="col-md-3">'.$row[6].'</td>
					<td class="col-md-3">'.$row[2].'</td>
					<td class="col-md-1">'.$status .'</td>
					<td class="cert"><p>'.$row[4].'<p></td>
				</tr>
				';
		}
		echo '
		    </tbody>
  		</table>
	</div>';
	}
else
	{
		alert_danger("Ошибка чтения данных. Обратитесь в техподдержку.</h4");
	}
mysqli_close($conn);
?>