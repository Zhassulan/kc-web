<div class="container">
<div class="row">

<div class="panel-heading">
    <h3 class="panel-title">Форма AU01</h3>
</div>

<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ</b></p>

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


Прошу возвратить денежные средства Участника клиринга: 
<div class="table-responsive">
 		<table class="table table-bordered">
    		<thead>
		      <tr class="success">
				 <th>Клиент участника клиринга</th>
				 <th>БИН/ИИН</th>
			  </tr>
		    </thead>
		    <tbody>
		     <tr>
				<?php
			    foreach ($msg_arr as $item) {
			    	if (strpos($item, 'Участник:') !== false)
			    		{
		    			$tar = explode(":", $item);
		    			echo '<td>'.$tar[1].'</td>';
			    		}
			    	}
			    ?>
				<?php
			    foreach ($msg_arr as $item) {
			    	if (strpos($item, 'БИН/ИИН участника:') !== false)
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

<div class="table-responsive">
		<table class="table table-bordered" id="myTable" name="myTable">
    		<thead>
		      <tr class="success">
				<th>Код раздела</th>
				<th>Код лота</th>
				<th>Сумма, тенге</th>
				</tr>
		    </thead>
		    <tbody>
		    <?php
		    foreach ($msg_arr as $item) {
		    	//echo $item.'</br>';
		    	if (strpos($item, 'Код раздела:') !== false)
		    		{
	    			echo '<tr>';
	    			$tar = explode(":", $item);
	    			echo '<td>'.$tar[1].'</td>';
		    		}
		    	if (strpos($item, 'Код лота:') !== false)
		    		{
		    		$tar = explode(":", $item);
		    		echo '<td>'.$tar[1].'</td>';
		    		}
	    		if (strpos($item, 'Сумма, тенге:') !== false)
	    			{
	    			$tar = explode(":", $item);
	    			echo '<td>'.$tar[1].'</td>';
	    			echo '</tr>';
	    			}
		    	}
		    ?>
		    <td>
		    </td>
		    	<td class="text-right">
					 <b>Итого:</b>
				</td>
				<?php
			    foreach ($msg_arr as $item) {
			    	if (strpos($item, 'Итого:') !== false)
			    		{
		    			$tar = explode(":", $item);
		    			echo '<td>'.$tar[1].'</td>';
			    		}
			    	}
			    ?>
			</tbody>
  		</table>
</div>

</br>
	по следующим реквизитам (<b>*</b>):
<div class="row">
<div class="col-md-8">
	<div class="table-responsive">
		<table class="table table-bordered" id="myTable" name="myTable">
    		<thead>
    			<tr>
					<td class="success">Наименование получателя</td>
					<td  class="col-md-9">
						 <?php
					    foreach ($msg_arr as $item) {
					    	//echo $item.'</br>';
					    	if (strpos($item, 'Наименование получателя:') !== false)
					    		{
				    			$tar = explode(":", $item);
				    			echo $tar[1];
					    		}
					    	}
					    ?>
					</td>
				</tr>
		      <tr>
					<td class="success">БИН/ИИН</td>
					<td  class="col-md-9">
						<?php
					    foreach ($msg_arr as $item) {
					    	//echo $item.'</br>';
					    	if (strpos($item, 'БИН/ИИН:') !== false)
					    		{
				    			$tar = explode(":", $item);
				    			echo $tar[1];
					    		}
					    	}
					    ?>
					</td>
				</tr>	
				<tr>
					<td class="success">Номер счета</td>
					<td  class="col-md-9">
						<?php
					    foreach ($msg_arr as $item) {
					    	//echo $item.'</br>';
					    	if (strpos($item, 'Номер счета:') !== false)
					    		{
				    			$tar = explode(":", $item);
				    			echo $tar[1];
					    		}
					    	}
					    ?>
					</td>
				</tr>
				<tr>
					<td class="success">Наименование банка получателя</td>
					<td  class="col-md-9">
						<?php
					    foreach ($msg_arr as $item) {
					    	//echo $item.'</br>';
					    	if (strpos($item, 'Наименование банка получателя:') !== false)
					    		{
				    			$tar = explode(":", $item);
				    			echo $tar[1];
					    		}
					    	}
					    ?>
					</td>
				</tr>	
				<tr>
					<td class="success">БИК</td>
					<td  class="col-md-9">
						<?php
					    foreach ($msg_arr as $item) {
					    	//echo $item.'</br>';
					    	if (strpos($item, 'БИК:') !== false)
					    		{
				    			$tar = explode(":", $item);
				    			echo $tar[1];
					    		}
					    	}
					    ?>
					</td>
				</tr>
		    </thead>
		    <tbody>
		   </tbody>
  		</table>
	</div>
</div>
</div>

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