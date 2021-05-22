<?php

namespace controllers;

use \Exception;

interface IController
{
    public function index();
    public function detail($id);
    public function create($request);
    public function update($id, $request);
    public function delete($id);
}


class BaseController implements IController
{
    public function __construct()
    {
        //code
    }

    public function index()
    {
        throw new Exception('El método index no esta defino');
    }

    public function detail($id)
    {
        throw new Exception('El método detail no esta defino');
    }

    public function create($request)
    {
        throw new Exception('El método create no esta defino');
    }

    public function update($id, $request)
    {
        throw new Exception('El método update no esta defino');
    }

    public function delete($id)
    {
        throw new Exception('El método delete no esta defino');
    }
}
