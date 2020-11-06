<?php

$node = new Node();

class Node extends Controller
{

    public function getData($node_id, $data)
    {
        $SQL = self::db()->prepare("SELECT * FROM `bot_nodes` WHERE `id` = :id");
        $SQL->execute(array(":id" => $node_id));
        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response[$data];
    }

    public function getCount()
    {
        $SQL = self::db()->prepare("SELECT * FROM `bot_nodes` WHERE `user_id` IS NULL AND `state` = 'active';");
        $SQL->execute();

        return $SQL->rowCount();
    }

    public function getBotCountFromNode($node_id)
    {
        $SQL = self::db()->prepare("SELECT * FROM `bots` WHERE `node_id` = :node_id AND `deleted_at` IS NULL;");
        $SQL->execute(array(":node_id" => $node_id));

        return $SQL->rowCount();
    }

}
?>
