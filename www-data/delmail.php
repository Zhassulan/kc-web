<h4>Удалить адрес из списка рассылки:</h4>

<form id="frm" name="frm" method="post" action="post_delmail.php">

<?php 
if (isset($_GET['p']))
	{
	switch ($_GET['post'])
		{
		case 'found':
			echo '<button type="submit" class="btn btn-default">Удалить</button>';
			break;
		case 'find':
			db_find_email($_GET['email']);
			echo '<button type="submit" class="btn btn-default">Удалить</button>';
			break;
		case 'empty':
			echo '<div class="row">
				<div class="col-md-3">
				<div class="form-group">
				    <label for="edtParam">Введите адрес или параметр для поиска</label>
				    <input type="text" class="form-control" id="edtFindmail" name="edtFindmail" placeholder="E-mail" value="">
			  </div>
			  </div>
			</div>';
			alert_danger('Введите параметр для поиска.');
			echo '<button type="submit" class="btn btn-default">Поиск</button>';
			break;
		case 'deleted':
			alert_success('Выбранный адрес удалён.');
			echo '<div class="row">
				<div class="col-md-3">
				<div class="form-group">
				    <label for="edtParam">Введите адрес или параметр для поиска</label>
				    <input type="text" class="form-control" id="edtFindmail" name="edtFindmail" placeholder="E-mail" value="">
			  </div>
			  </div>
			</div>';
			break;
		default:
			echo '<div class="row">
				<div class="col-md-3">
				<div class="form-group">
				    <label for="edtParam">Введите адрес или параметр для поиска</label>
				    <input type="text" class="form-control" id="edtFindmail" name="edtFindmail" placeholder="E-mail" value="">
			  </div>
			  </div>
			</div>';
			echo '<button type="submit" class="btn btn-default">Поиск</button>';
			break;
		}
	}
?>
&nbsp&nbsp
<a class="btn btn-default" href="cabinet.php?p=delmail" role="button">Отмена</a>
</form>
<p></p>
