<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Биржевая ассоциация Казахстана">
    <meta name="author" content="Биржевая ассоциация Казахстана">
    <meta name="KEYWORDS" content=""/>
    
    <title>Биржевая ассоциация Казахстана</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	
    <link rel="shortcut icon" href="img/favicon.ico"/>
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    
</head>

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:+78000800505"><i class="fa fa-phone"></i>244-44-55, 8 800 080-05-05 бесплатный.</a></li>
								<li><a href="mailto:baytleuov@ets.kz"><i class="fa fa-envelope"></i> baytleuov@ets.kz</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.kc-ets.kz"><i class="fa fa-home fa-fw" aria-hidden="true"></i></a></li>
								<li><a href="http://www.ets.kz"><i class="fa fa-globe" aria-hidden="true"></i></a></li>
								<li><a href="https://www.facebook.com/www.ets/?ref=br_rs"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/ETS_press"><i class="fa fa-twitter"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li>  -->
								<!-- <li><a href="#"><i class="fa fa-dribbble"></i></a></li> -->
								<!--  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>  -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="logo pull-left">
							<a href="index.php"><img src="img/logo_bak.png" alt="" /></a>
						</div>
						
						<div class="btn-group pull-left">
							<ul class="nav nav-pills nav-justified">
							 <li><a href="index.php">Главная</a></li> 
							 <li><a href="index.php">Список&nbsp;членов</a></li> 
							 <li><a href="index.php">Отчёт&nbsp;о&nbsp;деятельности</a></li>
							 <li><a href="index.php">Контакты</a></li>
							</ul>						
						</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		
	</header><!--/header-->

<?php 

if (!isset($_GET['p'])) 
	{
	//require_once 'slider.php';
	}
else 
	{
	echo '<div class="container">
			<div class="row">';
	switch ($_GET['p']) 
		{
		case 'about':
			require_once 'about.php';
			break;
		case 'head':
			require_once 'head.php';
			break;
		case 'role':
			require_once 'role.php';
			break;
		case 'docs':
			require_once 'docs.php';
			break;
		case 'tarifs':
			require_once 'tarifs.php';
			break;
		case 'bank':
			require_once 'bank.php';
			break;
		case 'contacts':
			require_once 'contacts.php';
			break;
		case 'login':
			require_once 'frm_login.php';
			break;
		case 'register':
			require_once 'frm_register.php';
			break;
		case 'news':
			require_once 'news.php';
			break;
		case 'reviews':
			require_once 'reviews.php';
			break;
		case 'report':
			require_once 'report.php';
			break;
		case 'explore':
			require_once 'explore.php';
			break;
		case 'require':
			require_once 'require.php';
			break;
		}
	echo '</div></div>';
	}
?>
	<footer id="footer"><!--Footer-->
		
				
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">&copy; ТОО "Клиринговый центр ЕТС". Тел: 244-44-55. Адрес: Казахстан, 	050051 г. Алматы пр.Достык 136, БЦ "Пионер-3".</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
</body>
</html>