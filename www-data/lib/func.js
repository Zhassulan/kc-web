class CMSVerifyRequest {
    constructor(login, plainData, signedPlainData) {
        this.login = login;
        this.plainData = plainData;
        this.signedPlainData = signedPlainData;
    }
}

function redirect(link) {
    window.location = link;
    return 0;
}

// Connect to NCAlayer and sign data
async function connectAndSign(data) {
    const ncalayerClient = new NCALayerClient();
    try {
        await ncalayerClient.connect();
    } catch (error) {
        showModal(`Не удалось подключиться к NCALayer: ${error.toString()}`);
        return;
    }
    let activeTokens;
    try {
        activeTokens = await ncalayerClient.getActiveTokens();
    } catch (error) {
        showModal(error.toString());
        return;
    }
    // getActiveTokens может вернуть несколько типов хранилищ, для простоты проверим первый.
    // Иначе нужно просить пользователя выбрать тип носителя.
    const storageType = activeTokens[0] || NCALayerClient.fileStorageType;
    let base64EncodedSignature;
    try {
        base64EncodedSignature = await ncalayerClient.createCAdESFromBase64(storageType, data);
    } catch (error) {
        showModal(error.toString());
        return;
    }
    return base64EncodedSignature;
}

// convert UTF-8 to Base64
function utoa(data) {
    return btoa(unescape(encodeURIComponent(data)));
}

// Sign data
function SignAndVerify(pForm) {
    if (!signCheckVals(pForm)) {
        showModal('Не введены данные формы');
        return;
    }
    console.log('Sign and verify');
    let plainData = getFormData(pForm);
    document.getElementById("cms_plain_data").value = plainData;
    if (plainData !== null && plainData !== "") {
        connectAndSign(utoa(plainData)).then(value => {
            let signedData = value;
            document.getElementById("signature").value = signedData;
            console.log('Calling API..');
            callApiVerify(utoa(plainData), signedData).then(value => {

            });
        });
    } else {
        showModal("Вы не ввели данные!");
    }
}

// Verify sign in Spring Kalkan API
async function callApiVerify(plainData, signedData) {
    console.log('Opening API URL ' + kalkanApiUrl);
    let response = await fetch(kalkanApiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'POST, GET, OPTIONS',
            'Access-Control-Allow-Headers': '*'
        },
        body: JSON.stringify(new CMSVerifyRequest(
            document.getElementById("login").value,
            plainData,
            signedData
        ))
    });
    if (response.ok) { // если HTTP-статус в диапазоне 200-299
        // получаем тело ответа (см. про этот метод ниже)
        //let json = await response.json();
        console.log('API response: ' + JSON.stringify(response.status));
        document.getElementById("signed").value = "Подписано";
        document.getElementById("signedLabel").innerHTML = "Подписано";
        showModal("Документ подписан");
    } else {
        showModal("Ошибка проверки подписи: " + response.status);
    }
}

// Collect form fields data
function getFormData(pForm) {
    let data = null;
    let comment = document.getElementById("comment").value;
    comment = comment.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    if (pForm === "C01") {
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
    if (pForm === "AU04") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        let rows = document.getElementById("edtRows").value;
        for (let i = 1; i <= rows; i++) {
            let element_name = "edt_legal_code" + i.toString();
            data += ";Код торгового счёта:" + document.getElementById(element_name).value;
            element_name = "edt_BIN" + i.toString();
            data += ";БИН/ИИН:" + document.getElementById(element_name).value;
            element_name = "edt_full_name" + i.toString();
            data += ";Наименование:" + document.getElementById(element_name).value;
            element_name = "edt_acc_code_g" + i.toString();
            data += ";Код раздела регистра учёта гарантийного обеспечения:" + document.getElementById(element_name).value;
            element_name = "edt_acc_code_p" + i.toString();
            data += ";Код раздела регистра учёта денег для оплаты Товара:" + document.getElementById(element_name).value;
        }
        data += ";Дополнительная информация:" + comment +
            ";Дата и время создания документа:" + document.getElementById("edt_date").value;
    }
    if (pForm === "AU03") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        let rows = document.getElementById("edtRows").value;
        for (let i = 1; i <= rows; i++) {
            let element_name = "edtMinusForLegal" + i.toString();
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
    if (pForm === "AU031") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        let rows = document.getElementById("edtRows").value;
        for (let i = 1; i <= rows; i++) {
            let element_name = "edtMinusForLegal" + i.toString();
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
    if (pForm === "AU032") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        let rows = document.getElementById("edtRows").value;
        for (let i = 1; i <= rows; i++) {
            let element_name = "edtMinusForLegal" + i.toString();
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
    if (pForm === "AU02") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        let rows = document.getElementById("edtRows").value
        for (let i = 1; i <= rows; i++) {
            let element_name = "edtAccCode" + i.toString();
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
    if (pForm === "AU021") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value
            + ";Участник:" + document.getElementById("edtClient").value
            + ";БИН/ИИН участника:" + document.getElementById("edtClientBin").value;
        let rows = document.getElementById("edtRows").value
        for (let i = 1; i <= rows; i++) {
            let element_name = "edtAccCode" + i.toString();
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
    if (pForm === "AU022") {
        data = document.getElementById("edt_form").value
            + ";Брокер:" + document.getElementById("edt_broker_name").value
            + ";Код брокера:" + document.getElementById("edt_broker_code").value
            + ";Логин отправителя:" + document.getElementById("edt_login").value;
        let rows = document.getElementById("edtRows").value
        for (let i = 1; i <= rows; i++) {
            let element_name = "edtAccCode" + i.toString();
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

// if need we can catch щт submit form event
function frmOnSubmit() {
    return false;
}

// submit form from JS
function submitForm() {
    if (document.getElementById("signature").value === "") {
        showModal('Документ не подписан');
    } else {
        let form = document.getElementById("frm");
        form.submit();
    }
}

let substringMatcher = function (strs) {
    return function findMatches(q, cb) {
        let matches, substrRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function (i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

if (window.location.href.indexOf('AU021') !== -1) {
    $('#the-basics-clients .typeahead').typeahead({
            hint: true,
            minLength: 1,
            highlight: true
        },
        {
            name: 'clients',
            source: substringMatcher(clients)
        });
    $('#the-basics-accounts .typeahead').typeahead({
            hint: true,
            minLength: 1,
            highlight: true
        },
        {
            name: 'accounts',
            source: substringMatcher(accounts)
        });
}

if (window.location.href.indexOf('AU022') !== -1) {
    $('#the-basics-accounts .typeahead').typeahead({
            hint: true,
            minLength: 1,
            highlight: true
        },
        {
            name: 'accounts',
            source: substringMatcher(accounts)
        });
}

if (window.location.href.indexOf('AU031') !== -1 || window.location.href.indexOf('AU032') !== -1) {
    $('#the-basics-minus-legal .typeahead').typeahead({
            hint: true,
            minLength: 1,
            highlight: true
        },
        {
            name: 'accounts',
            source: substringMatcher(accounts)
        });
    $('#the-basics-add-legal .typeahead').typeahead({
            hint: true,
            minLength: 1,
            highlight: true
        },
        {
            name: 'accounts',
            source: substringMatcher(accounts)
        });
}

if (window.location.href.indexOf('AU04') !== -1) {
    $('#the-basics-clients .typeahead').typeahead({
            hint: true,
            minLength: 1,
            highlight: true
        },
        {
            name: 'clients',
            source: substringMatcher(clients)
        });
}

function getUrlParams() {
    const queryString = window.location.search;
    return new URLSearchParams(queryString);
}

function showModal(msg) {
    document.getElementById("modal-body").innerHTML = msg;
    $('#modalMsg').modal('show');
}

function processUrl() {
    let form = '';
    console.log('Processing URL..');
    let urlParams = getUrlParams();
    switch (urlParams.get('p')) {
        case 'C01':
            form = 'C01';
            break;
        case 'AU021':
            form = 'AU021';
            break;
    }
    console.log('form ' + form);
    if (form === 'C01') {
        switch (urlParams.get('error')) {
            case 'empty':
                showModal('Ошибка, пустые поля');
                break;
            case 'length':
                showModal('Ошибка, длина некоторых полей не соответствует');
                break;
            case 'bin':
                showModal('Ошибка, БИН не существует');
                break;
            case 'legalCode':
                showModal('Ошибка, код торгового счета не существует');
                break;
            case null:
                break;
        }
    }
    if (urlParams.get('sent') !== null)
        if (urlParams.get('sent') === 'true')
            showModal('Документ отправлен');
        else
            showModal('Ошибка отправки документа');
}

function signCheckVals(form) {
    switch (form) {
        case 'C01':
            if (!signCheckValsC01()) return false;
            break;
        case 'AU021':
            if (!signCheckValsAU021()) return false;
            break;
    }
    return true;
}

function signCheckValsC01() {
    if (document.getElementById("edt_BIN").value === '') return false;
    if (document.getElementById("edt_full_name").value === '') return false;
    if (document.getElementById("edt_email").value === '') return false;
    if (document.getElementById("edt_acc_code_g").value === '') return false;
    if (document.getElementById("edt_acc_code_p").value === '') return false;
    return true;
}

function signCheckValsAU021() {
    if (document.getElementById("edtClient").value === '') return false;
    if (document.getElementById("edtClientBin").value === '') return false;
    let rows = document.getElementById("edtRows").value
    for (let i = 1; i <= rows; i++) {
        let element_name = "edtAccCode" + i.toString();
        if (document.getElementById(element_name).value === '') return false;
        element_name = "edtLotCode" + i.toString();
        if (document.getElementById(element_name).value === '') return false;
        element_name = "edtAmount" + i.toString();
        if (document.getElementById(element_name).value === '') return false;
    }
    if (document.getElementById('edtSum').value === '') return false;
    if (document.getElementById('edtRecipient').value === '') return false;
    if (document.getElementById('edtBIN').value === '') return false;
    if (document.getElementById('edtAccount').value === '') return false;
    if (document.getElementById('edtBIK').value === '') return false;
    if (document.getElementById('edtBank').value === '') return false;
    return true;
}
