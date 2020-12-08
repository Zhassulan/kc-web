<h3>Вход в личный кабинет</h3>
<div class="row">
  <div class="col-md-3">

    <form method="post" action="check_login.php">
      <div class="form-group">
        <label for="frm_login">Логин</label>
        <?php
        if (isset($_SESSION['login']))
          echo '<input type="text" class="form-control" name="frm_login" id="frm_login" value="' . $_SESSION['login'] . '">';
        else
          echo '<input type="text" class="form-control" name="frm_login" id="frm_login" placeholder="...">';
        ?>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input type="password" class="form-control" name="frm_pwd" id="frm_pwd" placeholder="..."
               autocomplete=new-password>
      </div>

      <div class="g-recaptcha" data-sitekey="6LeIgx4TAAAAAOGvsHO-urfjslPd64vQYDRMCm0p"></div>

      <button type="submit" class="btn btn-success">Войти</button>
      <div class="form-group">
      </div>

    </form>
  </div>
</div>
</br>

