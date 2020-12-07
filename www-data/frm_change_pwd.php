<div class="row-fluid" id="pwd-container">
<legend>При первом входе необходимо сменить пароль</legend>
<form method="post" action="check_new_pwd.php">
	<div class="form-group">
		<label for="exampleInputName2">Логин</label>
		<input class="form-control" id="disabledInput" type="text" name="frm_login" placeholder="<?php echo $_SESSION['login'] ?>" disabled>
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">Новый пароль</label>
		<input type="password" class="form-control" name="frm_pwd_new" id="frm_pwd_new" placeholder="...">
		<label for="exampleInputPassword1">Повторите</label>
		<input type="password" class="form-control" name="frm_pwd_new1" id="frm_pwd_new1" placeholder="...">
		<p class="help-block">Требования: Цифра, буква лат. большая и маленькая, длина не менее 8 не более 12 символов.</p>
		<?php
		if (isset($_GET['pwd']))
			alert_danger('Пароль не отвечает требованиям.');
		?>
	</div>
	<button type="submit" class="btn btn-success">Изменить</button>
	<a class="btn btn-default" href="index.php" role="button">Отмена</a>
</form>
</div>