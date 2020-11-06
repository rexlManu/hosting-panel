<?php
if(isset($_POST['createBot'])){
    $error = null;

    if(empty($_POST['node'])){
        $error = 'Bitte wähle eine Node aus';
    }

    if(empty($_POST['name'])){
        $error = 'Bitte gebe deinem Bot einen Namen';
    }

    if($bot->getSelfCount($_COOKIE['session_token']) >= $user->getBotSlots($userid)){
        $error = 'Du hast das Botlimit erreicht';
    }

    if(empty($error)){
        $bot->create($_COOKIE['session_token'], $helper->protect($_POST['name']), $_POST['node']);
        echo sendSuccess('Bot wurde erstellt');
    } else {
        echo sendError($error);
    }
}
