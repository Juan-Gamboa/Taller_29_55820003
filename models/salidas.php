<?php

namespace models;

use models\Model;

class Salidas extends Model
{
    protected $id;
    protected $fecha;
    protected $cantidad;
    protected $persona_id;
    protected $objecto_inventario_id;

    public function __construct()
    {
        $this->superClass($this);
        $this->table = 'salidas';
    }
}