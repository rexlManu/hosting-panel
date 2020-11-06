<?php

$plesk = new PleskWeb;

class PleskWeb extends Controller
{

    public $client;

    public function __construct()
    {
        $this->client = new \PleskX\Api\Client($this->getHost()['ip']);
        $this->client->setCredentials($this->getHost()['name'], $this->getHost()['password']);
    }

    public function getHost()
    {
        $SQL = self::db()->prepare("SELECT * FROM `webspace_host` ORDER BY `id` DESC LIMIT 1;");
        $SQL->execute();
        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    public function createUser($name, $username, $password, $email, $company = null)
    {
       try {
           $customerId = $this->client->customer()->create([
               'cname' => $company,
               'pname' => $name,
               'login' => $username,
               'passwd' => $password,
               'email' => $email,
           ])->id;

           return $customerId;
       } catch (Exception $e) {
           return $e->getMessage();
       }
    }

    public function create($domainName, $ip_addr, $customerId, $username, $password, $planName)
    {
        try {
            $webspaceId = $this->client->webspace()->create(
                [
                    'name' => $domainName,
                    'ip_address' => $ip_addr,
                    'owner-id' => $customerId,
                ],
                [
                    'ftp_login' => $username,
                    'ftp_password' => $password,
                ], $planName
            )->id;

            return $webspaceId;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($webspaceId)
    {
        $this->client->webspace()->delete('id', $webspaceId);
    }

    public function getPrice($planName)
    {
        $SQL = self::db()->prepare("SELECT * FROM `webspace_packs` WHERE `plesk_id` = :plesk_id");
        $SQL->execute(array(":plesk_id" => $planName));
        if($SQL->rowCount() == 1){
            $response = $SQL->fetch(PDO::FETCH_ASSOC);
            return $response['price'];
        } else {
            return false;
        }
    }

    public function getLast()
    {
        $SQL = self::db()->prepare("SELECT * FROM `webspace` ORDER BY `id` DESC LIMIT 1;");
        $SQL->execute();
        $response = $SQL->fetch(PDO::FETCH_ASSOC);

        if(empty($response['id'])){
            return 1;
        }

        return $response['id']+1;
    }

}
