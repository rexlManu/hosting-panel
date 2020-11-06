<?php

$id = $helper->xssFix($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `webspace` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'webspace/order');
}

if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'services'));
}

if(isset($_POST['renew'])){

    $error = null;

    if(empty($_POST['duration'])){
        $error = 'Bitte wähle eine Laufzeit aus';
    }

    $price = $serverInfos['price'] * ($_POST['duration'] / 30);

    if($validate->duration($_POST['duration']) != true){
        $error = 'Bitte gebe eine gültige Laufzeit an';
    }

    if(empty($error)){

        $date = new DateTime($serverInfos['expire_at'], new DateTimeZone('Europe/Berlin'));
        $date->modify('+' . $_POST['duration'] . ' day');
        $expire_at = $date->format('Y-m-d H:i:s');

        $SQLGetServerInfos = $db->prepare("UPDATE `webspace` SET `expire_at` = :expire_at, `state` = 'active' WHERE `id` = :id");
        $SQLGetServerInfos -> execute(array(":expire_at" => $expire_at, ":id" => $id));

        echo sendSuccess('Dein Webspace wurde verlängert');

        header('refresh:3;url='.$helper->url().'webspace/manage/'.$serverInfos['id']);

    } else {
        echo sendError($error);
    }

}
