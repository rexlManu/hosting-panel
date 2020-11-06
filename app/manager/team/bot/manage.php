<?php

$bot_id = $helper->protect($_GET['id']);

$SQL = $db->prepare("SELECT * FROM `bots` WHERE `id` = :id");
$SQL->execute(array(":id" => $bot_id));
$data = $SQL->fetch(PDO::FETCH_ASSOC);

if(!is_null($data['deleted_at'])){
    die(header('Location: '.$helper->url()));
}

$current_song = $manage->songName($data);

if(isset($_POST['updateServerData'])){
    $error = null;

    if (empty($error) && empty($_POST['server_addr'])) {
        $error = 'Bitte gebe eine Server IP an';
    }

    if(empty($error)){

        if($_POST['server_addr'] != $data['server_addr']){
            $response = $bot->changeServerAddr($data, $data['node_id'], $_POST['server_addr']);
            if(!isset($response->ErrorMessage)) {
                $updateBot = $db->prepare("UPDATE `bots` SET `server_addr` = :server_addr WHERE `id` = :id");
                $updateBot->execute(array(":server_addr" => $_POST['server_addr'], ":id" => $data['id']));
            } else {
                $error = $response->ErrorMessage;
            }
        }

        if($_POST['channel_password'] != $data['channel_password']){
            $response = $bot->changeChannelPassword($data, $data['node_id'], $_POST['channel_password'],false);
            if(isset($response)){
                $error = $response;
            }
        }

        if($_POST['default_channel'] != $data['default_channel']){
            $response = $bot->changeDefaultChannel($data, $data['node_id'], $_POST['channel_id'],false);
            if(isset($response)){
                $error = $response;
            }
        }

        if($_POST['bot_name'] != $data['bot_name'] && !empty($_POST['bot_name'])){
            if (empty($data['bot_id'])) {
                $error = 'Der Bot muss gestartet sein damit der Name geändert werden kann';
            } else {
                $response = $bot->rename($data, $data['node_id'], $_POST['bot_name']);
                if(isset($response)){
                    $error = $response;
                }
            }
        }

        if(empty($error)){
            $_SESSION['success_msg'] = 'Die Einstellungen wurden gespeichert';
            header('refresh:0;url='.$helper->url().'bot/'.$bot_id);
        } else {
            $_SESSION['error_msg'] = $error;
            header('refresh:0;url='.$helper->url().'bot/'.$bot_id);
        }

    }else {
        $_SESSION['error_msg'] = $error;
    }
}

$volume = $data['volume'];

if(isset($_POST['volume']) && !empty($_POST['volume'])){
    if($_POST['volume'] != $data['volume']){
        if($_POST['volume'] >= 1 && $_POST['volume'] <= 100) {
            if (empty($data['bot_id'])) {
                $updateBot = $db->prepare("UPDATE `bots` SET `volume` = :volume WHERE `id` = :id");
                $updateBot->execute(array(":volume" => $_POST['volume'], ":id" => $data['id']));
            } else {
                $response = $bot->volume($data, $data['node_id'], $_POST['volume']);
                if (isset($response)) {
                    $error = $response;
                }
            }
        } else {
            $error = 'Bitte gebe eine Lautstärke von 1 bis 100 an';
        }
    }

    if(empty($error)){
        $volume = $_POST['volume'];
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['startBot'])){

    if(!empty($data['bot_id'])){
        $error = 'Der Bot läuft bereits';
    }

    if(empty($data['server_addr'])){
        $error = 'Bitte gebe eine Server IP an';
    }

    if(empty($error)){
        $bot->start($data, $bot_id, $data['node_id']);
        $_SESSION['success_msg'] = 'Dein Bot wurde gestartet';
        header('refresh:3;url='.$helper->url().'bot/'.$bot_id);
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['stopBot'])){

    if(empty($data['bot_id'])){
        $error = 'Der Bot ist nicht gestartet';
    }

    if(empty($error)){
        $bot->stop($data, $bot_id, $data['node_id']);
        $_SESSION['success_msg'] = 'Dein Bot wurde gestoppt';
        header('refresh:3;url='.$helper->url().'bot/'.$bot_id);
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['deleteBot'])){

    if(!empty($data['bot_id'])){
        $error = 'Bitte stoppe den Bot zuerst';
    }

    if(empty($error)){
        $response = $bot->delete($data, $data['node_id']);
        if(empty($response)){
            $_SESSION['success_msg'] = 'Dein Bot wurde gelöscht gelöscht';
            header('Location: '.$helper->url());
        } else {
            $_SESSION['error_msg'] = $response;
        }
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['playNow'])){

    if(empty($_POST['stream_url'])){
        $error = 'Bitte gebe einen Link an';
    }

    if(empty($data['bot_id'])){
        $error = 'Der Bot ist nicht gestartet';
    }

    if(empty($error)){
        $bot->play($data, $data['node_id'], $_POST['stream_url']);
        $_SESSION['success_msg'] = 'Die Url wird nun abgespielt';
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['stream_url'])){

    if(empty($_POST['stream_url'])){
        $error = 'Bitte gebe einen Link an';
    }

    if(empty($data['bot_id'])){
        $error = 'Der Bot ist nicht gestartet';
    }

    if(empty($error)){
        $bot->play($data, $data['node_id'], $_POST['stream_url']);
        $_SESSION['success_msg'] = 'Die Url wird nun abgespielt';
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['addUrl'])){

    if(empty($_POST['name'])){
        $error = 'Bitte gebe einen Namen an';
    }

    if(empty($_POST['url'])){
        $error = 'Bitte gebe eine Url an';
    }

    if(empty($error)){
        $user->addStream($userid, $_POST['name'], $_POST['url']);
        $_SESSION['success_msg'] = 'Die Url wird nun hinzugefügt';
        header('Location: '.$helper->url().'bot/'.$bot_id);
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['del_stream_id'])){

    if(empty($_POST['del_stream_id'])){
        $error = 'Es wurde keine Url ID gefunden';
    }

    if(empty($error)){
        $user->delStream($userid, $_POST['del_stream_id']);
        $_SESSION['success_msg'] = 'Die Url wird nun entfernt';
        header('Location: '.$helper->url().'bot/'.$bot_id);
    } else {
        $_SESSION['error_msg'] = $error;
    }
}

if(isset($_POST['stopStream'])) {
    $response = $bot->stopStream($data, $data['node_id']);
    if (empty($response)) {
        $_SESSION['success_msg'] = 'Der Stream wurde  gestoppt';
        header('refresh:3;url=' . $helper->url().'bot/'.$bot_id);
    } else {
        $_SESSION['error_msg'] = $response;
    }
}

if(isset($_POST['activateCommander'])){
    $bot->channelCommander($data, $data['node_id'],'on');
    echo sendSuccess('Channel Commander aktiviert');
}

if(isset($_POST['deactivateCommander'])){
    $bot->channelCommander($data, $data['node_id'],'off');
    echo sendSuccess('Channel Commander deaktiviert');
}
