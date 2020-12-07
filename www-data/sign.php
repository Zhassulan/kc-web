<html>
    <head>
        <META HTTP-EQUIV="content-language" CONTENT="ru">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="lib/ncalayer/js/jquery.js" charset="utf-8"></script>
        <script type="text/javascript" src="lib/ncalayer/js/jquery.blockUI.js" charset="utf-8"></script>
        <script type="text/javascript" src="lib/ncalayer/js/crypto_object.js" charset="utf-8"></script>
        <script type="text/javascript" src="lib/func.js" charset="utf-8"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <title></title>
        <script type="text/javascript">

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
                    }
                    else {
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
                }
                else {
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
                        }
                        else {
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
                }
                else {
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
                }
                else {
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
                        }
                        else {
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
                }
                else {
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
                $("#identifier").text("Не проверено");
                if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
                    if (password !== null && password !== "") {
                        if (alias !== null && alias !== "") {
                            var data = $("#date").val();
                            if (data !== null && data !== "") {
                                signPlainData(storageAlias, storagePath, alias, password, data, "signPlainDataBack");
                            }
                            else {
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

            function signPlainDataBack(result) {
                if (result['errorCode'] === "NONE") {
                    $("#signature").text(result['result']);
                }
                else {
                    if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
                        alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
                    } else if (result['errorCode'] === "WRONG_PASSWORD") {
                        alert("Неправильный пароль!");
                    } else {
                        $("#signature").text("");
                        alert(result['errorCode']);
                    }
                }
            }

            function createCMSSignatureCall() {
                var storageAlias = $("#storageAlias").val();
                var storagePath = $("#storagePath").val();
                var password = $("#password").val();
                var alias = $("#keyAlias").val();
                $("#identifierCMS").text("Не проверено");
                if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
                    if (password !== null && password !== "") {
                        if (alias !== null && alias !== "") {
                            var data = $("#dateCMS").val();
                            var flag = $("#flag").is(':checked');

                            if (data !== null && data !== "") {
                                if (flag) {
                                    createCMSSignature(storageAlias, storagePath, alias, password, data, true, "createCMSSignatureBack");
                                }
                                else {
                                    createCMSSignature(storageAlias, storagePath, alias, password, data, false, "createCMSSignatureBack");
                                }
                            }
                            else {
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

            function createCMSSignatureBack(result) {
                if (result['errorCode'] === "NONE") {
                    $("#signatureCMS").text(result['result']);
                }
                else {
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
                            }
                            else {
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
                }
                else {
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
                            }
                            else {
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
                }
                else {
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
                }
                else {
                    alert("Не найден подписанный XML!");
                }
            }

            function verifyXmlBack(result) {
                if (result['errorCode'] === "NONE") {
                    if (result['result'])
                    {
                        $("#identifierXML").text("Валидная подпись");
                    }
                    else {
                        $("#identifierXML").text("Неправильная подпись");
                    }
                }
                else {
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
                }
                else {
                    alert("Не найден подписанный XML!");
                }
            }

            function verifyXmlByIdBack(result) {
                if (result['errorCode'] === "NONE") {
                    if (result['result'])
                    {
                        $("#identifierXMLById").text("Валидная подпись");
                    }
                    else {
                        $("#identifierXMLById").text("Неправильная подпись");
                    }
                }
                else {
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
                            var data = $("#date").val();
                            var signature = $("#signature").val();
                            if (data !== null && data !== "" && signature !== null && signature !== "") {
                                verifyPlainData(storageAlias, storagePath, alias, password, data, signature, "verifyPlainDataBack");
                            }
                            else {
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

            function verifyPlainDataBack1(result) {
                if (result['errorCode'] === "NONE") {
                    if (result['result'])
                    {
                        $("#identifier").text("Валидная подпись");
                    }
                    else {
                        $("#identifier").text("Неправильная подпись");
                    }
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

            function verifyCMSSignatureCall() {
                var data = $("#dateCMS").val();
                var signatureCMS = $("#signatureCMS").val();
                if (signatureCMS !== null && signatureCMS !== "") {
                    verifyCMSSignature(signatureCMS, data, "verifyCMSSignatureBack");
                }
                else {
                    alert("Вы не ввели данные, или подписанные данные не найдены!");
                }
            }

            function verifyCMSSignatureBack(result) {
                if (result['errorCode'] === "NONE") {
                    if (result['result'])
                    {
                        $("#identifierCMS").text("Валидная подпись");
                    }
                    else {
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

            function getRdnByOidBack(result) {
                if (result['errorCode'] === "NONE") {
                    $("#rdnvalue").val(result['result']);
                }
                else {
                    if (result['errorCode'] === "WRONG_PASSWORD" && result['result'] > -1) {
                        alert("Неправильный пароль! Количество оставшихся попыток: " + result['result']);
                    } else if (result['errorCode'] === "WRONG_PASSWORD") {
                        alert("Неправильный пароль!");
                    } else {
                        $("#rdnvalue").val("RDN не найден!");
                        alert(result['errorCode']);
                    }
                }
            }

            function selectFileToSignCall() {
                try {
                    showFileChooser("ALL", "", "selectFileToSignBack");
                } catch (e) {
                    alert(e);
                }
            }

            function selectFileToSignBack(result) {
                if (result['errorCode'] === "NONE") {
                    document.getElementById("filePath").value = result['result'];
                } else {
                    alert(result['errorCode']);
                }
            }

            function createCMSSignatureFromFileCall() {
                var storageAlias = $("#storageAlias").val();
                var storagePath = $("#storagePath").val();
                var password = $("#password").val();
                var alias = $("#keyAlias").val();
                var rw = null;


                $("#identifierCMSFile").text("Не проверено");
                if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
                    if (password !== null && password !== "") {
                        if (alias !== null && alias !== "") {

                            var filePath = $("#filePath").val();
                            var flag = $("#flagFile").is(':checked');

                            if (filePath !== null && filePath !== "") {
                                if (flag) {
                                    createCMSSignatureFromFile(storageAlias, storagePath, alias, password, filePath, true, "createCMSSignatureFromFileBack");
                                }
                                else {
                                    createCMSSignatureFromFile(storageAlias, storagePath, alias, password, filePath, false, "createCMSSignatureFromFileBack");
                                }
                            }
                            else {
                                alert("Вы не ввели путь к файлу");
                            }
                        } else {
                            alert("Вы не выбрали ключ!");
                        }
                    } else {
                        alert("Введите пароль к хранилищу");
                    }
                } else {
                    alert("Не выбрано хранилище!");
                }
            }

            function createCMSSignatureFromFileBack(result) {
                if (result['errorCode'] === "NONE") {
                    $("#signatureCMSFile").text(result['result']);
                }
                else {
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

            function verifyCMSSignatureFromFileCall() {
                var signatureCMSFile = $("#signatureCMSFile").val();
                var filePath = $("#filePath").val();
                if (signatureCMS !== null && signatureCMS !== "") {
                    var rw = null;
                    verifyCMSSignatureFromFile(signatureCMSFile, filePath, "verifyCMSSignatureFromFileBack");
                }
                else {
                    alert("Вы не ввели данные, или подписанные данные не найдены!");
                }
            }

            function verifyCMSSignatureFromFileBack(result) {
                if (result['errorCode'] === "NONE") {
                    if (result['result'])
                    {
                        $("#identifierCMSFile").text("Валидная подпись");
                    }
                    else {
                        $("#identifierCMSFile").text("Неправильная подпись");
                    }
                } else {
                    $("#identifierCMSFile").text("Неправильная подпись");
                    alert(result['errorCode']);
                }
            }

            function getHashCall() {
                var hashAlgorithm = $("#hashAlg").val();
                var dataHash = $("#dataHash").val();
                if (dataHash !== null && dataHash !== "") {
                    getHash(dataHash, hashAlgorithm, "getHashBack");
                }
                else {
                    alert("Вы не ввели данные для хеширование");
                }
            }

            function getHashBack(result) {
                if (result['errorCode'] === "NONE") {
                    $("#hashArea").text(result['result']);
                } else {
                    alert(result['errorCode']);
                }
            }

            function Sign()	{
                //getSubjectDNCall();
                //var val1 = $("#subjectDn").val();
                //var val1 = $("#subjectDn").val();
                //alert(val1);
                //signPlainDataCall();
                //verifyPlainDataCall();
                //var val2 = $("#identifier").val();
                //document.title = val1 + ", " + val2
                //alert(val2);
            }

        </script>
    </head>
    <body>
    <form id="frm" name="frm" method="post" action="post_c01.php" enctype="multipart/form-data">
       <div class="content">
            <div>
                <span style="font-size:18px; color: blue">Тип хранилища ключа:</span><br/>
                <select onchange="chooseStoragePath();" id="storageAlias" size="1" style="width:100%;">
                    <option value="NONE">-- Выберите тип --</option>
                    <option value="PKCS12">Ваш Компьютер</option>
                    <option value="AKKaztokenStore">Казтокен</option>
                    <option value="AKKZIDCardStore">Личное Удостоверение</option>
                    <option value="AKEToken72KStore">EToken Java 72k</option>
                    <option value="AKJaCartaStore">AK JaCarta</option>
                </select>
                <br/>
                <br/>
                <span style="font-size:18px; color: blue">Путь хранилища ключа:</span><br/>
                <input type="text" readonly="readonly"  id="storagePath" value="" style="width:100%;"/>
                <br/>
                <br/>
                <span style="font-size:18px; color: blue">Пароль для хранилища:</span><br/>
                <input id="password" type="password" style="width: 100%;"/>&nbsp;
                <br/>
                <input style="float: right; width: 28%" value="Тест" onclick="Sign();" type="button"/>
                <!--  
                <span style="font-size:18px; color: blue">Тип ключа:</span><br/>
                <input type="radio" value="SIGN" name="keyType" /> Для подписи
                <br/>
                <input type="radio" value="AUTH" name="keyType" /> Для аутентификаций
                <br/>
                <input type="radio" value="ALL" name="keyType" checked /> Любой
                <br/>
                <br/>  -->
                <span style="font-size:18px; color: blue">Список ключей:</span><br/>
                <input type="hidden" id="keyAlias" value=""/>
                <select  onchange="keysOptionChanged();" id="keys" style="width: 70%;"></select>&nbsp;
                <input style="float: right; width: 28%" value="Обновить список ключей\Подписать" onclick="fillKeys();" type="button"/>
            </div>
            <br/><br/>

			<!-- 
			<div>
                <span style="font-size:18px; color: blue">Установка языка(<span style="color: black; font-family: monospace">setLocale</span>):</span><br/>
                <input type="text" id="lang" value="kk" style="width: 70%"/>
                <input value="Применить" onclick="setLocaleCall();" type="button" style="width: 28%; float: right"/>
            </div>
             
            <br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Время начала действия сертификата(<span style="color: black; font-family: monospace">getNotBefore</span>):</span><br/>
                <input type="text" readonly  id="notbefore" value="Нажмите на кнопку чтобы узнать" style="width: 70%"/>
                <input value="Сертификат действителен с" onclick="getNotBeforeCall();" type="button" style="width: 28%; float: right"/>
            </div>
            <br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Время исхода действия сертификата(<span style="color: black; font-family: monospace">getNotAfter</span>):</span><br/>
                <input type="text" readonly  id="notafter" value="Нажмите на кнопку чтобы узнать" style="width: 70%"/>
                <input value="Сертификат действителен до" onclick="getNotAfterCall();" type="button" style="width: 28%; float: right"/>
            </div>
            <br/><br/>
            -->
            <div>
                <span style="font-size:18px; color: blue">Получить данные субъекта(<span style="color: black; font-family: monospace">getSubjectDN</span>):</span><br/>
                <textarea readonly  id="subjectDn" style="width:100%; height: 60px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <input value="Получить данные субъекта" onclick="getSubjectDNCall();" type="button" style="width: 100%; margin-top: 5px; height: 25px; float: right"/>
            </div>
            <br/><br/><br/>
            
            <div>
                <span style="font-size:18px; color: blue">Получить данные Удостоверяющего центра(<span style="color: black; font-family: monospace">getIssuerDN</span>):</span><br/>
                <textarea readonly  id="issuerDn" style="width: 100%; height: 60px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <input value="Данные Удостоверяющего центра" onclick="getIssuerDNCall();" type="button" style="width: 100%; margin-top: 5px; height: 25px; float: right"/>
            </div>
             
            <br/>
            <br/>
            <br/>
            <br/>
            <div>
                <span style="font-size:18px; color: blue">Получить значение RDN по OID(<span style="color: black; font-family: monospace">getRdnByOid</span>):</span><br/>
                <br/>
                <input type="radio" value="2.5.4.7" name="oid" /> Локализация(L)
                <br/>
                <input type="radio" value="2.5.4.3" name="oid" checked/> Общепринятое имя(CN)
                <br/>
                <input type="radio" value="2.5.4.4" name="oid"/> Фамилия(SURNAME)
                <br/>
                <input type="radio" value="2.5.4.5" name="oid"/> ИИН(SERIALNUMBER)
                <br/>
                <input type="radio" value="2.5.4.6" name="oid"/> Страна(C)
                <br/>
                <input type="radio" value="2.5.4.8" name="oid"/> Область(S)
                <br/>
                <input type="radio" value="2.5.4.10" name="oid"/> Название организации(O)
                <br/>
                <input type="radio" value="2.5.4.11" name="oid"/> БИН(OU)
                <br/>
                <input type="radio" value="1.2.840.113549.1.9.1" name="oid"/> Адрес электронной почты(E)
                <br/>
                <input type="radio" value="0.9.2342.19200300.100.1.25" name="oid"/> Компонент домена(DC)
                <br/>
                <input type="radio" value="2.5.4.15" name="oid" /> Бизнес категория(BC)
                <br/>
                <br/>
                <input type="text" readonly  id="rdnvalue" value="Нажмите на кнопку чтобы узнать" style="width: 70%"/>
                <input value="Получить RDN по OID" onclick="getRdnByOidCall();" type="button" style="width: 28%; float: right"/>
                <br/>
                <br/>
            </div>
            <br/><br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Введите данные для подписи(<span style="color: black; font-family: monospace">signPlainData</span>):</span><br/>
                <input type="text" id="date" value="1111111111111111" style="width: 70%"/>
                <input value="Подпиcать данные" onclick="signPlainDataCall();" type="button" style="width: 28%; float: right"/>
                <br/><br/>
                <span style="font-size:18px; color: blue">Проверить подписанные данные(<span style="color: black; font-family: monospace">verifyPlainData</span>):</span><br/>
                <textarea readonly id="signature" style="width: 70%; height: 110px">
                    Нажмите на кнопку чтобы узнать
                </textarea>

                <span id="identifier" style="width: 28%; float: right; color: green; font-size: 25px; text-align: center; padding-top: 30px">Не проверено</span>
                <br/>
                <input value="Проверить данные" onclick="verifyPlainDataCall();" type="button" style="width: 100%; height: 25px; float: right"/>
            </div>
            <br/><br/><br/><br/><br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Введите данные для подписи(<span style="color: black; font-family: monospace">createCMSSignature</span>):</span><br/>
                <input type="text" id="dateCMS" value="" style="width: 70%"/>
                <input type="checkbox" id="flag" /> Включить данные в подпись
                <br/>
                <input value="Подписать данные" onclick="createCMSSignatureCall();" type="button" style="width: 100%; height: 25px; margin-top: 5px; "/>
                <br/><br/>
                <span style="font-size:18px; color: blue">Проверить подисанные данные(<span style="color: black; font-family: monospace">verifyCMSSignature</span>):</span><br/>
                <textarea readonly id="signatureCMS" style="width: 70%; height: 110px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <span id="identifierCMS" style="width: 28%; float: right; color: green; font-size: 25px; text-align: center; padding-top: 30px">Не проверено</span>
                <br/>
                <input value="Проверить данные" onclick="verifyCMSSignatureCall();" type="button" style="width: 100%; height: 25px; float: right"/>
            </div>
            <br/>
            <br/><br/><br/><br/><br/>
            <div>
                <span style="font-size:18px; color: blue">XML для подписи(<span style="color: black; font-family: monospace">signXML</span>):</span><br/>
                <textarea id="dateXML" style="width: 100%; height: 170px"><?xml version="1.0" encoding="utf-8"?>
                <root>
                    <name>Ivan</name>
                    <iin>123456789012</iin>
                </root>
                </textarea>
                <br/>
                <input value="Подписать данные" onclick="signXmlCall();" type="button" style="width: 100%; height: 25px; margin-top: 5px; "/>
                <br/><br/>
                <span style="font-size:18px; color: blue">Проверить подписанный XML(<span style="color: black; font-family: monospace">verifyXml</span>):</span><br/>
                <textarea id="signatureXML" style="width: 70%; height: 170px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <span id="identifierXML" style="width: 28%; float: right; color: green; font-size: 25px; text-align: center; padding-top: 50px">Не проверено</span>
                <br/>
                <input value="Проверить данные" onclick="verifyXmlCall();" type="button" style="width: 100%; height: 25px; float: right"/>
            </div>
            <br/><br/><br/><br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Подписать XML по идентификатору элемента(<span style="color: black; font-family: monospace">signXMLById</span>):</span><br/>
                <textarea id="dateXMLById" style="width: 100%; height: 170px"><?xml version="1.0" encoding="utf-8"?>
                <root>
                    <person id="personId">
                        <name>Ivan</name>
                        <iin>123456789012</iin>
                    </person>
                    <company id="companyId">
                        <name>Company Name</name>
                        <bin>123456789012</bin>
                    </company>
                </root>
                </textarea>
                <br/><br/>
                <span style="font-size:14px; width: 180px">Подписываемый элемент XML:</span> <input id="xmlElemName" autocomplete="off" style="width: 100%" type="text"/>
                <br/><br/>
                <span style="font-size:14px; width: 180px">Имя атрибута идентификации элемента XML:</span> <input id="xmlIdAttrName" autocomplete="off" style="width: 100%" type="text"/>
                <br/><br/>
                <span style="font-size:14px; width: 180px">Верхний элемент для подписи:</span> <input id="signatureParentElement" autocomplete="off" style="width: 100%" type="text"/>
                <br/>
                <input value="Подписать данные" onclick="signXmlByElementIdCall();" type="button" style="width: 100%; height: 25px; margin-top: 5px; "/>
                <br/><br/>
                <span style="font-size:18px; color: blue">Проверить подписанный XML(<span style="color: black; font-family: monospace">verifyXml(String elemId)</span>):</span><br/>
                <textarea id="signatureXMLById" style="width: 70%; height: 170px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <span id="identifierXMLById" style="width: 28%; float: right; color: green; font-size: 25px; text-align: center; padding-top: 50px">Не проверено</span>
                <br/><br/>
                <span style="font-size:14px; width: 180px">Имя атрибута идентификации элемента XML:</span> <input id="xmlIdAttrName" autocomplete="off" style="width: 100%" type="text"/>
                <br/><br/>
                <span style="font-size:14px; width: 180px">Верхний элемент для подписи:</span> <input id="signatureParentElement" autocomplete="off" style="width: 100%" type="text"/>
                <br/>
                <input value="Проверить данные" onclick="verifyXmlByIdCall();" type="button" style="width: 100%; height: 25px; float: right"/>
            </div>
            <br/><br/><br/><br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Введите путь к файлу для подписи(<span style="color: black; font-family: monospace">createCMSSignatureFromFile</span>):</span><br/>
                <input id="filePath" name="filePath" autocomplete="off" style="width: 70%" type="text" readonly="readonly">
                <input type="checkbox" id="flagFile" /> Включить данные в подпись
                <br /><br />
                <input name="selectFileToSign" id="selectFileToSign" value="Выбрать файл для подписания" onclick="selectFileToSignCall();" type="button" style="width: 28%; float: left">
                <input value="Подпиcать данные" onclick="createCMSSignatureFromFileCall();" type="button" style="width: 28%; float: left"/>
                <br/><br/>
                <span style="font-size:18px; color: blue">Проверить подисанные данные(<span style="color: black; font-family: monospace">verifyCMSSignatureFromFile</span>):</span><br/>
                <textarea readonly id="signatureCMSFile" style="width: 70%; height: 110px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <span id="identifierCMSFile" style="width: 28%; float: right; color: green; font-size: 25px; text-align: center; padding-top: 30px">Не проверено</span>
                <br/>
                <input value="Проверить данные" onclick="verifyCMSSignatureFromFileCall();" type="button" style="width: 100%; height: 25px; float: right"/>
            </div>
            <br/><br/><br/><br/><br/>
            <div>
                <span style="font-size:18px; color: blue">Получить Хэш данных по указанному алгоритму(<span style="color: black; font-family: monospace">getHash</span>):</span>
                <br/>
                <br/>
                <span style="font-size:14px; width: 180px"> Выберите алгоритм хеширование: </span><select id="hashAlg" style="width: 100%"><option value="SHA1">SHA1</option><option value="SHA256">SHA256</option><option value="GOST34311">GOST34311</option></select>
                <br/>
                <br/>
                <span style="font-size:14px; width: 180px">Введите данные для хеширование:</span> <input id="dataHash" autocomplete="off" style="width: 100%" type="text"/>
                <br /><br />
                <textarea readonly id="hashArea" style="width: 100%; height: 110px">
                    Нажмите на кнопку чтобы узнать
                </textarea>
                <br/>
                <input value="Получить Хеш" onclick="getHashCall();" type="button" style="width: 100%; float: left"/>
                <br/><br/>

            </div>
            <br/>
            <br/>
            <br/>
        </div>
    </body>
</html>
