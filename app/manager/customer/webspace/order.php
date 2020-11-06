<?php

if(isset($_POST['order'])){

    $error = null;

    if(!$user->sessionExists($_COOKIE['session_token'])){
        $error = 'Bitte logge dich erst ein';
    }

    if(empty($_POST['planName'])){
        $error = 'Es konnte kein Webspace Paket gefunden werden';
    }

    if($plesk->getPrice($_POST['planName']) == false){
        $error = 'Es konnte kein Webspace Paket mit diesem Namen gefunden werden';
    }

    if($user->serviceCount($userid) >= $webspace_slots){
        $error = 'Du hast das Webspace Limit erreicht '.$user->serviceCount($userid).'/'.$webspace_slots;
    }

    $price = $plesk->getPrice($_POST['planName']);
    $price = number_format($price,2);

    if(empty($error) && is_null($user->getDataBySession($_COOKIE['session_token'],'plesk_uid'))){
        $password = $helper->generateRandomString(25,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@');
        $plesk_uid = $plesk->createUser($username, $username, $password, $mail);
        if(is_numeric($plesk_uid)){
            $SQL = $db->prepare("UPDATE `users` SET `plesk_uid` = :plesk_uid, `plesk_password` = :plesk_password WHERE `id` = :user_id");
            $SQL->execute(array(":plesk_uid" => $plesk_uid, ":plesk_password" => $password, ":user_id" => $userid));
        } else {
            $error = $plesk_uid;
        }
    }

    if(empty($error)){

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $date->modify('+30 day');
        $new_date = $date->format('Y-m-d H:i:s');

        $password = $helper->generateRandomString(25,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!*?_#^/$%@');
        $plesk_uid = $user->getDataBySession($_COOKIE['session_token'],'plesk_uid');
        $domainName = 'web'.$plesk->getLast().'.'.$plesk->getHost()['domainName'];
        $ftp_username = strtolower('ftp_'.$username.$plesk->getLast());

        $webspaceId = $plesk->create($domainName, $plesk->getHost()['ip'], $plesk_uid, $ftp_username, $password, $_POST['planName']);

        if(is_numeric($webspaceId)){
            $SQL = $db->prepare("INSERT INTO `webspace`(`plan_id`, `user_id`, `ftp_name`, `ftp_password`, `domainName`, `webspace_id`, `state`, `expire_at`, `price`) VALUES (?,?,?,?,?,?,?,?,?)");
            $SQL->execute(array($_POST['planName'], $userid, $ftp_username, $password, $domainName, $webspaceId, 'active', $new_date, $price));

            $_SESSION['success_msg'] = 'Vielen Dank! Dein Webspace wird nun eingerichtet';

            header('Location: '.$helper->url().'dashboard');
        } else {
            echo sendError($webspaceId);
        }
    } else {
        echo sendError($error);
    }

}
