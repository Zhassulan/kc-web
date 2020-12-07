<!--  [img]http://sadasd[/img]  -->

<h4>Рассылка:</h4>

<form class="form-horizontal" id="frm" name="frm" method="post" enctype="multipart/form-data" action="post_mailing.php">
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">Сообщение</h3>
  </div>
  <div class="panel-body">
  
 <div class="form-group">
    <label for="edtFirm" class="col-sm-2 control-label">Получатели</label>
    <div class="col-sm-5">
      <div class="checkbox">
		  <label>
		    <input type="checkbox" value="1" name="chkbox[]">
		    Специализированные товары
		  </label>
	  </div>
	  <div class="checkbox">
		  <label>
		    <input type="checkbox" value="2" name="chkbox[]"
		    <?php
			if ($_GET['p'] == 'daily_agro')
				echo 'checked';
			?>
		    >
		    Сельхозпродукция
		  </label>
	  </div>
	  <div class="checkbox">
		  <label>
		    <input type="checkbox" value="4" name="chkbox[]">
		    Сельхозпродукция (платная)
		  </label>
	  </div>
		<div class="checkbox">
		  <label>
		    <input type="checkbox" value="3" name="chkbox[]"
		    <?php
			if ($_GET['p'] == 'daily_metall')
				echo 'checked';
			?>
		    >
		    Метал и промтовары
		  </label>
	  </div>	
	  <div class="checkbox">
		  <label>
		    <input type="checkbox" value="6" name="chkbox[]">
		    ЭТП
		  </label>
	  </div>
	  <div class="checkbox">
		  <label>
		    <input type="checkbox" value="5" name="chkbox[]">
		    Тестовая
		  </label>
	  </div>
    </div>
 </div>
 <div class="form-group">
    <label for="edtSubject" class="col-sm-2 control-label">Тема письма</label>
    <div class="col-sm-8">
		<input type="text" class="form-control" id="edtSubject" name="edtSubject" placeholder="Тема" 
		
		<?php
		if ($_GET['p'] == 'daily_metall')
			echo 'value="Динамика изменения биржевых индикаторов по цементу марки ПЦ 400 Д23 и цена за 10 июня 2016 г."';
		if ($_GET['p'] == 'daily_agro')
			echo 'value="Цена пшеницы и ячменя на Бирже ЕТС на 10 июня 2016 г."';
		?>
		>		
    </div>
 </div>
 <div class="form-group">
    <label for="edtAttach" class="col-sm-2 control-label">Рисунки</label>
    <div class="col-sm-8">
      Выберите один или несколько рисунков для загрузки:
    <input type="file" name="pics[]" multiple>
    </div>
 </div>
  <div class="form-group">
  <label for="edtAttach" class="col-sm-2 control-label">Загрузка рисунков</label>
    <button type="submit" id="submit" class="btn btn-default" name = 'UploadEmbedPics' value = 'UploadEmbedPics'>Загрузить</button>
  </div>
 <div class="form-group">
    <label for="edtBody" class="col-sm-2 control-label">Текст сообщения</label>
    <div class="col-sm-8">
    	<p>Пример ссылки изображения https://kc-ets.kz/img/uploads/grafik.jpg </p>
		<textarea class="form-control" rows="25" id="edtBody" name="edtBody">
		<?php
		if ($_GET['p'] == 'daily_metall')
			require_once 'daily_metall.php';
		if ($_GET['p'] == 'daily_agro')
			require_once 'daily_agro.php';
		?>				
		</textarea>
		<script type="text/javascript">
		CKEDITOR.replace( 'edtBody' );
		</script>	
    </div>
 </div>
 <div class="form-group">
    <label for="edtAttach" class="col-sm-2 control-label">Вложение</label>
    <div class="col-sm-8">
      Выберите файл для загрузки:
    <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
 </div>
 
 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="Agree" name="Agree" value="Agree">Подтверждаю
        </label>
      </div>
    </div>
 </div>

  </div>
</div>

<button type="submit" class="btn btn-default">Отправить</button> &nbsp&nbsp
<a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
</form>
<p></p>