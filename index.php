<?php

require 'config.php';

/**
 *
 */
class IftttProxy
{
    private $key;

    public function __construct()
    {
        global $config;
        $this->key = $config['ifttt_key'];
    }

    public function make_request($event)
    {
        $url = 'https://maker.ifttt.com/trigger/' . $event . '/json/with/key/' . $this->key;

        // TODO: data from param
        $data = array("value1" => "1","value2" => "2","value3"=>"3");

        $postdata = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        print_r($result);
        // header('Content-Type: application/json; charset=utf-8');
        // echo json_encode($result);
    }
}

// TODO: json body params

$IftttProxy = new IftttProxy($config['ifttt_key']);
$IftttProxy->make_request('open_gate');
