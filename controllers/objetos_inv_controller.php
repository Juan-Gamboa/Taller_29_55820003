<?php

namespace controllers;

use controllers\BaseController;
use models\Objetos;

class ObjetosController extends BaseController
{
    public function index()
    {
        $model = new Objetos();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Objetos();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Objetos();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']]
        ]);
        if (count($data) > 0) {
            return "El nombre ya se encuentra registrado";
        }

        $model = new Objetos();
        $model->set('nombre', $request['nombre']);
        $model->set('descripcion',  $request['descripcion']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Objetos();
        $data = $modelValidation->where([
            ['nombre', '=', $request['nombre']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El nombre ya se encuentra registrado";
        }

        $model = new Objetos();
        $model->set('id', $id);
        $model->set('nombre', $request['nombre']);
        $model->set('descripcion',  $request['descripcion']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new Objetos();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}