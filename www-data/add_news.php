<!--  [img]http://sadasd[/img]  -->

<h4>Добавление новостей:</h4>

<form class="form-horizontal" id="frm" name="frm" method="post" action="post_addnews.php">
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">Новость</h3>
  </div>
  <div class="panel-body">
 <div class="form-group">
    <label for="edtBody" class="col-sm-2 control-label">Текст публикации</label>
    <div class="col-sm-8">
		<textarea class="form-control" rows="25" id="edtBody" name="edtBody">
		</textarea>
		<script type="text/javascript">
		CKEDITOR.replace( 'edtBody' );
		</script>	
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

<button type="submit" class="btn btn-default">Опубликовать</button> &nbsp&nbsp
<a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
</form>
<p></p>