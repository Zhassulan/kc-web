<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> 
    <!-- <meta charset="cp1251">  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Сайт Клиринговый Центр ЕТС">
    <meta name="author" content="Клиринговый центр ЕТС">
    <meta name="KEYWORDS" content="<?php require_once 'keywords.php'; ?>"/>
    
    <title>Подпись</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	    
	<style>
   @font-face {
    font-family: Roboto; /* Имя шрифта */
    src: url(fonts/roboto/Roboto-Light.ttf); /* Путь к файлу со шрифтом */  }
    </style>
    	
</head><!--/head-->

<body>
<?php
//$keyfile = '/tmp/key/RSA256_bba3ff3629edcbc6b187a69d850dfeefeed64621.p12';

$path = '/tmp/key/testov_test.cer';

set_include_path(get_include_path() . PATH_SEPARATOR . 'lib/phpseclib1.0.5');
include ('lib/phpseclib1.0.5/Crypt/RSA.php');


$dat = openssl_x509_parse(file_get_contents($path));

$pub_key = openssl_pkey_get_public(file_get_contents($path));
$details = openssl_pkey_get_details($pub_key);
$public_key_res = openssl_pkey_get_public($details['key']);
//echo 'PKEY: </br> '.$keyData['key'];
echo 'pkey: </br>';
var_dump($public_key_res);
//echo $details['key'];

//$pubkeyid = openssl_pkey_get_public($path);

// state whether signature is okay or not
$data = 'Hi, how are you?!';
echo '</br>Data: '.$data.'</br>';
$signature = 'OjkuEqcC5%2F2ZfCmKRs5m3WPJjKvAv1COIy1xywOzwU6FUdSiJwsXicCpUdo%2FHKh4NaCWsEZsOxA3G1XkX8CrcRRkBgUqsipQDgjj40LgY0dDqvaVdFrW6HLll46WtZzyoORPTimdGNL5pmvVTTLwHJMb5mWpf2pTeOXy95LMeZ9eeGBmmGdyT0yMMbCK6JxmmRn%2FEyQWiZP%2BZmxJBtu6aRa0MC4vq9365%2FIOJB9e62gKnLtkjJtIAQeCGbr%2BxoWQA08PF6j98tywYWftUSzVud9ioRtDv0IAI3Lk026C8QRRnDpEebARikp2cSroSj%2Bj74AemudOVASGblWoWffK2w%3D%3D';
echo 'Signature: '.$signature.'</br> Verify: ';

//$validFrom = date('Y-m-d H:i:s', $data['validFrom_time_t']);
//$validTo = date('Y-m-d H:i:s', $data['validTo_time_t']);

//echo $validFrom . "\n";
//echo $validTo . "\n";


//var_dump( $dat ); //Вся информация об открытом ключе

//["signatureTypeSN"]=> string(10) "RSA-SHA256" ["signatureTypeLN"]=> string(23) "sha256WithRSAEncryption"
$ok = openssl_verify($data, $signature, $public_key_res, "sha");
if ($ok == 1) {
	echo "good";
} elseif ($ok == 0) {
	echo "bad";
} else {
	echo "ugly, error checking signature";
}
// free the key from memory
openssl_free_key($public_key_res);

$rsa = new Crypt_RSA();
$rsa->setHash("sha");
$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
$rsa->loadKey($public_key_res);
$verify = $rsa->verify(base64_decode($data), $signature);
echo $verify;

/*
$filename = $keyfile;
$password = '123456';
$results = array();
$worked = openssl_pkcs12_read(file_get_contents($filename), $results, $password);

if	($worked) {
	//echo '<pre>', print_r($results, true), '</pre>';
	echo '</br>'.'<b>Сертификат: </b></br>'.$results['cert'].'</br>';
	echo '</br>'.'<b>Закрытый ключ: </b></br>'.$results['pkey'].'</br>';
} else {
	echo openssl_error_string();
}
$cert = $results['cert'];
//$pubkey = openssl_pkey_get_public("file://src/openssl-0.9.6/demos/sign/cert.pem");
$signature = '';
$data = 'Hi, how are you?';
$pkey = $results['pkey'];
echo '</br>'.'<b>Данные для подписи: </b></br>'.$data.'</br>';
$pkeyid = openssl_pkey_get_private($results['pkey']);
$worked = openssl_sign($data, $binary_signature, $pkey, "sha"); //"SHA256WITHRSA"
$sig = base64_encode($binary_signature);
echo '</br>'.'<b>Подпись: </b></br>'.$sig.'</br>';
$pubkey = openssl_pkey_get_public($cert);
$ok = openssl_verify($data, $binary_signature, $pubkey, "sha");

echo "check #1: ";
if ($ok == 1) {
	echo "signature ok (as it should be)\n";
} elseif ($ok == 0) {
	echo "bad (there's something wrong)\n";
} else {
	echo "ugly, error checking signature\n";
}
*/
?>
</body>
</html>