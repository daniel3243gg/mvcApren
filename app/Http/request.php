<?php 
namespace App\Http;


class Request{
    private $httpMethod;

    private $uri;

    private $queryParams = [];

    private $postVars=[];

    private $headers = [];

    public function __construct() {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function getHttpMethod(){

        return $this->httpMethod;
    }
    public function geturi(){

        return $this->uri;
    }
    public function getqueryParams(){

        return $this->queryParams;
    }
    public function getpostVars(){

        return $this->postVars;
    }
    public function getheaders(){

        return $this->headers;
    }
}
