<div class="container">
<div class="row">

<div class="panel-heading">
    <h3 class="panel-title">Форма С01</h3>
</div>


<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА РЕГИСТРАЦИЮ КОДОВ ТОРГОВЫХ СЧЕТОВ И ОТКРЫТИЕ РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ</b></p>

От:
<div class="table-responsive">
  		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>Наименование:</th>
				<th>Код участника клиринга:</th>
				</tr>
		    </thead>
		    <tbody>
		    <tr>
				<?php
			    foreach ($msg_arr as $item) {
			    	if (strpos($item, 'Брокер:') !== false)
			    		{
		    			$tar = explode(":", $item);
		    			echo '<td>'.$tar[1].'</td>';
			    		}
			    	if (strpos($item, 'Код брокера:') !== false)
			    		{
		    			$tar = explode(":", $item);
		    			echo '<td>'.$tar[1].'</td>';
			    		}
			    	}
			    ?>
			</tr>
			</tbody>
  		</table>
	</div>
Прошу зарегистрировать следующие Коды торговых счетов:
<!-- <div class="table-responsive">  -->
		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				<th>Код </br>торгового</br> счета</th>
				<th>БИН/ИИН</th>
				<th>Наименование</th>
				<th>E-mail</th>
				<th>Код раздела </br>регистра учёта </br>гарантийного </br>обеспечения</th>
				<th>Код раздела </br>регистра учёта </br>денег для оплаты </br>Товара</th>
				</tr>
		    </thead>
		    <tbody>
		    <tr>
				<?php
				foreach ($msg_arr as &$item) {
					$tar = explode(":", $item);
					$item = $tar[1];
				}
				echo '<td>'.$msg_arr[4].'</td>';
				?> 
				<td> <?php echo $msg_arr[5];?> </td>
				<td style="word-wrap:break-word;"> <?php echo $msg_arr[6];?> </td>
				<td> <?php echo $msg_arr[7];?> </td>
				<td> <?php echo $msg_arr[8];?> </td>
				<td> <?php echo $msg_arr[9];?> </td>
			</tr>
			</tbody>
  		</table>
<!-- </div>  -->

<div class="row">
<div class="col-md-5">
	Дополнительная информация:
	<div class="form-group">
		<textarea class="form-control" rows="3" id="comment" name="comment"><?php echo substr($msg, strpos($msg, "Дополнительная информация:") + 50, strlen($msg) - (strpos($msg, "Дополнительная информация:") + 140)); ?> </textarea>
	</div>
</div></div>

<div class="row">
	<div class="col-md-8">
	</div> 
	<div class="col-md-4">
		<p class="text-right">
			<input class="form-control" id="signed" name = "signed" type="text" value="Подписано <?php echo substr($msg, strpos($msg, "Дата и время создания документа:") + 59, strlen($msg) - (strpos($msg, "Дата и время создания документа:") + 50));?>>" disabled/>
		</p>
	</div>
</div>

</div>
</div>
