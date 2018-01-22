<?php

class Request
{
	
    private $url;
    private $method;
    
    public function __construct()
    {
       $this->url = $_SERVER["REQUEST_URI"];
       $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public static function uri()
	{
		if (isset($this->url) and !empty($this->url))
            return trim($this->url, '/');
	}
    
    public static function method()
    {
        return $this->method;
    }

}