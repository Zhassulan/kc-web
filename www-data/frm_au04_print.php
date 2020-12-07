<div class="container">
<div class="row">

<div class="panel-heading">
    <h3 class="panel-title">Форма AU04</h3>
</div>

<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА ЗАКРЫТИЕ КОДОВ ТОРГОВЫХ СЧЕТОВ И РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ</b></p>

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
</br>	
Прошу закрыть следующие Коды торговых счетов и разделов клиринговых регистров:
<!-- <div class="table-responsive">  -->
		<table class="table table-bordered" id="myTable" name="myTable">
    		<thead>
		      <tr class="success">
				<th>Код торгового </br>счета</th>
				<th>БИН/ИИН</th>
				<th>Наименование</th>
				<th>Код раздела регистра</br> учета гарантийного </br>обеспечения</th>
				<th>Код раздела регистра </br>учета денег для </br>оплаты Товара</th>
				</tr>
		    </thead>
		    <tbody>
		    <?php
		    foreach ($msg_arr as $item) {
		    	if (strpos($item, 'Код торгового счёта:') !== false)
		    		{
	    			echo '<tr>';
	    			$tar = explode(":", $item);
	    			echo '<td>'.$tar[1].'</td>';
		    		}
		    	if (strpos($item, 'БИН/ИИН:') !== false)
		    		{
		    		$tar = explode(":", $item);
		    		echo '<td>'.$tar[1].'</td>';
		    		}
	    		if (strpos($item, 'Наименование:') !== false)
	    			{
	    			$tar = explode(":", $item);
	    			echo '<td>'.$tar[1].'</td>';
	    			}
	    		if (strpos($item, 'Код раздела регистра учёта гарантийного обеспечения:') !== false)
	    			{
    				$tar = explode(":", $item);
    				echo '<td>'.$tar[1].'</td>';
	    			}
	    		if (strpos($item, 'Код раздела регистра учёта денег для оплаты Товара:') !== false)
	    			{
	    				$tar = explode(":", $item);
	    				echo '<td>'.$tar[1].'</td>';
	    				echo '</tr>';
	    			}
		    	}
		    ?>
			</tbody>
  		</table>
<!--  </div>  -->

</br>

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