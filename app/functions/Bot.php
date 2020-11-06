<?php

$bot = new Bot();
class Bot extends Controller
{

    public function getSelfCount($session_token)
    {
        $user_id = User::getDataBySession($session_token,'id');

        $SQL = self::db()->prepare("SELECT * FROM `bots` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
        $SQL->execute(array(":user_id" => $user_id));
        $count = $SQL->rowCount();

        return $count;
    }

    public function getCreated()
    {
        $SQL = self::db()->prepare("SELECT * FROM `bots`");
        $SQL->execute();
        $count = $SQL->rowCount();

        return $count;
    }

    public function getCount()
    {
        $SQL = self::db()->prepare("SELECT * FROM `bots` WHERE `deleted_at` IS NULL");
        $SQL->execute();
        $count = $SQL->rowCount();

        return $count;
    }

    public function getData($bot_id, $data)
    {
        $SQL = self::db()->prepare("SELECT * FROM `bots` WHERE `id` = :id");
        $SQL->execute(array(":id" => $bot_id));
        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    public function create($session_token, $bot_name, $node_id)
    {
        $user_id = User::getDataBySession($session_token,'id');

        $template_name = $user_id.'_'.Helper::generateRandomString('25');

        $SQL = self::db()->prepare("INSERT INTO `bots`(`user_id`, `bot_name`, `node_id`, `state`, `template_name`) VALUES (?,?,?,?,?)");
        $SQL->execute(array($user_id, $bot_name, $node_id, 'active', $template_name));

        Request::create($node_id, $template_name);
    }

    public function changeServerAddr($data, $node_id, $server_addr)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port')."/api/settings/bot/set/".$data['template_name']."/connect.address/".$server_addr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);
        $resp = json_decode($result);
        return $resp;
    }

    public function play($data, $node_id, $streamurl, $bot_session_id = null, $repeat = 1)
    {
        if(is_numeric($streamurl)){
            $SQL = self::db()->prepare("SELECT * FROM `stream_links` WHERE `id` = :id");
            $SQL->execute(array(":id" => $streamurl));
            $response = $SQL->fetch(PDO::FETCH_ASSOC);

            $streamurl = $response['url'];
        }

        if(is_null($bot_session_id) || $bot_session_id == 0 || $bot_session_id == null){
            $bot_session_id = $data['bot_id'];
        }

        if(is_null($bot_session_id) || $bot_session_id == 0 || $bot_session_id == null){
            $res = new stdClass();
            $res->state = 'error';
            $res->message->warning = null;
            $res->message->error = 'Es konnte kein Bot zum starten gefunden werden ID:'.$bot_session_id;
            $res->message->success = null;
            $res = json_encode($res);
            return $res;
        }

        if($data['auto_repeat'] == 1){

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://" . Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port') . "/api/settings/bot/set/".$data['template_name']."/events.idletime/PT15S");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);

            sleep(1);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://" . Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port') . "/api/settings/bot/set/".$data['template_name']."/events.onidle/".rawurlencode("!play ".$streamurl));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);

            sleep(1);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://" . Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port') . "/api/bot/use/" . $bot_session_id . "/(/play/" . rawurlencode($streamurl));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);

        } else {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://" . Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port') . "/api/bot/use/" . $bot_session_id . "/(/play/" . rawurlencode($streamurl));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);

        }

        if(!empty($data['volume'])){
            sleep(1);
            Bot::volume($data, $node_id, $data['volume']);
        }


        $updateBot = self::db()->prepare("UPDATE `bots` SET `last_stream` = :last_stream WHERE `id` = :id");
        $updateBot->execute(array(":last_stream" => $streamurl, ":id" => $data['id']));

        $res = new stdClass();
        $res->state = 'success';
        $res->message->warning = null;
        $res->message->error = null;
        $res->message->success = 'Song wurde geladen';
        $res = json_encode($res);
        return $res;

    }

    public function start($data, $bot_id, $node_id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id,'node_ip').":" . Node::getData($node_id,'port') . "/api/bot/connect/template/" . $data['template_name']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $server_res = json_decode($result);

        if (isset($server_res->Id)) {
            $bot_session_id = $server_res->Id;

            /*
             * check if bot_id exists
             */
            $getBotIDCount = self::db()->prepare("SELECT * FROM `bots` WHERE `bot_id` = :bot_id AND `node_id` = :node_id");
            $getBotIDCount->execute(array(":bot_id" => $bot_session_id, ":node_id" => $data['node_id']));
            if ($getBotIDCount->rowCount() == 0) {

                $updateBot = self::db()->prepare("UPDATE `bots` SET `bot_id` = :bot_id WHERE `id` = :id");
                $updateBot->execute(array(":bot_id" => $bot_session_id, ":id" => $bot_id));

                sleep(1);

                Bot::rename($data, $node_id, $data['bot_name'], $bot_session_id);

                $res = new stdClass();
                $res->state = 'success';
                $res->message->warning = null;
                $res->message->error = null;
                $res->message->success = 'Der Bot wurde gestartet';
                $res = json_encode($res);
                return $res;

            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://" . Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port') . "/api/bot/use/" . $bot_session_id . "/(/bot/disconnect");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                $headers = array();
                $headers[] = 'Accept: application/json';
                $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $result = curl_exec($ch);
                curl_close($ch);

                $updateBot = self::db()->prepare("UPDATE `bots` SET `bot_id` = null WHERE `bot_id` = :id");
                $updateBot->execute(array(":id" => $bot_session_id));

                $res = new stdClass();
                $res->state = 'error';
                $res->data = 'Bot-ID: '.$bot_id.' Session-ID:'.$bot_session_id.' Node-ID: '.$data['node_id'];
                $res->message->warning = null;
                $res->message->error = 'Der Bot konnte nicht gestartet werden (Duplicate Bot)';
                $res->message->success = null;
                $res = json_encode($res);
                return $res;
            }
        } else {
            $res = new stdClass();
            $res->state = 'error';
            $res->message->warning = null;
            $res->message->error = $server_res->ErrorMessage;
            $res->message->success = null;
            $res = json_encode($res);
            return $res;
        }
    }

    public function stop($data, $bot_id, $node_id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://" . Node::getData($node_id,'node_ip') . ":" . Node::getData($node_id,'port') . "/api/bot/use/" . $data['bot_id'] . "/(/bot/disconnect");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic ' . base64_encode(Node::getData($node_id,'unique_id') . ':' . Node::getData($node_id,'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        $updateBot = self::db()->prepare("UPDATE `bots` SET `bot_id` = NULL WHERE `id` = :id");
        $updateBot->execute(array(":id" => $bot_id));

        $res = new stdClass();
        $res->state = 'success';
        $res->message->warning = null;
        $res->message->error = null;
        $res->message->success = 'Der Bot wurde gestoppt';
        $res = json_encode($res);
        return $res;
    }

    public function volume($data, $node_id, $volume)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id,'node_ip') . ":" . Node::getData($node_id, 'port')."/api/bot/use/".$data['bot_id']."/(/volume/".$volume);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);

        $res = json_decode($result);

        if(empty($res->ErrorMessage)){

            $updateBot = self::db()->prepare("UPDATE `bots` SET `volume` = :volume WHERE `id` = :id");
            $updateBot->execute(array(":volume" => $volume, ":id" => $data['id']));

        } else {
            return $res->ErrorMessage;
        }
    }

    public function delete($data, $node_id)
    {
        Bot::stop($data, $data['id'], $node_id);

        sleep(1);

        Request::delete($node_id, $data['template_name']);

        $date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
        $datetime = $date->format('Y-m-d H:i:s');

        $SQL = self::db()->prepare("UPDATE `bots` SET `state` = :state, `deleted_at` = :deleted_at WHERE `id` = :id");
        $SQL->execute(array(":state" => 'deleted', ":deleted_at" => $datetime, ":id" => $data['id']));
    }

    public function rename($data, $node_id, $bot_name, $bot_id = null)
    {
        $error = null;

        if(is_null($bot_id)){
            $bot_id = $data['bot_id'];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port')."/api/bot/use/".$bot_id."/(/bot/name/".rawurlencode($bot_name));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);
        $resu = json_decode($result);

        if(isset($resu->ErrorMessage)){
            $error = $resu->ErrorMessage;
        }


        if(empty($error)){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port')."/api/bot/use/".$bot_id."/(/settings/set/connect.name/".rawurlencode($bot_name));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close ($ch);
            $resu = json_decode($result);

            if(isset($resu->ErrorMessage)){
                $error = $resu->ErrorMessage;
            }
        }

        if(empty($error)){

            $SQL = self::db()->prepare("UPDATE `bots` SET `bot_name` = :bot_name WHERE `id` = :id");
            $SQL->execute(array(":bot_name" => $bot_name, ":id" => $data['id']));

        } else {
            return $error;
        }

    }

    public function channelCommander($data, $node_id, $state)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port')."/api/bot/use/".$data['bot_id']."/(/bot/commander/".$state);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);
        $resp = json_decode($result);
        //$resp = json_encode($resp);

        if(empty($resp->ErrorMessage)){
            $res = new stdClass();
            $res->state = 'success';
            $res->message->warning = null;
            $res->message->error = null;
            $res->message->success = 'Status gaendert';
            $res = json_encode($res);
            return $res;
        } else {
            $res = new stdClass();
            $res->state = 'error';
            $res->message->warning = null;
            $res->message->error = $resp->ErrorMessage;
            $res->message->success = null;
            $res = json_encode($res);
            return $res;
        }
    }

    public function stopStream($data, $node_id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id,'node_ip') . ":" . Node::getData($node_id, 'port')."/api/bot/use/".$data['bot_id']."/(/stop");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);

        $res = json_decode($result);

        if(empty($res->ErrorMessage)){
            return true;
        } else {
            return $res->ErrorMessage;
        }
    }

    public function changeDefaultChannel($data, $node_id, $channel_id, $start_bot = null)
    {
        if(!(empty($data['bot_id']))){
            Bot::stop($data, $data['id'], $node_id);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port')."/api/settings/bot/set/".$data['template_name']."/connect.channel/%2F".$channel_id."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);
        $res = json_decode($result);

        if(empty($res->ErrorMessage)){
            if($start_bot){
                //sleep(1);
                Bot::start($data, $data['id'], $node_id);
            }

            $SQL = self::db()->prepare("UPDATE `bots` SET `default_channel` = :default_channel WHERE `id` = :id");
            $SQL->execute(array(":default_channel" => $channel_id, ":id" => $data['id']));
        } else {
            return $res->ErrorMessage;
        }
    }

    public function changeChannelPassword($data, $node_id, $channel_password, $start_bot = null)
    {
        if(!(empty($data['bot_id']))){
            Bot::stop($data, $data['id'], $node_id);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://".Node::getData($node_id, 'node_ip') . ":" . Node::getData($node_id, 'port')."/api/settings/bot/set/".$data['template_name']."/connect.channel_password.pw/%2F".$channel_password."/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close ($ch);
        $res = json_decode($result);

        if(empty($res->ErrorMessage)){
            if($start_bot){
                Bot::start($data, $data['id'], $node_id);
            }

            $SQL = self::db()->prepare("UPDATE `bots` SET `channel_password` = :default_password WHERE `id` = :id");
            $SQL->execute(array(":default_password" => $channel_password, ":id" => $data['id']));
        } else {
            return $res->ErrorMessage;
        }
    }

}

?>
