<div id='cssmenu'>
	<ul>
	   <li <?php if (!isset($_GET['p'])) echo 'class="active"';?>><a href='index.php'>Главная</a></li>
	   <li <?php if ($_GET['p'] == 'about') echo 'class="active has-sub"';?>><a href='#'>О нас</a>
	    <ul>
	         <li><a href='index.php?p=about'>О Клиринговом центре ЕТС</a></li>
	         <li><a href='index.php?p=head'>Руководство Клирингового центра ЕТС</a></li>
	         <li><a href='index.php?p=role'>Основные функции и услуги Клирингового центра ЕТС</a></li>
	         <li><a href='index.php?p=docs'>Нормативные документы</a></li>
	         <li><a href='index.php?p=bank'>Банковские реквизиты</a></li>
	      </ul>
	   </li>
	   <li <?php if ($_GET['p'] == 'tarifs') echo 'class="active has-sub"';?>><a href='#'>Тарифы</a>
	      <ul>
	         <li class='has-sub'><a href='#'>Product 1</a>
	            <ul>
	               <li><a href='#'>Sub Product</a></li>
	               <li><a href='#'>Sub Product</a></li>
	            </ul>
	         </li>
	         <li class='has-sub'><a href='#'>Product 2</a>
	            <ul>
	               <li><a href='#'>Sub Product</a></li>
	               <li><a href='#'>Sub Product</a></li>
	            </ul>
	         </li>
	      </ul>
	   </li>
	   <li><a href='#'>Компании</a></li>
	   <li><a href='#'>Документы</a></li>
	   <li><a href='#'>Новости</a></li>	   
	   <li <?php if ($_GET['p'] == 'contacts') echo 'class="active has-sub"';?>><a href='index.php?p=contacts'>Контакты</a></li>
	   <li><a href='#'>Отзывы</a></li>
	   <li <?php if ($_GET['p'] == 'login') echo 'class="active"';?>><a href='index.php?p=login'>Личный кабинет</a></li>
	</ul>
	</div>