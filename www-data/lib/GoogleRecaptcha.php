<?php


class GoogleRecaptcha
{
    /* Google recaptcha API url */
    private $google_url = "https://www.google.com/recaptcha/api/siteverify";

    public function VerifyCaptcha($response, $key)
    {
        $url = $this->google_url . "?secret=" . $key . "&response=" . $response;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, TRUE);
        $curlData = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($curlData, TRUE);
        //echo $url;
        if ($res['success'] == 'true')
            return TRUE;
        else
            return FALSE;
    }
}