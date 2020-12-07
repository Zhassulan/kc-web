<div class="row-fluid" id="pwd-container">
<legend>Регистрация нового пользователя</legend>
<form method="post" action="register_user.php">
	<div class="form-group">
		<label for="exampleInputName2">Логин</label>
		<?php
		if (isset($_SESSION['login']))
			{
			echo '<input type="text" class="form-control" name="frm_login" id="frm_login" value="'.$_SESSION['login'].'">';
			}
		else 
			echo '<input type="text" class="form-control" name="frm_login" id="frm_login" placeholder="...">'; 
		?>
		<p class="help-block">Требования: Цифра, буква, длина не менее 4 не более 12 символов.</p>
		<?php
		if (isset($_GET['login']))
			{
			if ($_GET['login'] == 'bad')
				echo '<div class="alert alert-danger" role="alert">Логин не отвечает требованиям.</div>';
			if ($_GET['login'] == 'exist')
				echo '<div class="alert alert-danger" role="alert">Такой логин уже занят.</div>';
			}
		?>
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">Пароль</label>
		<input type="text" class="form-control" name="frm_pwd" id="frm_pwd" placeholder="...">
		<p class="help-block">Требования: Цифра, буква, длина не менее 8 не более 12 символов.</p>
		<?php
		if (isset($_GET['pwd']))
			{
			echo '<div class="alert alert-danger" role="alert">Пароль не отвечает требованиям.</div>';
			}
		?>
	</div>
	<div class="form-group">
		<label for="exampleInputEmail">Электронная почта</label>
		<?php
		if (isset($_SESSION['email']))
			{
			echo '<input type="email" class="form-control" id="frm_email" name="frm_email" value="'.$_SESSION['email'].'">';
			}
		else 
			echo '<input type="email" class="form-control" id="frm_email" name="frm_email" placeholder="Email">'; 
		?>
		<?php
		if (isset($_GET['email']))
			{
			echo '<div class="alert alert-danger" role="alert">Некорректный почтовый адрес.</div>';
			}
		?>
	</div>
	<!--
	<div class="form-group">
	<label for="exampleInputFile">File input</label>
	<input type="file" id="exampleInputFile">
	<p class="help-block">Example block-level help text here.</p>
	</div>
	-->
	<!--
	<div class="checkbox">
	<label>
	<input type="checkbox">Запомнить
	</label>
	</div>
	-->
	<button type="submit" class="btn btn-success">Отправить</button>
	<a class="btn btn-default" href="index.php?p=login" role="button">Отмена</a>
</form>
</div>