<?php

class BaseController 
{
    protected string $errorDescription = "";
    protected string $errorHeader;
    protected string $responseData = "";
    protected string $successStatusCode = "200 OK";

    public function authorizeAdmin() {
        if (isset($_SESSION["role"]) && $_SESSION["role"] == "ADMIN") {
            return;
        }
        else {
            $this->sendOutput(json_encode(array("message" => "You're not authorized to call this endpoint.")), 
                array("Content-Type: application/json", "HTTP/1.1 401 Unauthorized"));
        }
    }

    public function notFound() 
    {
        $responseData = json_encode(array("error" => "The endpoint: " . 
            strtoupper($_SERVER["REQUEST_METHOD"]) . 
            " " . $_SERVER["REQUEST_URI"] . " does not exist."));
            
        $this->sendOutput($responseData, array("Content-Type: application/json", "HTTP/1.1 404 Not Found"));
    }

    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $uri = explode("/", $uri);
        
        return $uri;
    }

    protected function getQueryStringParams(&$array)
    {
        return parse_str($_SERVER["QUERY_STRING"], $array);
    }

    protected function handleResponse()
    {
        if (!$this->errorDescription) 
        {
            $this->sendOutput($this->responseData, array("Content-Type: application/json", "HTTP/1.1 " . $this->successStatusCode));
        }
        else 
        {
            $this->sendOutput(json_encode(array("error" => $this->errorDescription)),
                array("Content-Type: application/json", $this->errorHeader));
        }
    }

    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }
}

?>