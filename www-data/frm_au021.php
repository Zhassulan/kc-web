<form id="frm" name="frm" method="post" action="post_au021.php" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Заявка AU02 Форма 1</h3>
        </div>
        <div class="panel-body">
            <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
            <p class="text-center"><b>ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ</b>
                </br><b>(стандартный аукцион)</b></p>
            <input type="hidden" id="edt_form" name="edt_form"
                   value="Заявка AU02 Форма 1. ЗАЯВЛЕНИЕ НА ВОЗВРАТ ДЕНЕЖНЫХ СРЕДСТВ"/>
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
          echo '<script>' . PHP_EOL;

          echo 'var accounts = [';
          if ($res = $conn->query('
                select ca.acc_code from customers c
                  join users u on u.login = \'' . $_SESSION['login'] . '\'
                  join brokers b on b.part_code = u.broker_code
                  join customer_accounts ca on ca.id_customer = c.id
                WHERE c.id_broker = b.id order by ca.acc_code;'))
            while ($row = $res->fetch_row())
              echo '\'' . $row[0] . '\',' . PHP_EOL;
          echo '];' . PHP_EOL;


          echo 'var clients = [';
          if ($res = $conn->query('select c.id, c.full_name from customers c
  				join users u on u.login = \'' . $_SESSION['login'] . '\'
  				join brokers b on b.part_code = u.broker_code
				WHERE c.id_broker = b.id order by c.full_name;'))
            while ($row = $res->fetch_row())
              echo '\'' . $row[1] . ' (ID=' . $row[0] . ')\',' . PHP_EOL;
          mysqli_close($conn);
          echo '];' . PHP_EOL;
          echo '</script>';
          ?>
            Прошу возвратить денежные средства Участника клиринга:
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="success">
                        <th>Клиент участника клиринга</th>
                        <th>БИН/ИИН</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="col-md-9">
                                <div id="the-basics-clients">
                                  <?php
                                  if (isset($_SESSION['client_id'])) {
                                    echo html_quot(db_get_customer_by_id(intval($_SESSION['client_id']), 'full_name'));
                                    echo '<input type="hidden" id="edtClient" name="edtClient" value="' . html_quot(db_get_customer_by_id(intval($_SESSION['client_id']), 'full_name')) . '"/>';
                                  } else {
                                    echo '<input class="typeahead"  style="width: 500px;" type="text" placeholder="Набирайте текст..." id="edtClient" name="edtClient"/>';
                                  }
                                  ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                              <?php
                              if (!isset($_SESSION['client_id'])) {
                                echo '<button type="submit" class="btn btn-default" id="LoadData" name="LoadData">Загрузить данные</button>';
                              }
                              ?>

                            </div>
                            <div class="col-md-2">
                                <?php
                                if (isset($_SESSION['client_id']))
                                  echo '<button type="submit" class="btn btn-default" id="clearClient" name="clearClient">Очистить</button>';
                                ?>
                            </div>
                        </td>
                        <td class="col-md-3">
                          <?php
                          if (isset($_SESSION['client_id'])) {
                            echo '<input type="hidden" id="edtClientBin" name="edtClientBin" value="' . db_get_customer_by_id(intval($_SESSION['client_id']), 'BIN') . '">';
                            echo db_get_customer_by_id(intval($_SESSION['client_id']), 'BIN');
                          }
                          ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="myTable" name="myTable">
                    <thead>
                    <tr class="success">
                        <th>№</th>
                        <th>Код раздела</th>
                        <th>Код лота</th>
                        <th>Сумма, тенге</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!isset($_SESSION['AU021_ROWS'])) {
                      $_SESSION['AU021_ROWS'] = 1;
                      $arr = array();
                      array_push($arr, new \lib\AU021RowsData("", "0G", 0));
                      $_SESSION['AU021_ARR'] = $arr;
                    } else
                      $arr = sessGetVal('AU021_ARR');
                    echo '<input type="hidden" id="edtRows" name= "edtRows" value="' . $_SESSION['AU021_ROWS'] . '"/>';
                    $i = 0;
                    foreach ($arr as $r => $item) {
                      $i += 1;
                      echo '<tr>
						<td>
						' . $i . '
						
						</td>
						<td>
							<div id="the-basics-accounts">
								<input class="typeahead" type="text" placeholder="Набирайте текст..." id="edtAccCode' . $i . '" name="edtAccCode' . $i . '"
									value="'. $item->account .'"/>
							</div>
						</td>
						<td>
							<input type="text" class="form-control" id="edtLotCode' . $i . '" name="edtLotCode' . $i . '" value="' . $item->lot . '">
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
                        <td>
                        </td>
                        <td class="text-right">
                            <button type="button" onclick="funcSum()">Суммировать</button>
                            <b>Итого:</b>
                            <script>
                                function funcSum() {
                                    var tot = 0;
                                    var val = 0;
                                    var max = parseInt(document.getElementById('edtRows').value);
                                    for (var i = 1; i <= max; i++) {
                                        var name = 'edtAmount' + String(i);
                                        //alert(name);
                                        val = parseFloat(document.getElementById(name).value);
                                        tot += val;
                                    }
                                    document.getElementById('edtSum').value = tot.toFixed(2);
                                }
                            </script>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="edtSum" name="edtSum">
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
                            <input type="text" class="form-control" id="edtRecipient" name="edtRecipient">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">БИН/ИИН</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtBIN" name="edtBIN">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">Номер счета</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtAccount" name="edtAccount">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">Наименование банка получателя</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtBank" name="edtBank">
                        </td>
                    </tr>
                    <tr>
                        <td class="success">БИК</td>
                        <td class="col-md-9">
                            <input type="text" class="form-control" id="edtBIK" name="edtBIK">
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-5">
                    Дополнительная информация:
                    <div class="form-group">
                        <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <p class="text-right">
                    <button type="button" class="btn btn-info" data-toggle="modal" onclick="SignAndVerify('AU021');">
                        Подписать
                    </button>
                </p>
            </div>

            <div class="row">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    <p class="text-right">
                        <!-- <p class="text-right">Дата подписи: <?php echo date("d.m.Y"); ?></p>  -->
                        <input class="form-control" id="signed" name="signed" type="text" value="Не подписано"
                               disabled/>
                        <input type="hidden" id="signature" name="signature" value=""/>
                        <input type="hidden" id="cms_plain_data" name="cms_plain_data" value=""/>
                    </p>
                </div>
            </div>

            <b>*</b>&nbsp&nbsp<small>Счет с указанными реквизитами должен быть зарегистрирован в Клиринговом центре. Для
                этого необходимо предоставить в Клиринговый центр Заявление на регистрацию счетов для возврата денежных
                средств по форме AU01.</small>

        </div>

    </div>

    <div class="row">
        <div class="col-md-2">
            <button type="button" class="btn btn-success" id="SendAU021" name="SendAU021" onclick="submitForm()">
                Отправить
            </button>
        </div>
        <div class="col-md-2">
            <a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
        </div>
    </div>

</form>
</br>

<script>
    processUrl('AU021');
</script>