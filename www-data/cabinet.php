<?php
require_once 'lib/func.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <meta charset="cp1251">  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Сайт Клиринговый Центр ЕТС">
    <meta name="author" content="Клиринговый центр ЕТС">
    <meta name="KEYWORDS" content="<?php require_once 'keywords.php'; ?>"/>

    <title>Личный кабинет</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/print.css" rel="stylesheet" type="text/css" media="print">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="lib/typeahead/new/style.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

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
            src: url(fonts/roboto/Roboto-Light.ttf); /* Путь к файлу со шрифтом */
        }
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
                            <li><a href="tel:+78000800505"><i class="fa fa-phone"></i>244-44-55, 8 800 080-05-05
                                    бесплатный.</a></li>
                            <li><a href="mailto:yugay@ets.kz"><i class="fa fa-envelope">&nbsp</i>yugay@ets.kz</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.kc-ets.kz"><i class="fa fa-home fa-fw" aria-hidden="true"></i></a>
                            </li>
                            <li><a href="http://www.ets.kz"><i class="fa fa-globe" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.facebook.com/www.ets/?ref=br_rs"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="https://twitter.com/ETS_press"><i class="fa fa-twitter"></i></a></li>
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
                <div class="col-sm-4">
                    <div class="btn-group pull-right">
                        <h3>Личный кабинет</h3>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <input type="hidden" id="login" value="<?php
                            if (isset($_SESSION['logged'])) {
                              if ($_SESSION['logged'] == 'yes')
                                echo $_SESSION['login'];
                              else
                                echo '';
                            }
                            ?>"/>
                            <li><a href="index.php?p=login"><i class="fa fa-lock"></i>
                                <?php
                                if (isset($_SESSION['logged'])) {
                                  if ($_SESSION['logged'] == 'yes')
                                    echo $_SESSION['login'];
                                } else
                                  echo 'Личный кабинет';
                                ?></a></li>
                            <li>
                              <?php
                              if (isset($_SESSION["logged"])) {
                                if ($_SESSION["logged"] == 'yes')
                                  echo '<a class = "btn btn-primary btn-xs" href="cabinet.php?p=exit" role="button">Выйти</a>';
                              } else {

                                echo '<a class = "btn btn-primary btn-xs" href="cabinet.php?p=enter" role="button">Войти</a>';
                              }
                              ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-12 menubg">
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li>
                                <a href="cabinet.php" <?php if (!isset($_GET['p'])) echo 'class="active"'; ?>>Главная</a>
                            </li>
                            <li>
                                <a href="cabinet.php?p=profile" <?php if ($_GET['p'] == 'profile') echo 'class="active"'; ?>>Профиль</a>
                            </li>
                            <li>
                                <a href="cabinet.php?p=all_clients" <?php if ($_GET['p'] == 'all_clients') echo 'class="active"'; ?>>Клиенты</a>
                            </li>
                            <li>
                                <a href="cabinet.php?p=accounts" <?php if ($_GET['p'] == 'accounts') echo 'class="active"'; ?>>Регистры
                                    учёта</a></li>
                            <li class="dropdown"><a
                                        href="#" <?php if ($_GET['p'] == 'C01' || $_GET['p'] == 'au04') echo 'class="active"'; ?>>Заявки<i
                                            class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href='cabinet.php?p=C01&new=true'>Заявка на открытие C01</a></li>
                                    <li><a href='cabinet.php?p=AU021&new=true'>Заявка на возврат спец AU02 Форма 1</a></li>
                                    <li><a href='cabinet.php?p=AU022&new=true'>Заявка на возврат ДВАА AU02 Форма 2</a></li>
                                    <li><a href='cabinet.php?p=AU031&new=true'>Заявка об изменении AU03 Форма 1</a></li>
                                    <li><a href='cabinet.php?p=AU032&new=true'>Заявка об изменении спец AU03 Форма 2</a></li>
                                    <li><a href='cabinet.php?p=AU04&new=true'>Заявка на удаление AU04</a></li>
                                    <li><a href='cabinet.php?p=cab_msg_log'>Журнал отправленных</a></li>
                                </ul>
                            </li>
                          <?php
                          if (isset($_SESSION['login']))
                            if ($_SESSION['logged'] == 'yes') {
                              if ($_SESSION['login'] == 'ADMIN' || $_SESSION['login'] == 'DEV') {
                                echo '<li class="dropdown"><a href="#"';
                                if ($_GET['p'] == 'import' || $_GET['p'] == 'import_history') echo 'class="active"';
                                echo '>Данные<i class="fa fa-angle-down"></i></a>';
                                echo '<ul role="menu" class="sub-menu">';
                                echo '<li><a href="cabinet.php?p=import">Импорт</a></li>';
                                echo '<li><a href="cabinet.php?p=import_history">Журнал</a></li>';
                                echo ' </ul></li>';
                              }
                              if ($_SESSION['login'] == 'MAIL' || $_SESSION['login'] == 'MAIL1' || $_SESSION['login'] == 'MAIL2' || $_SESSION['login'] == 'DEV') {
                                echo '<li class="dropdown"><a href="#"';
                                if ($_GET['p'] == 'mailing' || $_GET['p'] == 'addmail' || $_GET['p'] == 'mail_lists') echo 'class="active"';
                                echo '>Рассылка<i class="fa fa-angle-down"></i></a>';
                                echo '<ul role="menu" class="sub-menu">';
                                echo '<li><a href="cabinet.php?p=addmail">Добавить адрес</a></li>';
                                echo '<li><a href="cabinet.php?p=delmail">Удалить адрес</a></li>';
                                echo '<li><a href="cabinet.php?p=mail_lists">Списки адресатов</a></li>';
                                echo '<li><a href="cabinet.php?p=simple_mailing">Простая рассылка</a></li>';
                                echo '<li><a href="cabinet.php?p=daily_agro">Ежедневная агро</a></li>';
                                echo '<li><a href="cabinet.php?p=daily_metall">Ежедневная металл</a></li>';
                                echo ' </ul></li>';
                              }
                              if ($_SESSION['login'] == 'NEWS' || $_SESSION['login'] == 'DEV') {
                                echo '<li class="dropdown"><a href="#"';
                                if ($_GET['p'] == 'import' || $_GET['p'] == 'import_history') echo 'class="active"';
                                echo '>Новости<i class="fa fa-angle-down"></i></a>';
                                echo '<ul role="menu" class="sub-menu">';
                                echo '<li><a href="cabinet.php?p=add_news">Добавить</a></li>';
                                echo ' </ul></li>';
                              }
                            }
                          ?>
                            <li><a href="index.php">Сайт КЦ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<?php
echo '<div class="container">
			<div class="row">';
if (!isset($_GET['p'])) {
  alert_success('Добро пожаловать в личный кабинет!');
} else {
  switch ($_GET['p']) {
    case 'login':
      require_once 'frm_login.php';
      break;
    case 'register':
      require_once 'frm_register.php';
      break;
    case 'exit':
      session_unset();
      session_destroy();
      goto_page('index.php');
      break;
    case 'enter':
      redirect('index.php?p=login');
      break;
    case 'all_clients':
      table_all_clients();
      break;
    case 'accounts':
      table_all_accounts();
      break;
    case 'import':
      require_once 'frm_import.php';
      break;
    //--------------------C01-------------------------------------------------
    case 'C01':
      if (isset($_GET['new'])) unsetAll();
      require_once 'frm_c01.php';
      break;
    case 'AU021':
      if (isset($_GET['new'])) unsetAll();
      require_once 'frm_au021.php';
      break;
    case 'AU022':
      if (isset($_GET['new'])) unsetAll();
      require_once 'frm_au022.php';
      break;
    case 'AU031':
      if (isset($_GET['new'])) unsetAll();
      require_once 'frm_au031.php';
      break;
    case 'AU032':
      if (isset($_GET['new'])) unsetAll();
      require_once 'frm_au032.php';
      break;
    case 'AU04':
      if (isset($_GET['new'])) unsetAll();
      require_once 'frm_au04.php';
      break;
    case 'import_done':
      alert_success('Импорт завершён.');
      break;
    case 'import_history':
      table_import_history();
      break;
    case 'profile':
      require_once 'broker_profile.php';
      break;
    case 'no_confirmation':
      alert_danger('Отказ. После изменений необходимо отметить галочку подтверждения.');
      require_once 'broker_profile.php';
      break;
    case 'mailing':
      require_once 'mailing.php';
      break;
    case 'mail_lists':
      require_once 'mailing_lists.php';
      break;
    case 'not_agree_mailing':
      alert_danger('Не отмечена галочка подтверждения!');
      require_once 'mailing.php';
      break;
    case 'sent_mailing':
      alert_success('Рассылка завершена.');
      require_once 'mailing.php';
      break;
    case 'list_notchecked_mailing':
      alert_danger('Не выбран список рассылки!');
      require_once 'mailing.php';
      break;
    case 'no_subject_mailing':
      alert_danger('Не указана тема письма!');
      require_once 'mailing.php';
      break;
    case 'no_body_mailing':
      alert_danger('Не заполнено тело письма!');
      require_once 'mailing.php';
      break;
    case 'addmail':
      require_once 'addmail.php';
      break;
    case 'delmail':
      require_once 'delmail.php';
      break;
    case 'section_not_checked_addmail':
      alert_danger('Не выделена секция!');
      require_once 'addmail.php';
      break;
    case 'empty_mail':
      alert_danger('Не введён адрес!');
      require_once 'addmail.php';
      break;
    case 'empty_date':
      alert_danger('Не указана дата публикации!');
      require_once 'add_news.php';
      break;
    case 'empty_body':
      alert_danger('Пустая публикация!');
      require_once 'add_news.php';
      break;
    case 'section_not_checked_addnews':
      alert_danger('Не подтверждено!');
      require_once 'add_news.php';
      break;
    case 'mail_added':
      alert_success('Адрес добавлен.');
      require_once 'addmail.php';
      break;
    case 'news_added':
      alert_success('Новость добавлена.');
      require_once 'add_news.php';
      break;
    case 'daily_agro':
      require_once 'mailing.php';
      break;
    case 'daily_metall':
      require_once 'mailing.php';
      break;
    case 'simple_mailing':
      require_once 'mailing.php';
      break;
    case 'add_news':
      require_once 'add_news.php';
      break;
    case 'add_cert':
      require_once 'add_cert.php';
      break;
    case 'cab_msg_log':
      require_once 'msg_log.php';
      break;
  }
}
echo '</div></div>';
?>
<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">&copy; ТОО "Клиринговый центр ЕТС". Тел: 244-44-55. Адрес: Казахстан, 050051 г.
                    Алматы пр.Достык 136, БЦ "Пионер-3".
                    <!--   <a href="http://s05.flagcounter.com/more/YWI"><img src="http://s05.flagcounter.com/count2/YWI/bg_85969e/txt_FFFFFF/border_85969e/columns_2/maxflags_2/viewers_3/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>-->
                    <!-- <a href="https://www.google.com/analytics/" title="Google Analytics"><img src="img/ga.jpg" alt="Google Analytics" style="width:30px;height:30px;"></a> -->


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

<!-- Scripts -->
<script src="lib/jquery/jquery351.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery.scrollUp.min.js" type="text/javascript"></script>
<script src="js/price-range.js" type="text/javascript"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="lib/ncalayer/ncalayer-client.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/typeahead/new/typeahead.js" type="text/javascript"></script>
<script src="lib/config.js" type="text/javascript"></script>
<script src="lib/func.js" type="text/javascript"></script>

<script>
    processUrl();
</script>

</body>
</html>