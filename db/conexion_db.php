<?php

namespace  db;

use mysqli;

class ConexionDB
{
    private $servidor = 'localhost:3306';
    private $nombreDB = 'taller_29';
    private $usuarioDB = 'root';
    private $passwordDB = '';

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servidor, $this->usuarioDB, $this->passwordDB, $this->nombreDB);
    }

    public function getReturnSQL($sql)
    {
        return $this->conn->query($sql);
    }

    public function close()
    {
        $this->conn->close();
    }
}
