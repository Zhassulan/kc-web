<h4>Добавить сертификат для пользователя:</h4>

<form id="frm" name="frm" method="post" action="post_addcert.php">

<div class="row">
<div class="form-group">
    <label for="edtFirm" class="col-sm-2 control-label">Секция</label>
    <div class="col-sm-5">
      <div class="checkbox">
		  <label>
		    <input type="checkbox" value="1" name="chkbox[]">
		    Специализированные товары
		  </label>
	  </div>
	  <div class="checkbox">
		  <label>
		    <input type="checkbox" value="2" name="chkbox[]">
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
		    <input type="checkbox" value="3" name="chkbox[]">
		    Метал и промтовары
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
 </div>
 
<div class="row">
	<div class="col-md-3">
	<div class="form-group">
	    <label for="edtNewmail">Адрес</label>
	    <input type="text" class="form-control" id="edtNewmail" name="edtNewmail" placeholder="E-mail" value="">
  </div>
  </div>
</div>

<button type="submit" class="btn btn-default">Добавить</button>
&nbsp&nbsp
<a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
</form>
<p></p>
