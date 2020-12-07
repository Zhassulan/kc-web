<?php
if (isset($_GET['resp']) && $_GET['resp'] == 'noclient') {
  alert_danger('Выберите клиента!');
}
?>
<form id="frm" name="frm" method="post" action="post_au04.php" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Форма AU04</h3>
        </div>
        <div class="panel-body">
            <p class="text-right">В ТОО "Клиринговый центр ЕТС"</p>
            <p class="text-center"><b>ЗАЯВЛЕНИЕ НА ЗАКРЫТИЕ КОДОВ ТОРГОВЫХ СЧЕТОВ И РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ</b>
            </p>
            <input type="hidden" id="edt_form" name="edt_form"
                   value="Форма AU04. ЗАЯВЛЕНИЕ НА ЗАКРЫТИЕ КОДОВ ТОРГОВЫХ СЧЕТОВ И РАЗДЕЛОВ КЛИРИНГОВЫХ РЕГИСТРОВ"/>
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
          echo '<script>var clients = [';
          if ($res = $conn->query('select c.id, c.full_name from customers c
  				join users u on u.login = \'' . $_SESSION['login'] . '\'
  				join brokers b on b.part_code = u.broker_code
				WHERE c.id_broker = b.id order by c.full_name;'))
            while ($row = $res->fetch_row()) {
              echo '\'' . $row[1] . ' (ID=' . $row[0] . ')\',' . PHP_EOL;
            }
          mysqli_close($conn);
          echo ']; </script>';
          ?>
            Выберите клиента:
            <div class="row">
                <div class="col-md-6">
                    <div id="the-basics-clients">
                        <input class="typeahead" style="width:480px" type="text" placeholder="Набирайте текст..."
                               id="edt_client" name="edt_client">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-default" id="PostLoadClientData" name="PostLoadClientData">
                        Добавить в таблицу
                    </button>
                </div>
            </div>

            </br>
            Прошу закрыть следующие Коды торговых счетов и разделов клиринговых регистров:
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="success">
                        <th>Код торгового счета</th>
                        <th>БИН/ИИН</th>
                        <th>Наименование</th>
                        <th><small>Код раздела регистра </br>учета гарантийного </br>обеспечения</small></th>
                        <th><small>Код раздела регистра </br>учета денег для </br>оплаты Товара</small></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    echo '<input type="hidden" id="edtRows" name="edtRows" value="' . $_SESSION['AU04_rows'] . '">';
                    for ($i = 1; $i <= intval($_SESSION['AU04_rows']); $i++) {
                      $id = null;
                      $j = 0;
                      if (isset($_SESSION['ArrClientsIds'])) {
                        foreach ($_SESSION['ArrClientsIds'] as $cid) {
                          if ($j == $i - 1)
                            $id = $cid;
                          $j++;
                        }
                      }
                      echo '
						<tr>
							<td class="col-md-1">
								<input type="text" class="form-control" id="edt_legal_code' . $i . '" name="edt_legal_code' . $i . '"" value="' . db_get_customer_by_id($id, 'legal_code') . '">
							</td>
							<td class="col-md-2">
								<input type="text" class="form-control" id="edt_BIN' . $i . '" name="edt_BIN' . $i . '" value="' . db_get_customer_by_id($id, 'BIN') . '">
							</td>
							<td class="col-md-3">
								<input type="text" class="form-control" id="edt_full_name' . $i . '" name="edt_full_name' . $i . '" value="' . html_quot(db_get_customer_by_id($id, 'full_name')) . '">
							</td>
							<td class="col-md-1">
								<input type="text" class="form-control" id="edt_acc_code_g' . $i . '" name="edt_acc_code_g' . $i . '" value="' . db_get_customer_account_by_id($id, 1) . '">
							</td>
							<td class="col-md-1">
								<input type="text" class="form-control" id="edt_acc_code_p' . $i . '" name="edt_acc_code_p' . $i . '" value="' . db_get_customer_account_by_id($id, 3) . '">
							</td>
						</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <button type="submit" class="btn btn-default" id="DelRow" name="DelRow">Удалить строку
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    Дополнительная информация:
                    <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
                </div>
            </div>

            <div class="row">
                <p class="text-right">
                    <button type="button" class="btn btn-info" onclick="SignAndVerify('AU04');">
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
            <button type="button" class="btn btn-success" onclick="submitForm()">
                Отправить
            </button>
        </div>
        <div class="col-md-2">
            <a class="btn btn-default" href="cabinet.php" role="button">Отмена</a>
        </div>
    </div>
</form>
<p></p>