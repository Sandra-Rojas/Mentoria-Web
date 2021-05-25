<?php

namespace app\core;

class Response
{

    //manejar error 200 y 404
    public function setStatusCode(int $code)
    {

        http_response_code($code);
    }

}