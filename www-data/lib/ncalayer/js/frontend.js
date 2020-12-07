function chooseStoragePath() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    if (storageAlias !== "NONE") {
        browseKeyStore(storageAlias, "P12", storagePath, "chooseStoragePathBack");
    }
}

function chooseStoragePathBack(rw) {
    var storagePath = $("#storagePath").val();

    if (rw.getErrorCode() === "NONE") {
        storagePath = rw.getResult();
        if (storagePath !== null && storagePath !== "") {
            $("#storagePath").val(storagePath);
        } else {
            $("#storageAlias").val("NONE");
            $("#storagePath").val("");
        }
    } else {
        $("#storageAlias").val("NONE");
        $("#storagePath").val("");
    }
}

function fillKeysBack(result) {
    if (result['errorCode'] === "NONE") {
        var keyListEl = document.getElementById('keys');
        keyListEl.options.length = 0;
        var list = result['result'];
        var slotListArr = list.split("\n");
        for (var i = 0; i < slotListArr.length; i++) {
            if (slotListArr[i] === null || slotListArr[i] === "") {
                continue;
            }
            keyListEl.options[keyListEl.length] = new Option(slotListArr[i], i);
        }
        keysOptionChanged();
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            alert(result['errorCode']);
        }
        var keyListEl = document.getElementById('keys');
        keyListEl.options.length = 0;
    }

    //Sign();
}

function fillKeys() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();

    //моё изменение
    //var keyType = "";
    var keyType = "SIGN";

    //var selected = $("input[type='radio'][name='keyType']:checked");
    //if (selected.length > 0) {
    //    keyType = selected.val();
    //alert(keyType);
    //}

    //моё изменение
    //keyType = "SIGN"

    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            getKeys(storageAlias, storagePath, password, keyType, "fillKeysBack");
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function keysOptionChanged() {
    var str = $("#keys :selected").text();
    var alias = str.split("|")[3];
    $("#keyAlias").val(alias);
}

function setLocaleCall() {
    var lang = $("#lang").val();
    setLocale(lang);
}

function getNotBeforeCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                getNotBefore(storageAlias, storagePath, alias, password, "getNotBeforeBack");
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function getNotBeforeBack(result) {
    if (result['errorCode'] === "NONE") {
        $("#notbefore").val(result['result']);
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            alert(result['errorCode']);
        }
    }
}

function getNotAfterCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                getNotAfter(storageAlias, storagePath, alias, password, "getNotAfterBack");
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function getNotAfterBack(result) {
    if (result['errorCode'] === "NONE") {
        $("#notafter").val(result['result']);
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            alert(result['errorCode']);
        }
    }
}

function getSubjectDNCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                getSubjectDN(storageAlias, storagePath, alias, password, "getSubjectDNBack");

            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function getSubjectDNBack(result) {
    if (result['errorCode'] === "NONE") {
        $("#subjectDn").text(result['result']);

    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            alert(result['errorCode']);
        }
    }
}

function getIssuerDNCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                getIssuerDN(storageAlias, storagePath, alias, password, "getIssuerDNBack");
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function getIssuerDNBack(result) {
    if (result['errorCode'] === "NONE") {
        $("#issuerDn").text(result['result']);
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            alert(result['errorCode']);
        }
    }
}

function signPlainDataCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    //$("#identifier").text("Не проверено");
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                //мои изменения
                //var data = $("#date").val();
                //var data = document.getElementById("comment").value;
                //alert(data);
                if (data !== null && data !== "") {
                    signPlainData(storageAlias, storagePath, alias, password, data, "signPlainDataBack");
                } else {
                    alert("Вы не ввели данные!")
                }
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}


function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1
    })
}

function signPlainDataBack(result) {
    if (result['errorCode'] === "NONE") {
        setCookie('signature', result['result'], 1);
        //$("#signature").text(result['result']);
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            //$("#signature").text("");
            alert(result['errorCode']);
        }
    }
}

function createCMSSignatureCall_(pForm) {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    //$("#identifierCMS").text("Не проверено");
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                //var data = $("#dateCMS").val();
                //var flag = $("#flag").is(':checked');
                var flag = false;
                document.getElementById("cms_plain_data").value = getFormData(pForm);
                //alert(data);
                if (data !== null && data !== "") {
                    if (flag) {
                        createCMSSignature(storageAlias, storagePath, alias, password, data, true, "createCMSSignatureBack");
                    } else {
                        createCMSSignature(storageAlias, storagePath, alias, password, data, false, "createCMSSignatureBack");
                    }
                } else {
                    alert("Вы не ввели данные!");
                }
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function createCMSSignatureCall(pForm) {
    var flag = false;
    document.getElementById("cms_plain_data").value = getFormData(pForm);
    if (data !== null && data !== "") {
        connectAndSign(data).then( value => {
            document.getElementById("signature").value = value;
        });
    } else {
        alert("Вы не ввели данные!");
    }
}

function getFormData(pForm) {
    var data = null;
    var comment = document.getElementById("comment").value;
    comment = comment.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    if (pForm == "C01") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value
            + ";Код торгового счёта:" + document.getElementById("edt_legal_code").value
            + ";БИН/ИИН:" + document.getElementById("edt_BIN").value
            + ";Наименование:" + document.getElementById("edt_full_name").value
            + ";E-mail:" + document.getElementById("edt_email").value
            + ";Код раздела регистра учёта гарантийного обеспечения:" + document.getElementById("edt_acc_code_g").value
            + ";Код раздела регистра учёта денег для оплаты Товара:" + document.getElementById("edt_acc_code_p").value
            //+ ";Код раздела регистра учёта гарантийного обеспечения на спецаукцион:" + document.getElementById("edt_acc_code_s").value;
            + ";Дополнительная информация:" + comment
            + ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm == "AU04") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        var rows = document.getElementById("edtRows").value;
        for (var i = 1; i <= rows; i++) {
            var element_name = "edt_legal_code" + i.toString();
            data += ";Код торгового счёта:" + document.getElementById(element_name).value;
            var element_name = "edt_BIN" + i.toString();
            data += ";БИН/ИИН:" + document.getElementById(element_name).value;
            var element_name = "edt_full_name" + i.toString();
            data += ";Наименование:" + document.getElementById(element_name).value;
            var element_name = "edt_acc_code_g" + i.toString();
            data += ";Код раздела регистра учёта гарантийного обеспечения:" + document.getElementById(element_name).value;
            var element_name = "edt_acc_code_p" + i.toString();
            data += ";Код раздела регистра учёта денег для оплаты Товара:" + document.getElementById(element_name).value;
        }
        data += ";Дополнительная информация:" + comment +
            ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm == "AU03") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        var rows = document.getElementById("edtRows").value;
        for (var i = 1; i <= rows; i++) {
            var element_name = "edtMinusForLegal" + i.toString();
            data += ";Снять с учета на разделе:" + document.getElementById(element_name).value;
            element_name = "edtAddForLegal" + i.toString();
            data += ";Поставить на учет на разделе:" + document.getElementById(element_name).value;
            element_name = "edtLotNumber" + i.toString();
            data += ";Номер лота:" + document.getElementById(element_name).value;
            element_name = "edtAmount" + i.toString();
            data += ";Сумма, тенге:" + document.getElementById(element_name).value;
        }
        data += ";Итого:" + document.getElementById("edtSum").value;
        data += ";Дополнительная информация:" + comment;
        data += ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm == "AU031") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        var rows = document.getElementById("edtRows").value;
        for (var i = 1; i <= rows; i++) {
            var element_name = "edtMinusForLegal" + i.toString();
            data += ";Снять с учета на разделе Отправителя:" + document.getElementById(element_name).value;
            element_name = "edtAddForLegal" + i.toString();
            data += ";Поставить на учет на разделе Получателя:" + document.getElementById(element_name).value;
            element_name = "edtLotNumber" + i.toString();
            element_name = "edtAmount" + i.toString();
            data += ";Сумма, тенге:" + document.getElementById(element_name).value;
        }
        data += ";Итого:" + document.getElementById("edtSum").value;
        data += ";Дополнительная информация:" + comment;
        data += ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm == "AU02") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        var rows = document.getElementById("edtRows").value
        for (var i = 1; i <= rows; i++) {
            var element_name = "edtAccCode" + i.toString();
            data += ";Код раздела:" + document.getElementById(element_name).value;
            //element_name = "edtLotCode" + i.toString();
            //data += ";Код лота:" + document.getElementById(element_name).value;
            element_name = "edtAmount" + i.toString();
            data += ";Сумма, тенге:" + document.getElementById(element_name).value;
        }
        data += ";Итого:" + document.getElementById("edtSum").value;
        data += ";по следующим реквизитам->Наименование получателя:" + document.getElementById("edtRecipient").value
            + ";БИН/ИИН:" + document.getElementById("edtBIN").value
            + ";Номер счета:" + document.getElementById("edtAccount").value
            + ";Наименование банка получателя:" + document.getElementById("edtBank").value
            + ";БИК:" + document.getElementById("edtBIK").value
            + ";Дополнительная информация:" + comment
            + ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm == "AU021") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value
            + ";Участник:" + document.getElementById("edtClient").value
            + ";БИН/ИИН участника:" + document.getElementById("edtClientBin").value;
        var rows = document.getElementById("edtRows").value
        for (var i = 1; i <= rows; i++) {
            var element_name = "edtAccCode" + i.toString();
            data += ";Код раздела:" + document.getElementById(element_name).value;
            element_name = "edtLotCode" + i.toString();
            data += ";Код лота:" + document.getElementById(element_name).value;
            element_name = "edtAmount" + i.toString();
            data += ";Сумма, тенге:" + document.getElementById(element_name).value;
        }
        data += ";Итого:" + document.getElementById("edtSum").value;
        data += ";по следующим реквизитам->Наименование получателя:" + document.getElementById("edtRecipient").value
            + ";БИН/ИИН:" + document.getElementById("edtBIN").value
            + ";Номер счета:" + document.getElementById("edtAccount").value
            + ";Наименование банка получателя:" + document.getElementById("edtBank").value
            + ";БИК:" + document.getElementById("edtBIK").value
            + ";Дополнительная информация:" + comment
            + ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm == "AU022") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        var rows = document.getElementById("edtRows").value
        for (var i = 1; i <= rows; i++) {
            var element_name = "edtAccCode" + i.toString();
            data += ";Код раздела:" + document.getElementById(element_name).value;
            element_name = "edtAmount" + i.toString();
            data += ";Сумма, тенге:" + document.getElementById(element_name).value;
        }
        data += ";Итого:" + document.getElementById("edtSum").value;
        data += ";по следующим реквизитам->Наименование получателя:" + document.getElementById("edtRecipient").value
            + ";БИН/ИИН:" + document.getElementById("edtBIN").value
            + ";Номер счета:" + document.getElementById("edtAccount").value
            + ";Наименование банка получателя:" + document.getElementById("edtBank").value
            + ";БИК:" + document.getElementById("edtBIK").value
            + ";Дополнительная информация:" + comment
            + ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    return data;
}


function createCMSSignatureBack(result) {
    if (result['errorCode'] === "NONE") {
        //alert(result['result']);
        //$("#signatureCMS").text(result['result']);
        document.getElementById("signature").value = result['result'];
        //setCookie('signature', result['result'], 1);
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            $("#signatureCMS").text("");
            alert(result['errorCode']);
        }
    }
}

function signXmlCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    $("#identifierXML").text("Не проверено");
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                var data = document.getElementById("dateXML").value;
                if (data !== null && data !== "") {
                    signXml(storageAlias, storagePath, alias, password, data, "signXmlBack");
                } else {
                    alert("Вы не ввели данные!");
                }
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function signXmlBack(result) {
    if (result['errorCode'] === "NONE") {
        document.getElementById("signatureXML").value = result['result'];
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            document.getElementById("signatureXML").value = "";
            alert(result['errorCode']);
        }
    }
}

function signXmlByElementIdCall() {
    document.getElementById("signatureXMLById").value = "";
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    $("#identifierXMLById").text("Не проверено");
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                var data = document.getElementById("dateXMLById").value;
                var xmlElemName = $("#xmlElemName").val();
                var xmlIdAttrName = $("#xmlIdAttrName").val();
                var signatureParentElement = $("#signatureParentElement").val();
                if (data !== null && data !== "" && xmlElemName !== null && xmlElemName !== "" &&
                    xmlIdAttrName !== null && xmlIdAttrName !== "") {
                    signXmlByElementId(storageAlias, storagePath, alias, password, data, xmlElemName, xmlIdAttrName, signatureParentElement, "signXmlByElementIdBack");
                } else {
                    alert("Вы не ввели данные или не указали идентификатор!");
                }
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function signXmlByElementIdBack(result) {
    if (result['errorCode'] === "NONE") {
        document.getElementById("signatureXMLById").value = result['result'];
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            document.getElementById("signatureXMLById").value = "";
            alert(result['errorCode']);
        }
    }
}

function verifyXmlCall() {
    var signature = document.getElementById("signatureXML").value;
    if (signature !== null && signature !== "") {
        verifyXml(signature, "verifyXmlBack");
    } else {
        alert("Не найден подписанный XML!");
    }
}

function verifyXmlBack(result) {
    if (result['errorCode'] === "NONE") {
        if (result['result']) {
            $("#identifierXML").text("Валидная подпись");
        } else {
            $("#identifierXML").text("Неправильная подпись");
        }
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            $("#identifierXML").text("Неправильная подпись");
            alert(result['errorCode']);
        }
    }
}

function verifyXmlByIdCall() {
    var signature = document.getElementById("signatureXMLById").value;
    var signatureParentElement = document.getElementById("signatureParentElement").value;
    var xmlIdAttrName = document.getElementById("xmlIdAttrName").value;
    if (signature !== null && signature !== "") {
        verifyXmlById(signature, xmlIdAttrName, signatureParentElement, "verifyXmlByIdBack");
    } else {
        alert("Не найден подписанный XML!");
    }
}

function verifyXmlByIdBack(result) {
    if (result['errorCode'] === "NONE") {
        if (result['result']) {
            $("#identifierXMLById").text("Валидная подпись");
        } else {
            $("#identifierXMLById").text("Неправильная подпись");
        }
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['errorCode'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            $("#identifierXML").text("Неправильная подпись");
            alert(result['errorCode']);
        }
    }
}

function verifyPlainDataCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                //var data = $("#date").val();
                //var data = document.getElementById("comment").value;
                //var signature = $("#signature").val();
                //var signature = getCookie('signature');
                //alert(data);
                //alert(signature);
                if (data !== null && data !== "" && signature !== null && signature !== "") {
                    verifyPlainData(storageAlias, storagePath, alias, password, data, signature, "verifyPlainDataBack");
                } else {
                    alert("Вы не ввели данные, или подписанные данные не найдены!");
                }
            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}

function verifyPlainDataBack(result) {
    //alert(result['errorCode']);
    //alert(result['result']);
    //alert('verifyPlainDataBack');
    if (result['errorCode'] === "NONE") {
        if (result['result']) {
            //$("#identifier").text("Валидная подпись");
            document.getElementById("signature").value = 'Подписано';
            //alert('Valid');
            //$("#verify").text('Валидная подпись');
        } else {
            document.getElementById("signature").value = 'Ошибка подписи.';
            //$("#identifier").text("Неправильная подпись");
            //alert('Неправильная подпись');
            //$("#verify").text('Неправильная подпись');
            //document.getElementById("signature").value = 'Неправильная подпись';
        }
    } else {
        if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
            alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
        } else if (result['errorCode'] === "WRONG_PASSWORD") {
            alert("Неправильный пароль!");
        } else {
            //alert(result['errorCode']);
        }
    }
}

function verifyCMSSignatureCall() {
    var data = $("#dateCMS").val();
    var signatureCMS = $("#signatureCMS").val();
    if (signatureCMS !== null && signatureCMS !== "") {
        verifyCMSSignature(signatureCMS, data, "verifyCMSSignatureBack");
    } else {
        alert("Вы не ввели данные, или подписанные данные не найдены!");
    }
}

function verifyCMSSignatureBack(result) {
    if (result['errorCode'] === "NONE") {
        if (result['result']) {
            $("#identifierCMS").text("Валидная подпись");
        } else {
            $("#identifierCMS").text("Неправильная подпись");
        }
    } else {
        $("#identifierCMS").text("Неправильная подпись");
        alert(result['errorCode']);
    }
}

function getRdnByOidCall() {
    var storageAlias = $("#storageAlias").val();
    var storagePath = $("#storagePath").val();
    var password = $("#password").val();
    var alias = $("#keyAlias").val();
    if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
        if (password !== null && password !== "") {
            if (alias !== null && alias !== "") {
                var oid = "";
                var selected = $("input[type='radio'][name='oid']:checked");
                if (selected.length > 0) {
                    oid = selected.val();
                }
                getRdnByOid(storageAlias, storagePath, alias, password, oid, 0, "getRdnByOidBack");

            } else {
                alert("Вы не выбрали ключ!");
            }
        } else {
            alert("Введите пароль к хранилищу");
        }
    } else {
        alert("Не выбран хранилище!");
    }
}



function SignAndVerify(pForm) {
    createCMSSignatureCall(pForm);
    $('#myModal').modal('hide');
    document.getElementById("signed").value = "Подписано";
}
