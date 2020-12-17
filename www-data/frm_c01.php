<form id="frm" name="frm" method="post" action="post_c01.php" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Форма С01</h3>
        </div>
        <div class="panel-body">
            <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
            <p class="text-center"><b>ЗАЯВЛЕНИЕ НА РЕГИСТРАЦИЮ КОДОВ ТОРГОВЫХ СЧЕТОВ И ОТКРЫТИЕ РАЗДЕЛОВ КЛИРИНГОВЫХ
                    РЕГИСТРОВ</b></p>
            <input type="hidden" id="edt_form" name="edt_form"
                   value="Форма C01. ЗАЯВЛЕНИЕ НА РЕГИСТРАЦИЮ КОДОВ ТОРГОВЫХ СЧЕТОВ И ОТКРЫТИЕ РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ"/>
            <input type="hidden" id="edt_date" name="edt_date" value="<?php $objDateTime = new DateTime('NOW');
            echo $objDateTime->format(DateTime::RFC1123); ?>"/>
            <input type="hidden" id="edt_login" name="edt_login" value="<?php echo $_SESSION['login']; ?>"/>
            <input type="hidden" id="edt_broker_name" name="edt_broker_name"
                   value="<?php echo html_quot(db_get_broker_name_by_login($_SESSION['login'])); ?>"/>
            <input type="hidden" id="edt_broker_code" name="edt_broker_code"
                   value="<?php echo db_get_broker_code_by_login($_SESSION['login']); ?>"/>

            От:
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="success">
                        <th>Наименование:</th>
                        <th>Код участника клиринга:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                          <?php echo db_get_broker_name_by_login($_SESSION['login']); ?>
                        </td>
                        <td>
                          <?php echo db_get_broker_code_by_login($_SESSION['login']); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            Прошу зарегистрировать следующие Коды торговых счетов:
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="success">
                        <th><small>Код торгового </br>счета</small></th>
                        <th>БИН/ИИН</th>
                        <th>Наименование</th>
                        <th><small>E-mail для биржевой рассылки</small></th>
                        <th><small>Код раздела регистра </br>учёта гарантийного обеспечения</small></th>
                        <th><small>Код раздела регистра </br>учёта денег для оплаты Товара</small></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-2">
                          <?php
                          if (isset($_SESSION['legal_code']))
                            echo '<input type="text" class="form-control" id="edt_legal_code" name="edt_legal_code" value="' . $_SESSION['legal_code'] . '">';
                          else {
                            $code = null;
                            do {
                              $code = generateUUID(7);
                            } while (db_chk_customer_legal_exists($code));
                            echo '<input type="text" class="form-control" id="edt_legal_code" name="edt_legal_code" placeholder="..." value="' . $code . '">';
                          }
                          ?>
                        </td>
                        <td class="col-md-2">
                          <?php
                          if (isset($_SESSION['bin']))
                            echo '<input type="text" class="form-control" id="edt_BIN" name="edt_BIN" value="' . $_SESSION['bin'] . '">';
                          else
                            echo '<input type="text" class="form-control" id="edt_BIN" name="edt_BIN" placeholder="...">';
                          ?>
                        </td>
                        <td>
                          <?php
                          if (isset($_SESSION['full_name']))
                            echo '<input type="text" class="form-control" id="edt_full_name" name="edt_full_name" value="' . $_SESSION['full_name'] . '">';
                          else
                            echo '<input type="text" class="form-control" id="edt_full_name" name="edt_full_name"  placeholder="...">';
                          ?>
                        </td>
                        <td class="col-md-1">
                          <?php
                          if (isset($_SESSION['email']))
                            echo '<input type="text" class="form-control" id="edt_email" name="edt_email" value="' . $_SESSION['email'] . '">';
                          else
                            echo '<input type="text" class="form-control" id="edt_email" name="edt_email" placeholder="...">';
                          ?>
                        </td>
                        <td class="col-md-2">
                          <?php
                          if (isset($_SESSION['acc_code_g']))
                            echo '<input type="text" class="form-control" id="edt_acc_code_g" name="edt_acc_code_g" value="' . $_SESSION['acc_code_g'] . '">';
                          else
                            echo '<input type="text" class="form-control" id="edt_acc_code_g" name="edt_acc_code_g" placeholder="...">';
                          ?>
                        </td>
                        <td class="col-md-2">
                          <?php
                          if (isset($_SESSION['acc_code_p']))
                            echo '<input type="text" class="form-control" id="edt_acc_code_p" name="edt_acc_code_p" value="' . $_SESSION['acc_code_p'] . '">';
                          else
                            echo '<input type="text" class="form-control" id="edt_acc_code_p" name="edt_acc_code_p" placeholder="...">';
                          ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <input type="hidden" id="edt_acc_code_s" name="edt_acc_code_s" value="">

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="NotResident" name="NotResident" value="NotResident">Нерезидент
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    Дополнительная информация:
                    <div class="form-group">
                        <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="Restore" name="Restore" value="Restore">Восстановление
                    </label>
                </div>
            </div>

          <?php
          showSignBtn();
          showSignedFld();
          ?>

        </div>

    </div>

    <div class="row">
        <div class="col-md-2">
            <button type="button" class="btn btn-success" id="SendC01" name="SendC01" onclick="submitForm()">Отправить
            </button>
        </div>
        <div class="col-md-2">
            <a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
        </div>
    </div>

</form>

<?php
writeModal();
?>

<script>
    processUrl('C01');
</script>