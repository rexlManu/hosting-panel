<?php

$request = new Request();

class Request extends Controller
{

    public function getClient($node_id) : \GuzzleHttp\Client
    {
        return new \GuzzleHttp\Client([
            'allow_redirects' => false,
            'timeout' => 5,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.base64_encode(Node::getData($node_id, 'unique_id') . ':' . Node::getData($node_id, 'token'))
            ]
        ]);
    }

    /**
     * @param $data
     * @param $action
     * @return mixed
     */
    public function bot($data, $action)
    {
        $response = self::getClient($data['node_id'])->get("http://" . Node::getData($data['node_id'],'node_ip') . ":" . Node::getData($data['node_id'],'port') . "/api/bot/use/" . $data['bot_id'] . "/(".$action)->getBody();
        return json_decode($response);
    }

    /**
     * @param $data
     * @param $action = connect.address
     * @param $value
     * @return mixed
     */
    public function setting($data, $action, $value)
    {
        // connect.address
        $response = self::getClient($data['node_id'])->get("http://" . Node::getData($data['node_id'],'node_ip') . ":" . Node::getData($data['node_id'],'port') . "/api/settings/bot/set/".$data['template_name']."/".$action."/".$value)->getBody();
        return json_decode($response);
    }

    public function create($node_id, $name)
    {
        $response = self::getClient($node_id)->get("http://" . Node::getData($node_id,'node_ip') . ":" . Node::getData($node_id,'port') . "/api/settings/create/".$name)->getBody();
        return json_decode($response);
    }

    public function delete($node_id, $name)
    {
        $response = self::getClient($node_id)->get("http://" . Node::getData($node_id,'node_ip') . ":" . Node::getData($node_id,'port') . "/api/settings/delete/".$name)->getBody();
        return json_decode($response);
    }

}
