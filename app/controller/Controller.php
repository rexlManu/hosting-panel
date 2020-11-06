<?php

global $url;

abstract class Controller
{

    public function db()
    {

        include 'config.php';

        $db = new PDO('mysql:host=' . $db_host . ';charset=utf8;dbname=' . $db_name, $db_username, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public function url()
    {
        include 'config.php';

        return $url;
    }

    public function cdnUrl()
    {
        include 'config.php';

        return $cdnUrl;
    }

    public function siteName()
    {
        include 'config.php';

        return $siteName;
    }

    public function grecaptchaSiteKey()
    {
        include 'config.php';

        return $grecaptchaSiteKey;
    }

    public function grecaptchaSecret()
    {
        include 'config.php';

        return $grecaptchaSecret;
    }

    public function getDateTime()
    {
        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $datetime = $date->format('Y-m-d H:i:s');

        return $datetime;
    }

    public function nl2br2($string)
    {
        $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
        return $string;
    }

    public function setCookie($name, $variable, $time = '777600', $path = '/', $domain = null, $secure = 0)
    {
        setcookie($name, $variable,time()+$time, $path, $domain, $secure);
    }

}
