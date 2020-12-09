<form id="frm" name="frm" method="post" action="post_au032.php" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Заявка AU03 Форма 2</h3>
    </div>
    <div class="panel-body">
      <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
      <p class="text-center"><b>ЗАЯВЛЕНИЕ для спецаукциона ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ
          РЕГИСТРОВ</br> ПО УЧЕТУ БИРЖЕВОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА в разрезе лотов</b>
      </p>
      <input type="hidden" id="edt_form" name="edt_form"
             value="Заявка AU03 Форма 2. ЗАЯВЛЕНИЕ для спецаукциона ОБ ИЗМЕНЕНИИ УЧЕТА ДЕНЕГ НА РАЗДЕЛАХ КЛИРИНГОВЫХ РЕГИСТРОВ ПО УЧЕТУ БИРЖЕВОГО ОБЕСПЕЧЕНИЯ И ПО УЧЕТУ ДЕНЕГ ДЛЯ ОПЛАТЫ ТОВАРА в разрезе лотов"/>
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

      </br>
      Прошу изменить учет обязательств по перечислению денежных средств на разделах клирингового регистра:
      <div class="table-responsive">
        <table class="table table-bordered" id="myTable" name="myTable">
          <thead>
          <tr class="success">
            <th>№</th>
            <th>Снять с учета на разделе</th>
            <th>Поставить на учет на разделе</th>
            <th>Код лота</th>
            <th>Сумма, тенге</th>
          </tr>
          </thead>
          <tbody>
          <?php
          if (!isset($_SESSION['AU032_ROWS'])) {
            $_SESSION['AU032_ROWS'] = 1;
            $arr = array();
            array_push($arr, new \lib\AU032RowsData("", "", "0G", 0));
            $_SESSION['AU032_ARR'] = $arr;
          } else
            $arr = $_SESSION['AU032_ARR'];
          echo '<p>Rows count = '.count($arr).'</p>';
          echo print_r($arr);
          echo '<input type="hidden" id="edtRows" name= "edtRows" value="' . $_SESSION['AU03_rows'] . '"/>';
          $i = 0;
          foreach ($arr as $r => $item) {
            $i += 1;
            echo '<tr>
						<td>
						' . $i . '
						</td>
						<td>
							<div id="the-basics-minus-legal">
								<input class="typeahead" type="text" placeholder="Набирайте текст..." id="edtMinusForLegal' . $i . '" name="edtMinusForLegal' . $i . '" value="' . $item->minus . '">
							</div>
						</td>
						<td>
							<div id="the-basics-add-legal">
								<input class="typeahead" type="text" placeholder="Набирайте текст..." id="edtAddForLegal' . $i . '" name="edtAddForLegal' . $i . '" value="' . $item->plus . '">
							</div>
						</td>
						<td>
							<input type="text" class="form-control" id="edtLotNumber' . $i . '" name="edtLotNumber' . $i . '" value="' . $item->lot . '">
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
              <!-- <a class="nav-link active" href="https://kc-ets.kz/cabinet.php?p=AU03_add_row">Добавить строку</a>  -->
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <ul class="nav">
            <li class="nav-item">
              <button type="submit" class="btn btn-default" id="DelRow" name="DelRow">Удалить строку
              </button>
              <!-- <a class="nav-link active" href="https://kc-ets.kz/cabinet.php?p=AU03_del_row">Удалить строку</a>  -->
            </li>
          </ul>
        </div>
      </div>

      </br>
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
          <button type="button" class="btn btn-info" data-toggle="modal" onclick="SignAndVerify('AU032');">
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

    </div>

  </div>

  <div class="row">
    <div class="col-md-2">
      <button type="button" class="btn btn-success" id="SendAU032" name="SendAU032" onclick="submitForm()">
        Отправить
      </button>
    </div>
    <div class="col-md-2">
      <a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
    </div>
  </div>
</form>