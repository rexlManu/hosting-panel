<?php

$site = new Site();
$db = $helper->db();

class Site extends Controller
{
    public function validateCaptcha($captacha) {
        $fields_string = '';
        $fields = array(
            'secret' => Helper::grecaptchaSecret(),
            'response' => $captacha
        );
        foreach($fields as $key=>$value)
            $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function formatDate($datetime)
    {
        $date = new DateTime($datetime, new DateTimeZone('Europe/Berlin'));
        return $date->format('d.m.Y H:i:s');
    }

    public function getRecaptcha()
    {
        $captach = '<script src="https://www.google.com/recaptcha/api.js?render='.Helper::grecaptchaSiteKey().'"></script>
<script>
    var grecaptchaSiteKey = "'.Helper::grecaptchaSiteKey().'";

    var _RECAPTCHA = _RECAPTCHA || {};

    _RECAPTCHA.init = function() {
        grecaptcha.ready(function() {
            grecaptcha.execute(grecaptchaSiteKey, {action: \'homepage\'}).then(function(token) {
                if (jQuery(form)[0]) {
                    if (jQuery(".grecaptchaToken")[0]) {
                        jQuery(form).find(".grecaptchaToken").remove();
                    }

                    jQuery(form).append(\'<input type="hidden" class="grecaptchaToken" name="grecaptchaToken" id="grecaptchaToken" value="\' + token + \'" />\');
                }
            });
        });
    };

    _RECAPTCHA.init();

</script>';

        return $captach;
    }

    public function currentUrl()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        return $actual_link;
    }

    public function getIntervalFactor($interval){

        $IF = $interval / 30;
        return $IF;

    }

}
