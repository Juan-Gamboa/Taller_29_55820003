<?php

namespace controllers;

use controllers\BaseController;
use models\Entradas;

class EntradasController extends BaseController
{
    public function index()
    {
        $model = new Entradas();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Entradas();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Entradas();
        $data = $modelValidation->where([
            ['objecto_inventario_id', '=', $request['objecto_inventario_id']]
        ]);
        if (count($data) > 0) {
            return "El objeto ya se encuentra registrado";
        }

        $model = new Entradas();
        $model->set('fecha', $request['fecha']);
        $model->set('cantidad',  $request['cantidad']);
        $model->set('persona_id',  $request['persona_id']);
        $model->set('objecto_inventario_id',  $request['objecto_inventario_id']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Entradas();
        $data = $modelValidation->where([
            ['objecto_inventario_id', '=', $request['objecto_inventario_id']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El objeto ya se encuentra registrado";
        }

        $model = new Entradas();
        $model->set('id', $id);
        $model->set('fecha', $request['fecha']);
        $model->set('cantidad',  $request['cantidad']);
        $model->set('persona_id',  $request['persona_id']);
        $model->set('objecto_inventario_id',  $request['objecto_inventario_id']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new Entradas();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
