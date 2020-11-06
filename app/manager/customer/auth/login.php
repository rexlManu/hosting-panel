<?php
if(isset($_POST['login'])){
    $error = null;

    if(empty($_POST['email'])){
        $error = 'Bitte gebe eine E-Mail an';
    }

    if(empty($_POST['password'])){
        $error = 'Bitte gebe ein Passwort an';
    }

    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
        $error = 'Bitte gebe eine gültige E-Mail an';
    }

    if(!$user->verifyLogin($_POST['email'], $_POST['password'])){
        $error = 'Das angegebene Passwort stimmt nicht';
    }

    if($helper->getSetting('login') == 0){
        $error = 'Der Login ist derzeit deaktiviert';
    }

    if($user->getState($_POST['email']) == 'pending'){
        $error = 'Bitte bestätige nun deine E-Mail';
    }

    if(empty($error)){

        $sessionId = $user->generateSessionToken($_POST['email']);
        setcookie('session_token', $sessionId,time()+'864000','/');

        $SQL = $db->prepare("UPDATE `users` SET `user_addr` = :user_addr WHERE `email` = :email");
        $SQL->execute(array(":user_addr" => $user->getIP(), ":email" => $_POST['email']));

        echo sendSuccess('Login erfolgreich. Du wirst gleich weitergeleitet');
        header('refresh:3;url='.$helper->url().'dashboard');

    } else {
        echo sendError($error);
    }
}
