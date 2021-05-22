<?php

namespace api;

class Response extends ParseArrayResponse
{


    public static function toArrayJson($data, $type = '')
    {
        $rows = (new Response())->toArray($data, $type);
        return json_encode(['data' => $rows]);
    }
}
