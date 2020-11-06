<?php

$id = $helper->protect($_GET['id']);

$SQLGetServerInfos = $db->prepare("SELECT * FROM `webspace` WHERE `id` = :id");
$SQLGetServerInfos -> execute(array(":id" => $id));
$serverInfos = $SQLGetServerInfos -> fetch(PDO::FETCH_ASSOC);

if(!($serverInfos['deleted_at'] == NULL)){
    header('Location: '.$helper->url().'webspace/order');
}

if($serverInfos['state'] == 'suspended'){
    $suspended = true;
} else {
    $suspended = false;
}

if($userid != $serverInfos['user_id']){
    die(header('Location: '.$helper->url().'services'));
}

if($serverInfos['state'] == 'active'){
    $state = 'Aktiv';
} elseif($serverInfos['state'] == 'suspended'){
    $state = 'Suspediert';
} elseif($serverInfos['state'] == 'deleted'){
    $state = 'Gelöscht';
}
