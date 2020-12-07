<!--------------- CONTACTS ----------------->
<!--  <div id="contacts">  -->

<div class="col-md-6">

<!--  <div id="contacts_text">  -->
	<h4>Наши контакты:</h4>
    	<p>
    	Контакт-центр (Сall-center): 	244-44-55 для Алматы </br>
		8 800 080-05-05 по Казахстану звонок бесплатный</br>
		Телефон: 	+7 (727) 244-5780, факс: 	+7 (727) 244-5779</br>
		E-mail: 	<a href="mailto:yugay@ets.kz">yugay@ets.kz</a></br>
		Адрес: 	Казахстан, 050051, г. Алматы, проспект Достык 136,</br>
		бизнес центр "Пионер-3", 12-й этаж
    	</p>
    </br>
    Вы можете отправить нам свой отзыв, замечание или пожелание
    <form id="frm" name="frm" method="post" action="post_contacts.php">
    <div class="form-group">
		  	<label for="edtText">Текст обращения</label>
		  	<textarea class="form-control" id="edtText" name="edtText" rows="5"></textarea>
		  </div>
		  <div class="form-group">
		  	<label for="edtEmail">В случае вопроса Вы можете указать адрес для получения ответа</label>
    		<input type="email" class="form-control" id="edtEmail" name="edtEmail" placeholder="jane.doe@example.com">
		  </div>
		  <button type="submit" class="btn btn-default">Отправить</button>
		  <p></p>
		 </form>
		 <?php
		 if (isset($_GET['qanda']))
		 	{
		 	alert_success('Информация отправлена, спасибо.');
		 	}
		 ?>
<!-- </div>  -->

</div>

<div class="col-md-6">

   	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
   	<div style='overflow:hidden;height:450px;width:500px;'>
	<div id='gmap_canvas' style='height:400px;width:500px;'></div>
	<style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div>
   	<script type='text/javascript'>function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(43.235676432652205,76.9596252453664),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(43.235676432652205,76.9596252453664)});infowindow = new google.maps.InfoWindow({content:'<strong>Клиринговый центр ЕТС</strong><br>Алматы, достык 136<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

<!--  <iframe src="https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d181.67194810779563!2d76.9596252453664!3d43.235676432652205!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x38836efe41985c4b%3A0x385597084487ae6f!2z0KLQvtCy0LDRgNC90LDRjyDQsdC40YDQttCwICLQldCi0KEiLCDQkNCeLCDQv9GA0L7RgdC_0LXQutGCINCU0L7RgdGC0YvQuiAxMzYsINCQ0LvQvNCw0YLRiyAwNTAwNTEsINCa0LDQt9Cw0YXRgdGC0LDQvQ!3m2!1d43.235655!2d76.9596791!5e0!3m2!1sru!2sus!4v1463037388954" width="450" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>  -->

</div>

<!--  </div>  -->

<!--------------- CONTACTS ----------------->