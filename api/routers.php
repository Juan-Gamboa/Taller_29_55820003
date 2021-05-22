<?php

namespace api;

require_once dirname(__DIR__) . '/api/config.php';

class Routers
{

    public static function get()
    {
        $url = $GLOBALS['getArrayUrlCurrent']();
        $uriClass = $GLOBALS['uriClass'][$url[0]];
        $namespaceController = $GLOBALS['controllers'][$url[0]];

        require_once dirname(__DIR__) . '/' .  $uriClass['model'];
        require_once dirname(__DIR__) . '/' .  $uriClass['controller'];

        // if (!class_exists($namespaceController)) {
        //     return null;
        // }
        $instancia = new $namespaceController;
        if (count($url) > 1) {
            return Response::toArrayJson($instancia->detail($url[1]), 'model');
        }
        return Response::toArrayJson($instancia->index(), 'index');
    }

    public static function post()
    {
        $url = $GLOBALS['getArrayUrlCurrent']();
        $uriClass = $GLOBALS['uriClass'][$url[0]];
        $classController = $GLOBALS['controllers'][$url[0]];

        require_once dirname(__DIR__) . '/' .  $uriClass['model'];
        require_once dirname(__DIR__) . '/' .  $uriClass['controller'];

        $instancia = new $classController;
        $data = $_POST;
        return Response::toArrayJson($instancia->create($data));
    }

    public static function put()
    {
        $url = $GLOBALS['getArrayUrlCurrent']();
        $uriClass = $GLOBALS['uriClass'][$url[0]];
        $classController = $GLOBALS['controllers'][$url[0]];

        require_once dirname(__DIR__) . '/' .  $uriClass['model'];
        require_once dirname(__DIR__) . '/' .  $uriClass['controller'];

        $instancia = new $classController;
        parse_str(file_get_contents("php://input"), $put_vars);
        return Response::toArrayJson($instancia->update($url[1], $put_vars));
    }

    public static function delete()
    {
        $url = $GLOBALS['getArrayUrlCurrent']();
        $uriClass = $GLOBALS['uriClass'][$url[0]];
        $classController = $GLOBALS['controllers'][$url[0]];

        require_once dirname(__DIR__) . '/' .  $uriClass['model'];
        require_once dirname(__DIR__) . '/' .  $uriClass['controller'];

        $instancia = new  $classController;
        return Response::toArrayJson($instancia->delete($url[1]));
    }



    public static function response($method)
    {
        header('Content-type: application/json;charset=utf-8');
        switch ($method) {
            case 'GET':
                http_response_code(200);
                echo Routers::get();
                break;
            case 'POST':
                http_response_code(200);
                echo Routers::post();
                break;
            case 'PUT':
                http_response_code(200);
                echo Routers::put();
                break;
            case "DELETE":
                http_response_code(200);
                echo Routers::delete();
                break;
            default:
                header('HTTP/1.1 405 Method not allowed');
                header('Allow: GET, POST, PUT, DELETE');
                http_response_code(405);
                echo json_encode(['msg' => 'Not found']);
                break;
        }
    }
}
