<?php
if(isset($_POST['register'])){
    $error = null;

//    $google_response = $site->validateCaptcha($_POST['g-recaptcha-response']);
//    if(!($google_response['success'])){
//        $error = 'Ungueltige Anfrage bitte versuche es erneut (Captcha)';
//    }

    if(empty($_POST['username'])){
        $error = 'Bitte gebe einen Benutzernamen an';
    }

    if(empty($_POST['email'])){
        $error = 'Bitte gebe eine E-Mail an';
    }

    if(empty($_POST['password'])){
        $error = 'Bitte gebe ein Passwort an';
    }

    if(empty($_POST['password_repeat'])){
        $error = 'Bitte wiederhole dein Passwort an';
    }

    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
        $error = 'Bitte gebe eine gültige E-Mail an';
    }

    if($_POST['password'] != $_POST['password_repeat']){
        $error = 'Die Passwörter stimmen nicht überein';
    }

    if($user->exists($_POST['email'])){
        $error = 'Ein Benutzer mit dieser E-Mail existiert bereits';
    }

    if($user->exists($_POST['username'])){
        $error = 'Ein Benutzer mit diesem Benutzernamen existiert bereits';
    }

    if($helper->getSetting('register') == 0){
        $error = 'Das Accounterstellen ist derzeit deaktiviert';
    }

    $verify_code = $helper->generateRandomString(16);
    include 'app/notifications/mail_templates/auth/confirm_account.php';
    $mail_state = sendMail($_POST['email'], $_POST['username'], $mailContent, $mailSubject, $emailAltBody);

    if($mail_state != true){
        $error = 'Die E-Mail konnte nicht versendet werden';
    }

    if(empty($error)){

        $user_id = $user->create($helper->xssFix($_POST['username']), $helper->xssFix($_POST['email']), $_POST['password'],'pending','customer');

        $SQL = $db->prepare("UPDATE `users` SET `verify_code` = :verify_code WHERE `id` = :user_id");
        $SQL->execute(array(":verify_code" => $verify_code, ":user_id" => $user_id));

        header('refresh:3;url='.$helper->url().'login');

        echo sendSuccess('Bitte bestätige nun deine Mail!');
    } else {
        echo sendError($error);
    }
}
