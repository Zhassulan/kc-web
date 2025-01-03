<?php


class FreakMailer extends PHPMailer
{
    var $priority = 3;
    var $to_name;
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;

    function FreakMailer()
    {
        global $site;

        // Берем из файла config.php массив $site

        if ($site['smtp_mode'] == 'enabled') {
            $this->Host = $site['smtp_host'];
            $this->Port = $site['smtp_port'];
            //$this->SMTPDebug = 4;
            //$this->IsSMTP();
            //$this->Debugoutput = '/var/log/phpmailer_error_log';
            if ($site['smtp_username'] != '') {
                $this->SMTPAuth = true;
                $this->Username = $site['smtp_username'];
                $this->Password = $site['smtp_password'];
            }
            $this->Mailer = "smtp";
        }
        if (!$this->From) {
            $this->From = $site['from_email'];
        }
        if (!$this->FromName) {
            $this->FromName = $site['from_name'];
        }
        if (!$this->Sender) {
            $this->Sender = $site['from_email'];
        }
        $this->Priority = $this->priority;
        $this->CharSet = "utf-8";
        $this->IsHTML(true);
    }

}