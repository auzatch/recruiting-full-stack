<?php
/*

TODO:

If your system has PHP installed, you can easily test this script by using PHP's
built-in web server:

$ php -S localhost:8000 -t src/php/

You can then fetch() this script in JavaScript with the following URL:
http://localhost:8000/webservice.php

*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Allow-Headers: Content-Type");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new DataController($requestMethod);
$controller->processRequest();

class DataController {
    private $requestMethod;

    public function __construct($requestMethod) {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getData();
                break;
            case 'POST':
                break;
            default:
                echo 'Error';
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getData() {
        $json = file_get_contents("../data/testdata.json", true);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($json);
        return $response;
    }
}

// echo 'Hello';
