<?php
require_once 'lib/func.inc';
?>
<h4>Списки получателей:</h4>
<div class="row">
  <div class="col-md-4">
  Специализированные товары 
	<table align="center" class="table table-bordered" style="width:100%"> 
	  <tbody> 
	    <tr style="background-color:#efefef;"> 
	      <th><strong>№</strong></th> 
	      <th><strong>E-Mail</strong></th> 
	    </tr> 
		<?php db_get_mail_list(1); ?>
	  </tbody> 
	</table>	  
  </div>
  <div class="col-md-4">
  Сельхозпродукция 
<table align="center" class="table table-bordered" style="width:100%"> 
  <tbody> 
    <tr style="background-color:#efefef;"> 
      <th><strong>№</strong></th> 
      <th><strong>E-Mail</strong></th> 
    </tr> 
	<?php db_get_mail_list(2); ?>
  </tbody> 
</table>	  
  </div>
  <div class="col-md-4">
  Метал и промтовары 
<table align="center" class="table table-bordered" style="width:100%"> 
  <tbody> 
    <tr style="background-color:#efefef;"> 
      <th><strong>№</strong></th> 
      <th><strong>E-Mail</strong></th> 
    </tr> 
	<?php db_get_mail_list(3); ?>
  </tbody> 
</table>	
</div>
 
  <div class="col-md-4">
	<table align="center" class="table table-bordered" style="width:100%"> 
	Сельхозпродукция (платная)
	  <tbody> 
	    <tr style="background-color:#efefef;"> 
	      <th><strong>№</strong></th> 
	      <th><strong>E-Mail</strong></th> 
	    </tr> 
		<?php db_get_mail_list(4); ?>
	  </tbody> 
	</table>	  
  </div>
  <div class="col-md-4">
	<table align="center" class="table table-bordered" style="width:100%"> 
	ЭТП
	  <tbody> 
	    <tr style="background-color:#efefef;"> 
	      <th><strong>№</strong></th> 
	      <th><strong>E-Mail</strong></th> 
	    </tr> 
		<?php db_get_mail_list(6); ?>
	  </tbody> 
	</table>	  
  </div>
  <div class="col-md-4">
	Тестовая
	<table align="center" class="table table-bordered" style="width:100%"> 
	  <tbody> 
	    <tr style="background-color:#efefef;"> 
	      <th><strong>№</strong></th> 
	      <th><strong>E-Mail</strong></th> 
	    </tr> 
		<?php db_get_mail_list(5); ?>
	  </tbody> 
	</table>  
  </div>
   
  </div>