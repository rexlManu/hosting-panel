<?php

if($user->sessionExists($_COOKIE['session_token'])){
    /*
     * set static values
     */

    $username = $user->getDataBySession($_COOKIE['session_token'],'username');
    $mail = $user->getDataBySession($_COOKIE['session_token'],'email');
    $amount = $user->getDataBySession($_COOKIE['session_token'],'amount');
    $userid = $user->getDataBySession($_COOKIE['session_token'],'id');

    $support_pin = $user->getDataBySession($_COOKIE['session_token'],'support_pin');
    $bot_slots = $user->getDataBySession($_COOKIE['session_token'],'bot_limit');
    $webspace_slots = $user->getDataBySession($_COOKIE['session_token'],'webspace_limit');
    if(empty($support_pin)){
        $support_pin = $user->generateSupportPin($userid);
    }

    $user_addr = $user->getDataBySession($_COOKIE['session_token'],'user_addr');
    if(is_null($user_addr)){
        $SQL = $db->prepare("UPDATE `users` SET `user_addr` = :user_addr WHERE `id` = :id");
        $SQL->execute(array(":user_addr" => $user->getIP(), ":id" => $userid));
        $user_addr = $user->getIP();
    }
    if($user->getIP() != $user_addr){
        $_SESSION['info_msg'] = 'Something went wrong';
        setcookie('session_token', null, time(), '/'); header('Location: '.$helper->url().'login');
        die();
    }

}

if (strpos($currPage,'back_') !== false || strpos($currPage,'team_') !== false) {

    /*
     * check if user is logged in
     */
    if(!($user->loggedIn($_COOKIE['session_token']))){
        die(header('Location: '.$helper->url().'login'));
    }

    /*
     * check if user is on team page and is in team
     */
    if(strpos($currPage,'team_') !== false) {
        if(!$user->isInTeam($_COOKIE['session_token'])){
            die(header('Location: '.$url.'dashboard'));
        }
    }

    /*
     * check if user is on admin page and is admin
     */
    if(strpos($currPage,'_admin') !== false) {
        if(!$user->isAdmin($_COOKIE['session_token'])){
            die(header('Location: '.$url.'team/tickets'));
        }
    }

}

$currPageName = explode('_',$currPage)[1];
include 'resources/additional/head.php';
if(strpos($currPage,'_auth') !== false) {

} else {
    include 'resources/additional/header.php';
}
/*
 * manage cookies
 */
include 'app/notifications/sendAlert.php';
if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])){
    echo sendError($_SESSION['error_msg']);
    $_SESSION['error_msg'] = '';
    unset($_SESSION['error_msg']);
}

if(isset($_SESSION['info_msg']) && !empty($_SESSION['info_msg'])){
    echo sendInfo($_SESSION['info_msg']);
    $_SESSION['info_msg'] = '';
    unset($_SESSION['info_msg']);
}

if(isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])){
    echo sendSuccess($_SESSION['success_msg']);
    $_SESSION['success_msg'] = '';
    unset($_SESSION['success_msg']);
}
