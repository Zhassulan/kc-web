<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

/* Сюда впишите свою эл. почту */
 $mail_to = "badyganov@ets.kz";
 $mail_to_name = "ahmetova";


    #Адрес сервера
    $SmtpServer="ssl://smtp.yandex.ru";
    #Адрес порта
    $SmtpPort="465";
    #Логин авторизации на сервера SMTP
    $SmtpUser="badyganov.ilyas@yandex.kz";
    #Пароль авторизации на сервера SMTP
    $SmtpPass="cff34ff24enl";

   
    if (isset($_POST['telephone'])) {$telephone = $_POST['telephone'];}
 if (isset($_POST['fio'])) {$fio = $_POST['fio'];}
 if (isset($_POST['email'])) {$email = $_POST['email'];}
 if (isset($_POST['sale'])) {$sale = $_POST['sale'];}
 if (isset($_POST['sale1'])) {$sale1 = $_POST['sale1'];}
 if (isset($_POST['prop'])) {$prop = $_POST['prop'];}
 if (isset($_POST['col'])) {$col = $_POST['col'];}
 if (isset($_POST['country'])) {$country = $_POST['country'];}
 if (isset($_POST['point'])) {$point = $_POST['point'];}
 if (isset($_POST['transport'])) {$transport = $_POST['transport'];}
 if (isset($_POST['suver'])) {$suver = $_POST['suver'];}
 if (isset($_POST['inshurance'])) {$inshurance = $_POST['inshurance'];}



/* А здесь прописывается текст сообщения, \n - перенос строки */
 $mes = "Тема: новый запрос!<br>ФИО: $fio<br>Телефон: $telephone<br>E-mail: $email<br>Вы хотите: $sale<br>Товар: $sale1<br>Качественные характеристики: $prop<br>Количество: $col<br>Страна назначения: $country<br>Пункт назначения: $point<br>Дополнительные сервисы<br>Транспорт и логистика $transport<br>Сюрвейерские услуги: $suver<br>Страхование поставки: $inshurance";

/* А эта функция как раз занимается отправкой письма на указанный вами email */
$thm='Запрос услуг'; //сабж
$email_name='robot'; // от кого

$mail = new PHPMailer(true); 
	try {
		$mail->IsSMTP();
		$mail->Host       = $SmtpServer;
		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = true;
		$mail->Port       = $SmtpPort;
		$mail->Username   = $SmtpUser;
		$mail->Password   = $SmtpPass;
	
			$mail->CharSet  = 'UTF-8';
			$mail->setLanguage('ru', '/phpmail/lang/');
			$mail->AddAddress($mail_to, $mail_to_name);
			$mail->setFrom($SmtpUser, $email_name);
			$mail->isHTML(true);
			$mail->Subject = $thm;
			
			$mail->Body    =$mes;
			
			$mail->send();

	}
	catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="refresh" content="3; url=http://ets.kz">
<title>С вами свяжутся</title>
<meta name="generator">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> 
<style type="text/css">
    
        body {
            background: #85969E;
        }
        
        .container {
            background: #fff;
        }
        
        footer {
            height: 80px;
        }
        h3 {
            font-size: 1.5em;
        }
        
        .help-block {
            font-size: 12px;
        }
        
        .control-label {
            font-size: 12px;
        }
        .col-md-4 {
            background: rgb(240, 240, 240) none repeat scroll 0% 0%
        }
        
        .btn-danger {
            margin-top: 30px;
            margin-bottom: 40px;
        }
    
</style>
<script type="text/javascript">
setTimeout('location.replace("http://ets.kz")', 3000);
/*Изменить текущий адрес страницы через 3 секунды (3000 миллисекунд)*/
</script> 
</head>
<body>
<div class="container">
        <div class="row">
            <a href="http://ets.kz"><img src="img/main.png"></a>
        </div>
        
        <div class="row">
            <h3 style="text-align: center">Экспортный центр ЕТС</h3>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <h3 style="text-align: center">Запрос принят</h3>
                <h3 style="text-align: center">С Вами свяжеться наш менеджер!</h3>
            
       
            
            </div>
            
            <div class="col-md-4">
            <h3>Информация по заявке</h3>
                <p>Для получения полной информации по заключению биржевых сделок  обращаться  call-center</p>
                <p>+7 727 244-44-55  добавочный 7417 и 8 800 080-05-05 добавочный 7417  (по Казахстану звонок бесплатный). </p>
                
                
            
            
            </div>
        
    
        </div>
        

    </div>
                    <footer> 
                    </footer>
    
    
    
    
</body>
</html>