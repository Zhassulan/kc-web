<form class="form-horizontal" id="frm" name="frm" method="post" action="post_profile.php">
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">Профиль</h3>
  </div>
  <div class="panel-body">
  
 <div class="form-group">
    <label for="edtFirm" class="col-sm-2 control-label">Код в торговой системе</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtFirm" name="edtFirm" placeholder="Код" value="<?php echo $_SESSION['login']; ?>"  disabled>
    </div>
 </div>
 <div class="form-group">
    <label for="edtName" class="col-sm-2 control-label">Название</label>
    <div class="col-sm-8">
		<input type="text" class="form-control" id="edtName" name="edtName" placeholder="Название" value="<?php echo db_get_profile_field($_SESSION['login'], 'name'); ?>">
    </div>
 </div>
 <div class="form-group">
    <label for="edtName" class="col-sm-2 control-label">Название (англ.)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="edtNameEng" name="edtNameEng" placeholder="Title" value="<?php echo db_get_profile_field($_SESSION['login'], 'name_e'); ?>">
    </div>
 </div>
 <div class="form-group">
    <label for="edtBIN" class="col-sm-2 control-label">БИН</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtBIN" name="edtBIN" placeholder="БИН" value="<?php echo db_get_profile_field($_SESSION['login'], 'rnn'); ?>">
    </div>
 </div>
 <div class="form-group">
    <label for="edtAddress" class="col-sm-2 control-label">Адрес</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="edtAddress" name="edtAddress" placeholder="Адрес" value="<?php echo db_get_profile_field($_SESSION['login'], 'address'); ?>">
    </div>
 </div>
<div class="form-group">
    <label for="edtAddressEng" class="col-sm-2 control-label">Адрес (англ.)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="edtAddressEng" name="edtAddressEng" placeholder="Address" value="<?php echo db_get_profile_field($_SESSION['login'], 'address_e'); ?>">
    </div>
 </div>
<div class="form-group">
    <label for="edtPostAddress" class="col-sm-2 control-label">Почтовый адрес</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="edtPostAddress" name="edtPostAddress" placeholder="Почтовый адрес" value="<?php echo db_get_profile_field($_SESSION['login'], 'post_address'); ?>">
    </div>
 </div>
<div class="form-group">
    <label for="edtPostAddressEng" class="col-sm-2 control-label">Почтовый адрес (англ.)</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="edtPostAddressEng" name="edtPostAddressEnd" placeholder="Post address" value="<?php echo db_get_profile_field($_SESSION['login'], 'post_address_e'); ?>">
    </div>
 </div>
<div class="form-group">
    <label for="edtPhone" class="col-sm-2 control-label">Телефон</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtPhone" name="edtPhone" placeholder="Телефон" value="<?php echo db_get_profile_field($_SESSION['login'], 'phone'); ?>">
    </div>
</div>
<div class="form-group">
    <label for="edtMobile" class="col-sm-2 control-label">Моб. телефон</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtMobile" name="edtMobile" placeholder="Моб. телефон" value="<?php echo db_get_profile_field($_SESSION['login'], 'phone2'); ?>">
    </div>
 </div>
<div class="form-group">
    <label for="edtFax" class="col-sm-2 control-label">Факс</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtFax" name="edtFax" placeholder="Факс" value="<?php echo db_get_profile_field($_SESSION['login'], 'fax'); ?>">
    </div>
 </div>
<div class="form-group">
    <label for="edtEmail" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtEmail" name="edtEmail" placeholder="E-Mail" value="<?php echo db_get_profile_field($_SESSION['login'], 'email'); ?>">
      </div>
 </div>
 <div class="form-group">
    <label for="edtSite" class="col-sm-2 control-label">Веб сайт</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="edtSite" name="edtSite" placeholder="Веб сайт" value="<?php echo db_get_profile_field($_SESSION['login'], 'www_address'); ?>">
    </div>
 </div>
 
 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="chkbox" name="chkbox">Подтверждаю изменения
        </label>
      </div>
    </div>
 </div>
   
  </div>
</div>

<button type="submit" class="btn btn-default">Отправить</button> &nbsp&nbsp
<a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
</form>
<p></p>