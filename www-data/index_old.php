<?php
session_start();
require_once 'lib/func.inc';
?>
<!DOCTYPE html>

<html lang="ru">
<head>
 	<meta charset="UTF-8">
 	<meta name="KEYWORDS" content="<?php require_once 'keywords.php'; ?>"/>
 	<meta name="DESCRIPTION" content=""/>
 	<meta name="copyright" content="АО Товарная биржа ЕТС"/>
 	<link rel="shortcut icon" href="img/favicon.ico"/>
 	
   	<link rel="stylesheet" type="text/css" href="css/styles.css" />
   	
   	
   	<link rel="stylesheet" type="text/css" href="css/animate.css" />	 
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
   	
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
    <script src="bootstrap/js/bootstrap.min.js"></script> 
    <script src="bootstrap/js/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/menu1.css" />
		
	<title>Клиринговый Центр ЕТС</title>
	
</head>

<body>

<div id="mycontainer">
<div class="container-fluid">

<div class="row-fluid">
	<div class="span2">
		<div id="mylogo">
			<img alt="logo" src="img/logo1.png">	
		</div>
	</div>
	<div class="span8">
		<div id="toptitle"> 
			<p class="toptitleFont">Клиринговый центр ЕТС</p>
		</div>
	</div>
	<div class="span2">
		<div class="row">
			
			<?php
			if (isset($_SESSION["logged"]))
				{
				if ($_SESSION["logged"] == 'yes')
					{
					//echo '<p class="cur_user_title">Пользователь: '.$_SESSION["login"];
					echo '<span class="label label-info">'.$_SESSION["login"].'</span>';
					//echo '<button type="button" class="btn btn-default btn-xs">Выход</button></p>';
					}
				}
			?>
		</div>
		<div class="row">
			&nbsp
		</div>
		<div class="row">
		    <form class="form-search">
		      	<div class="input-append">
			        <input type="text" class="span7 search-query">
			        <button type="submit" class="btn">Поиск</button>
		    	</div>
    		</form>
	  	</div>
	</div>
</div>

<div class="row-fluid">
	<?php 
	require_once 'menu_top1.php';
	?>
</div>

<!-- CONTENT -->
<div class="row-fluid">

<?php 

if (!isset($_GET['p'])) 
	{
	//require_once 'slider.php';
	}
else 
	{
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
		}
	}
?>

<!-- CONTENT END -->
</div>

<div class="row-fluid"> 
	<?php require_once 'footer.php'; ?> <!-- Footer-->
</div>

</div> <!-- div CONTAAINER FLUID-->
</div> <!-- div myCONTAINER -->

<!-- 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
     -->
</body>
</html>