<!DOCTYPE html>
<html lang="ru">
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="print" href="css/print.css">
	<meta charset="UTF-8">
	<title>Печать отправленной заявки</title>
	<style>
   @font-face {
    font-family: Roboto; /* Имя шрифта */
    src: url(fonts/roboto/Roboto-Light.ttf); /* Путь к файлу со шрифтом */  }
    
    /* для печати на A4*/
     html, body {
            width: 210mm;
            height: 297mm;        
        }
    </style>
</head>
<body>
<?php
require_once 'lib/func.inc';
$id = $_GET['id'];
$msg = db_get_sent_form($id);
$msg_arr = explode(";", $msg);

if (strpos($msg, 'Форма C01.') !== false)
	{
	$frm = "C01";
	require_once 'frm_c01_print.php';
	}
if (strpos($msg, 'Заявка AU02 Форма 1.') !== false)
	{
	$frm = "AU021";
	require_once 'frm_au021_print.php';
	}
if (strpos($msg, ' AU02 Форма 2.') !== false) 
	{
	$frm = "AU022";
	require_once 'frm_au022_print.php';
	}
if (strpos($msg, 'Форма AU03.') !== false)
	{
	$frm = "AU03";
	require_once 'frm_au03_print.php';
	}
if (strpos($msg, 'Заявка AU03 Форма 1.') !== false)
	{
	$frm = "AU031";
	require_once 'frm_au031_print.php';
	}
if (strpos($msg, 'Заявка AU03 Форма 2.') !== false)
	{
	$frm = "AU03";
	require_once 'frm_au03_print.php';
	}
if (strpos($msg, 'Форма AU04.') !== false)
	{
	$frm = "AU04";
	require_once 'frm_au04_print.php';
	}
//echo $frm;
if (isset($_SESSION['login']))
	if ($_SESSION['logged'] == 'yes')
		if ($_SESSION['login'] == 'ADMIN' || $_SESSION['login'] == 'DEV')
		{
		echo '
		<div class="row"> <!-- You can also position the row if need be. -->
		<div class="col-md-12 col-lg-12"><!-- set width of column I wanted mine to stretch most of the screen-->
		<hr style="min-width:85%; background-color:#a1a1a1 !important; height:1px;"/>
		</div>
		 </div>
		 Заполняется ТОО «Клиринговый центр ЕТС»:</br>
		
		Документ вх.№ _________ получен __.__.__
		                                                          дата    
		';
		}
?>
 
</body>
</html>