<form id="frm" name="frm" method="post" action="post_au022.php" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Заявка AU02 Форма 2</h3>
        </div>
        <div class="panel-body">
            <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
            <p class="text-center"><b>ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ</b>
                </br><b>(двойной встречный аукцион, режим классической биржевой торговли)</b></p>
            <input type="hidden" id="edt_form" name="edt_form"
                   value="Заявка AU02 Форма 2. ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ"/>
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

          <?php
          $conn = iconnect();
          echo '<script>var accounts = [';
          if ($res = $conn->query('
                select ca.acc_code from customers c
                  join users u on u.login = \'' . $_SESSION['login'] . '\'
                  join brokers b on b.part_code = u.broker_code
                  join customer_accounts ca on ca.id_customer = c.id
                WHERE c.id_broker = b.id order by ca.acc_code;'))
            while ($row = $res->fetch_row()) {
              echo '\'' . $row[0] . '\',' . PHP_EOL;
            }
          mysqli_close($conn);
          echo ']; </script>';
          ?>

            Прошу возвратить денежные средства, обязательства по перечислению которых учитываются на разделах
            клирингового регистра:
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" name="myTable">
                    <thead>
                    <tr class="success">
                        <th>№</th>
                        <th>Код раздела</th>
                        <!-- <th>Код лота</th>  -->
                        <th>Сумма, тенге</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($_SESSION['AU022_ROWS'])) {
                      $_SESSION['AU022_ROWS'] = 1;
                      $arr = array();
                      array_push($arr, new \lib\AU022RowsData("", 0));
                      sessSetVal('AU022_ARR', $arr);
                    } else
                      $arr = sessGetVal('AU022_ARR');
                    echo '<input type="hidden" id="edtRows" name= "edtRows" value="' . $_SESSION['AU022_ROWS'] . '"/>';
                    $i = 0;
                    foreach ($arr as $r => $item) {
                      $i += 1;
                      echo '<tr>
						<td>' . $i . '</td>
						<td>
							<div id="the-basics-accounts">
								<input class="typeahead" type="text" placeholder="Набирайте текст..." id="edtAccCode' . $i . '" name="edtAccCode' . $i . '"
								value="' . $item->account . '">
							</div>
						</td>
						<td>
							<input type="text" class="form-control" id="edtAmount' . $i . '" name="edtAmount' . $i . '" value="' . $item->amount . '">
						</td>
					 </tr>';
                    }
                    ?>
                    <tr>
                        <td>
                        </td>
                        <td class="text-right">
                            <button type="button" onclick="funcSum()">Суммировать</button>
                            <b>Итого:</b>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="edtSum" name="edtSum" value="<?php if (isset($_SESSION['edtSum'])) echo $_SESSION['edtSum'];  ?>">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <button type="submit" class="btn btn-default" id="AddRow" name="AddRow">Добавить строку
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <button type="submit" class="btn btn-default" id="DelRow" name="DelRow">Удалить строку
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            </br>
            по следующим реквизитам (<b>*</b>):
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" name="myTable">
                    <thead>
                    <tr>
                        <td class="success">Наименование получателя</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtRecipient" name="edtRecipient"
                                   value="<?php
                                   if (isset($_SESSION['edtRecipient'])) echo $_SESSION['edtRecipient'];
                                   ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">БИН/ИИН</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtBIN" name="edtBIN"
                                   value="<?php
                                   if (isset($_SESSION['edtBIN'])) echo $_SESSION['edtBIN'];
                                   ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">Номер счета</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtAccount" name="edtAccount"
                                   value="<?php
                                   if (isset($_SESSION['edtAccount'])) echo $_SESSION['edtAccount'];
                                   ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">Наименование банка получателя</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtBank" name="edtBank"
                                   value="<?php
                                   if (isset($_SESSION['edtBank'])) echo $_SESSION['edtBank'];
                                   ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">БИК</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtBIK" name="edtBIK"
                                   value="<?php
                                   if (isset($_SESSION['edtBIK'])) echo $_SESSION['edtBIK'];
                                   ?>">
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

          <?php showComment(); ?>

          <?php
          showSignBtn('AU022');
          showSignedFld();
          ?>

            <b>*</b>&nbsp&nbsp<small>Счет с указанными реквизитами должен быть зарегистрирован в Клиринговом центре. Для
                этого необходимо предоставить в Клиринговый центр Заявление на регистрацию счетов для возврата денежных
                средств по форме AU01.</small>

        </div>

    </div>

    <div class="row">
        <div class="col-md-2">
            <button type="button" class="btn btn-success" id="SendAU022" name="SendAU022" onclick="submitForm()">
                Отправить
            </button>
        </div>
        <div class="col-md-2">
            <a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
        </div>
    </div>

</form>
</br>

<?php
writeModal();
?>

