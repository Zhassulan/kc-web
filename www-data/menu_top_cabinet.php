<div id='cssmenu'>
	<ul>
	   <li <?php if (!isset($_GET['p'])) echo 'class="active"';?>><a href='cabinet.php'>Главная</a></li>
	   <li <?php if ($_GET['p'] == 'private') echo 'class="active has-sub"';?>><a href='index.php?p=private'>Личные данные</a>
	    <ul>
	         <li><a href='#'>Изменить</a></li>
	      </ul>
	   </li>
	   <li <?php if ($_GET['p'] == 'accounts') echo 'class="active has-sub"';?>><a href='#'>Счета</a>
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
	   <li><a href='#'>Клиенты</a></li>
	   <li><a href='#'>Документы</a></li>
	   <li><a href='#'>Новости</a></li>	   
	   <li <?php if ($_GET['p'] == 'login') echo 'class="active"';?>><a href='cabinet.php?p=logout'>Выход</a></li>
	</ul>
	</div>