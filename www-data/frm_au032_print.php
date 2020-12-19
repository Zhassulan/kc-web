<div class="container">
<div class="row">

<div class="panel-heading">
    <h3 class="panel-title">Заявка AU03 Форма 2</h3>
</div>

<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ для спецаукциона ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ</br> ПО УЧЕТУ БИРЖЕВОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА в разрезе лотов</b></p>

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
Прошу изменить учет обязательств по перечислению денежных средств на разделах клирингового регистра:
<div class="table-responsive">
		<table class="table table-bordered" id="myTable" name="myTable">
    		<thead>
		      <tr class="success">
				<th>Снять с учета на разделе</th>
				<th>Поставить на учет на разделе</th>
				<th>Код лота</th>
				<th>Сумма, тенге</th>
				</tr>
		    </thead>
		    <tbody>
		    <?php
		    foreach ($msg_arr as $item) {
		    	if (strpos($item, 'Снять с учета на разделе Отправителя:') !== false)
		    		{
	    			echo '<tr>';
	    			$tar = explode(":", $item);
	    			echo '<td>'.$tar[1].'</td>';
		    		}
		    	if (strpos($item, 'Поставить на учет на разделе Получателя:') !== false)
		    		{
		    		$tar = explode(":", $item);
		    		echo '<td>'.$tar[1].'</td>';
		    		}
	    		if (strpos($item, 'Номер лота:') !== false)
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