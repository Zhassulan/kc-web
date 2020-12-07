<form id="frm" name="frm" method="post" action="post_import.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputFile">Ввод файла</label>
    <input type="file" id="edtFile" name="edtFile">
    <p class="help-block">Выберите файл данных 1С для импорта в ЛК КЦ.</p>
  </div>
  <button type="submit" class="btn btn-default">Импорт</button>
  &nbsp&nbsp
	<a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
</form>