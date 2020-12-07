<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Сайт Клиринговый Центр ЕТС">
    <meta name="author" content="Клиринговый центр ЕТС">
    <meta name="KEYWORDS" content="Клиринговый центр, финансовые услуги для бирж, Казахстан, Алматы, АО Товарная биржа ЕТС, биржа в Казахстане, товарная биржа, 
	биржа, торговля товарами, торговля зерном, торговля металлами, Алматы достык 136 бизнес центр Пионер 3,
	торговля спец товарами, ЕТС, клиринг, клиринг биржевых сделок, биржевое обеспечение, 
	гарантийное обеспечение, брокер, биржевые тарифы, тарифы за клиринг, сделки в товарами, 
	дилер, правила клиринга, правила торговли, страховой фонд, гарантийный фонд, обязательства сторон, 
	зачет взаимных требований и обязательств, участники клиринга."/>
    
    <title>Клиринговый Центр ЕТС</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="print" href="css/print.css">
    
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	
	<link href="css/font-awesome.min.css" rel="stylesheet">
	
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
           
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    
    <!-- <script src='https://www.google.com/recaptcha/api.js' async defer></script> -->
    
    <!-- Google Analytics -->
    <!--
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-48471918-2', 'auto');
	  ga('send', 'pageview');
	</script>
	-->
   <style>
   @font-face {
    font-family: Roboto; /* Имя шрифта */
    src: url(fonts/roboto/Roboto-Light.ttf); /* Путь к файлу со шрифтом */  }
    </style>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:+78000800505"><i class="fa fa-phone"></i>8(727)244-44-55</a></li>
								<li><a href="mailto:yugay@ets.kz"><i class="fa fa-envelope"></i>yugay@ets.kz</a></li>
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
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="img/logo1.png" alt=""/></a>
						</div>
						
						<div class="btn-group pull-right">
							
						</div>
					</div>
					<div class="col-sm-8">
					
						<div class="shop-menu pull-right">
						
							<ul class="nav navbar-nav">
								
								<li>
								<p style = "color: #B22222; font-size: 18px;">8 800 080-05-05</p>
								<a href="index.php?p=login"><i class="fa fa-lock"></i>
								Личный кабинет</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
				  <div class="col-xs-6 col-sm-1">
				  	
				  </div>
				  <div class="col-xs-6 col-sm-10 menubg">
				  <div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" <?php if (!isset($_GET['p'])) echo 'class="active"';?>>Главная</a></li>
								<li class="dropdown"><a href="#" <?php if ($_GET['p']=='about' || $_GET['p']=='head' || $_GET['p']=='role' || $_GET['p']=='bank') echo 'class="active"';?>>О нас<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href='index.php?p=about'>О Клиринговом центре ЕТС</a></li>
								         <li><a href='index.php?p=head'>Руководство Клирингового центра ЕТС</a></li>
								         <li><a href='index.php?p=role'>Основные функции и услуги Клирингового центра ЕТС</a></li>
								         <!-- <li><a href='index.php?p=docs'>Нормативные документы</a></li>  -->
								         <li><a href='index.php?p=bank'>Банковские реквизиты</a></li>
                                    </ul>
                                </li>
                                 
								<li><a href="index.php?p=tarifs" <?php if ($_GET['p']=='tarifs') echo 'class="active"';?>>Тарифы</a></li>
								<li><a href="index.php?p=docs" <?php if ($_GET['p']=='docs') echo 'class="active"';?>>Документы</a></li>
								<li><a href="index.php?p=report"  <?php if ($_GET['p']=='report') echo 'class="active"';?>>Информация</a></li>
								<li><a href="index.php?p=news"  <?php if ($_GET['p']=='news') echo 'class="active"';?>>Новости</a></li>
								<li><a href="index.php?p=contacts" <?php if ($_GET['p']=='contacts') echo 'class="active"';?>>Контакты</a></li>
								
								<li class="dropdown"><a href="#" <?php if ($_GET['p']=='etp') echo 'class="active"';?>>ЕТС-ТЕНДЕР<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                    	<li><a href='https://kc-ets.kz?p=about_tender'>О ЕТС-ТЕНДЕР</a></li>
                                    	<li><a href='https://kc-ets.kz/docs/etp/dogovor.docx'>Публичный Договор оферта на участие в ЕТС-Тендер</a></li>
                                    	<li><a href='https://kc-ets.kz/docs/etp/list.docx'>Подписной лист</a></li>
                                    	<li><a href='https://kc-ets.kz/docs/etp/price.docx'>Тарифы</a></li>
	                                    <li><a href='https://www.kc-ets.kz/docs/etp/gloss.docx'>Глоссарий  терминов и определений</a></li>
	                                    <li><a href='https://kc-ets.kz/docs/etp/reglament_23-08-2017.pdf'>Регламент ЕТС-Тендер</a></li>
    									<!--  <li><a href='https://kc-ets.kz/docs/etp/memorandum.docx'>Меморандум о сотрудничестве по ЕТС-Тендер</a></li> -->
                                    </ul>
                                </li> 
								
							</ul>
						</div>
				  </div>
				  <div class="col-xs-6 col-sm-1"></div>	
				  	
				  </div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

<?php 

if (!isset($_GET['p'])) 
	{
	require_once 'slider.php';
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
			require_once 'docs_new.php';
			break;
		case 'tarifs':
			require_once 'tarifs.php';
			break;
		case 'bank':
			require_once 'bank1.php';
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
		case 'about_tender':
			require_once 'about_tender.php';
			break;
		case 'clearing':
			require_once 'clearing.php';
			break;
		}
	echo '</div></div>';
	}
?>
	<footer id="footer"><!--Footer-->
		
				
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">&copy; ТОО "Клиринговый центр ЕТС". Адрес: Казахстан, 	050051 г. Алматы пр.Достык 136.
					<!--   <a href="http://s05.flagcounter.com/more/YWI"><img src="http://s05.flagcounter.com/count2/YWI/bg_85969e/txt_FFFFFF/border_85969e/columns_2/maxflags_2/viewers_3/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>-->
					<!-- <a href="https://analytics.google.com/analytics/web/?hl=ru&pli=1#report/defaultid/a48471918w116210839p121522742/" title="Посещения в Google Analytics"><img src="img/ga.jpg" alt="Посещения в Google Analytics" style="width:30px;height:30px;"></a> -->
					<?php
/*                    require_once 'lib/gapi.class.php';
                    $ga = new gapi('peak-summer-132423@appspot.gserviceaccount.com','google_cloud.p12');

                    $ga->requestReportData(121522742,array('browser','browserVersion'),array('pageviews','visits'));*/

                    /*
                    foreach($ga->getResults() as $result)
                    {
                      echo '<strong>'.$result.'</strong><br />';
                      echo 'Pageviews: ' . $result->getPageviews() . ' ';
                      echo 'Visits: ' . $result->getVisits() . '<br />';
                    }
                    */
                    //echo 'Просмотр стр.: ' . $ga->getPageviews() . ' посещений: ' . $ga->getVisits();
                    ?>

					
					<!-- Yandex.Metrika informer -->
                    <!-- <a href="https://metrika.yandex.ru/stat/?id=37598405&amp;from=informer"
                    target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/37598405/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:37598405,lang:'ru'});return false}catch(e){}" /></a> -->
                    <!-- /Yandex.Metrika informer -->

                    <!-- Yandex.Metrika counter -->
                    <!--
                    <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter37598405 = new Ya.Metrika({
                                        id:37598405,
                                        clickmap:true,
                                        trackLinks:true,
                                        accurateTrackBounce:true
                                    });
                                } catch(e) { }
                            });

                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = "https://mc.yandex.ru/metrika/watch.js";

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="https://mc.yandex.ru/watch/37598405" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    -->
                    </p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>