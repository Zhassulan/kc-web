<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="KEYWORDS" content=""/>
    
    <title>Вопросы и ответы</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    </head>

<body>
<div class="container">

<div class="row">
<a href="http://www.ets.kz"><img src="img/ets_header.jpg" class="img-responsive" alt="Responsive image"></a>		
</div>
</br>
<div class="row">
	<div class="col-md-6">
		<div id="about"> 
		
		<b><p>Уважаемые клиенты и партнеры Биржи ЕТС!</p></b>

<p>АО «Товарная биржа «Евразийская Торговая Система» (далее - Биржа ЕТС) ориентирована на предоставление участникам товарного рынка полного набора биржевых услуг и клирингового обслуживания, соответствующих международным стандартам и нацеленных на справедливое рыночное ценообразование на биржевые товары.
Биржа ЕТС заинтересована в проведении прозрачных конкурентных торгов, с  обеспечением максимальной прозрачности процедур реализации товаров и равного доступа потенциальных покупателей/участников биржевой торговли к биржевым торгам.
</p>
<p> 
В указанных целях, на сайте Биржи ЕТС запущена «Горячая линия», по которой Вы можете сообщать нам информацию о следующих видах правонарушений со стороны  клиентов, участников торгов:
</p>
<ul>
<li>обо всех неправомерных действиях брокеров/дилеров, аккредитованных на Бирже ЕТС;</li>
<li>о несоблюдении брокерами/дилерами регламента торгов Биржи ЕТС;</li>
<li>о несоблюдении требований законодательства РК и внутренних нормативных документов Биржи ЕТС;</li>
<li>о недобросовестных поставщиках;</li>
<li>о неисполнении обязательств по биржевым сделкам;</li>
<li>по другим интересующим Вас вопросам.</li>
</ul>
<p>Для передачи информации Вы можете:</p>
<ol>
<li>написать электронное письмо с изложением сути вопроса, используя электронный шаблон, размещенный на данной странице;</li>
<li>задать вопрос, используя систему онлайн консультации.</li>
<li>позвонить на call-center <a href="tel:244-44-55"><i class="fa fa-phone"></i>244-44-55</a>
для Алматы и <a href="tel:88000800505"><i class="fa fa-phone"></i>8 800 080-05-05</a> по Казахстану звонок бесплатный.</li>
</ol>
<p>Заранее благодарим Вас за плодотворное сотрудничество, за обратную связь и рекомендации по совершенствованию сервиса Биржи ЕТС.
</p>  
		
		</div>
	</div>
	<div class="col-md-6">
		<form id="frm" name="frm" method="post" action="post_qanda_ets.php">
		  <div class="form-group">
		  	<label for="edtText">Текст обращения</label>
		  	<textarea class="form-control" id="edtText" name="edtText" rows="5"></textarea>
		  </div>
		  <div class="form-group">
		  	<p>Ваша электронная почта для получения ответа</p>
    		<input type="email" class="form-control" id="edtEmail" name="edtEmail" placeholder="janna@mail.kz">
		  </div>
		  <button type="submit" class="btn btn-default">Отправить</button>
		  </form>
		  <?php
		    if (isset($_GET['p']))
		 		{
		 		alert_success('Информация отправлена, спасибо.');
		 		}
	 	   ?>
	 	   </br>
	 	   </br>
		<div class="row">
			<div class="col-md-4">
			<label for="edtText">On-line консультант</label>
				<!-- mibew button -->
				<a id="mibew-agent-button" href="/mibew/index.php/chat?locale=ru" target="_blank" onclick="Mibew.Objects.ChatPopups['5739a23b44a0b291'].open();return false;"><img src="/mibew/index.php/b?i=mibew&amp;lang=ru" border="0" alt="" /></a><script type="text/javascript" src="/mibew/js/compiled/chat_popup.js"></script><script type="text/javascript">Mibew.ChatPopup.init({"id":"5739a23b44a0b291","url":"\/mibew\/index.php\/chat?locale=ru","preferIFrame":true,"modSecurity":false,"width":640,"height":480,"resizable":true,"styleLoader":"\/mibew\/index.php\/chat\/style\/popup"});</script>
				<!-- / mibew button -->
			</div> 
		</div>	
	</div>
</div>
</br>

</div>	
</body>
</html>