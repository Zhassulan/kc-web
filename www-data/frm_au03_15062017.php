<form id="frm" name="frm" method="post" action="post_au03.php" enctype="multipart/form-data">
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">Форма AU03</h3>
  </div>
<div class="panel-body">
<p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
<p class="text-center"><b>ЗАЯВЛЕНИЕ ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ ПО УЧЕТУ ГАРАНТИЙНОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА</b></p>
<input type="hidden" id="edt_form" name="edt_form" value="Форма AU03. ЗАЯВЛЕНИЕ ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ ПО УЧЕТУ ГАРАНТИЙНОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА"/>
<input type="hidden" id="edt_date" name="edt_date" value="<?php $objDateTime = new DateTime('NOW'); echo $objDateTime->format(DateTime::RFC1123);?>"/>
<input type="hidden" id="edt_login" name="edt_login" value="<?php echo $_SESSION['login']; ?>"/>
<input type="hidden" id="edt_broker_name" name="edt_broker_name" value="<?php echo html_quot(db_get_broker_name_by_login($_SESSION['login']));?>"/>
<input type="hidden" id="edt_broker_code" name="edt_broker_code" value="<?php echo db_get_broker_code_by_login($_SESSION['login']);?>"/>

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
				<td> 
					<?php echo db_get_broker_name_by_login($_SESSION['login']); ?>
				</td>
				<td>
					<?php echo db_get_broker_code_by_login($_SESSION['login']); ?>
				</td>
			</tr>
			</tbody>
  		</table>
	</div>

<?php
$conn = iconnect();
echo '<script>var states = [';
if ($res = $conn->query('
select ca.acc_code from customers c
  join users u on u.login = \''.$_SESSION['login'].'\'
  join brokers b on b.part_code = u.broker_code
  join customer_accounts ca on ca.id_customer = c.id
WHERE c.id_broker = b.id order by ca.acc_code;'))
while ($row = $res->fetch_row())
	{
	echo '\''.$row[0].'\','.PHP_EOL;
	}
mysqli_close($conn);
echo ']; </script>';
?>
           
</br>
Прошу изменить учет обязательств по перечислению денежных средств на разделах клирингового регистра:
<div class="table-responsive">
		<table class="table table-bordered" id="myTable" name="myTable">
    		<thead>
		      <tr class="success">
		        <th>№</th>
				<th>Снять с учета на разделе</th>
				<th>Поставить на учет на разделе</th>
				<th>Код лота</th>
				<th>Сумма, тенге</th>
				</tr>
		    </thead>
		    <tbody>
		    <?php
		    //echo $_SESSION['AU03_add_row'];
		    if (!isset($_SESSION['AU03_rows']))
		    	{
		    	$_SESSION['AU03_rows'] = 1;
		    	}
		    	echo '<input type="hidden" id="edtRows" name= "edtRows" value="'.$_SESSION['AU03_rows'] .'"/>';
		    for ($i=1; $i <= intval($_SESSION['AU03_rows']); $i++)
		    	{
		    	echo '<tr>
						<td>
						'.$i.'
						</td>
						<td>
							<div id="the-basics">
							<input class="typeahead" type="text" placeholder="Набирайте текст..." id="edtMinusForLegal'.$i.'" name="edtMinusForLegal'.$i.'">
							</div>
							<!--<input type="text" class="form-control" id="edtMinusForLegal'.$i.'" name="edtMinusForLegal'.$i.'">-->
						</td>
						<td>
							<div id="the-basics">
							<input class="typeahead" type="text" placeholder="Набирайте текст..." id="edtAddForLegal'.$i.'" name="edtAddForLegal'.$i.'">
							</div>
							<!--<input type="text" class="form-control" id="edtAddForLegal'.$i.'" name="edtAddForLegal'.$i.'"> -->
						</td>
						<td>
							<input type="text" class="form-control" id="edtLotNumber'.$i.'" name="edtLotNumber'.$i.'" value="0G">
						</td>
						<td>
							<input type="text" class="form-control" id="edtAmount'.$i.'" name="edtAmount'.$i.'">
						</td>
					 </tr>';
		    	}
		    ?>
		    <tr>
			    <td>
				</td>
				<td>
				</td>
				<td>
				</td>
		    	<td class="text-right">
					 <button type="button" onclick="funcSum()">Суммировать</button>
					 <b>Итого:</b>
					 <script>
						function funcSum() {
    					    var tot = 0;
    					    var val = 0;
    					    var max = parseInt(document.getElementById('edtRows').value);
    					    for	(var i = 1; i <= max; i++)	{
        					    var name = 'edtAmount' + String(i);
    					    	val = parseFloat(document.getElementById(name).value);
  					            tot += val; 
    					    }
    					    document.getElementById('edtSum').value = tot.toFixed(2);
						} 
					</script>
				</td>
				<td>
					<input type="text" class="form-control" id="edtSum" name="edtSum">
				</td>
		    </tr>
			</tbody>
  		</table>
</div>

<div class="row">
	<div class="col-md-3">
		<ul class="nav">
			  <li class="nav-item">
			    <a class="nav-link active" href="https://kc-ets.kz/cabinet.php?p=AU03_add_row">Добавить строку</a>
			  </li>
		</ul>
	</div>
	<div class="col-md-3">
		<ul class="nav">
			  <li class="nav-item">
			    <a class="nav-link active" href="https://kc-ets.kz/cabinet.php?p=AU03_del_row">Удалить строку</a>
			  </li>
		</ul>
	</div>
</div>

<div class="row">
<div class="col-md-5">
	Дополнительная информация:
	<div class="form-group">
		<textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
	</div>
</div></div>

<div class="row">
 <p class="text-right">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Подписать</button>
</p>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Электронная цифровая подпись</h4>
	      </div>
	      <div class="modal-body">
	        <!--  <form>  -->
	          <div class="form-group">
	            <label for="recipient-name" class="control-label">Тип хранилища ключа:</label>
	            <select onchange="chooseStoragePath();" id="storageAlias" size="1" style="width:100%;">
                    <option value="NONE">-- Выберите тип --</option>
                    <option value="PKCS12">Ваш Компьютер</option>
                    <option value="AKKaztokenStore">Казтокен</option>
                    <option value="AKKZIDCardStore">Личное Удостоверение</option>
                    <option value="AKEToken72KStore">EToken Java 72k</option>
                    <option value="AKJaCartaStore">AK JaCarta</option>
                </select>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="control-label">Путь хранилища ключа</label>
                <input class="form-control" id="storagePath" type="text" placeholder="" disabled>
	          </div>
	          <div class="form-group">
	            <label for="message-text" class="control-label">Пароль хранилища</label>
			    <input type="password" class="form-control" id="password" placeholder="">
	          </div>
	          <div class="form-group">
	          	<label for="message-text" class="control-label">Список ключей</label>
	            <input type="hidden" id="keyAlias" value=""/>
                <select  onchange="keysOptionChanged();" id="keys"></select>
                <input value="Обновить список ключей" onclick="fillKeys();" type="button"/>
	          </div>
	        <!-- </form> -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
	        <button type="button" class="btn btn-primary" onclick="SignAndVerify('AU03');">Подписать</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>

<div class="row">
	<div class="col-md-10">
	</div> 
	<div class="col-md-2">
		<p class="text-right">
			 <!-- <p class="text-right">Дата подписи: <?php echo date("d.m.Y");?></p>  -->
			<input class="form-control" id="signed" name = "signed" type="text" value="Не подписано" disabled/>
			<input type="hidden" id="signature" name= "signature" value=""/>
			<input type="hidden" id="cms_plain_data" name= "cms_plain_data" value=""/> 
		</p>
	</div>
</div>

</div>

</div>

<button type="submit" class="btn btn-default">Отправить</button>
&nbsp&nbsp
<a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
</form>

