<?php

$manage = new Manage();
class Manage extends Controller
{

    public function songName($data)
    {
        try {
            $response = Request::bot($data,'/song')->Title;
        } catch (Exception $e){
            $response = 'Aktuell läuft kein Song oder Stream';
        }

        return ($response);
    }

}
