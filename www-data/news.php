<?php 
if ($_GET['p'] == 'news' && !isset($_GET['id'] ))
	show_news();
if (isset($_GET['id'] ))
	open_news($_GET['id']);
?>
