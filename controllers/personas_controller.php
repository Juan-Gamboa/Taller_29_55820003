<?php

namespace controllers;

use controllers\BaseController;
use models\Personas;

class PersonasController extends BaseController
{
    public function index()
    {
        $model = new Personas();
        $rows =  $model->all();
        return $rows;
    }

    public function detail($id)
    {
        $model = new Personas();
        $row =  $model->find($id);
        return $row;
    }

    public function create($request)
    {
        $modelValidation = new Personas();
        $data = $modelValidation->where([
            ['numero_identificacion', '=', $request['numero_identificacion']]
        ]);
        if (count($data) > 0) {
            return "El numero identificación ya se encuentra registrado";
        }

        $model = new Personas();
        $model->set('tipo_identificacion', $request['tipo_identificacion']);
        $model->set('numero_identificacion',  $request['numero_identificacion']);
        $model->set('nombres',  $request['nombres']);
        $status = $model->save();
        return $status ? 'Registro guardado' : 'Error al guardar el registro';
    }

    public function update($id, $request)
    {

        $modelValidation = new Personas();
        $data = $modelValidation->where([
            ['numero_identificacion', '=', $request['numero_identificacion']],
            ['id', '<>', $id]
        ]);
        if (count($data) > 0) {
            return "El numero identificación ya se encuentra registrado";
        }

        $model = new Personas();
        $model->set('id', $id);
        $model->set('tipo_identificacion', $request['tipo_identificacion']);
        $model->set('numero_identificacion',  $request['numero_identificacion']);
        $model->set('nombres',  $request['nombres']);
        $status = $model->update();
        return $status ? 'Registro actualizado' : 'Error al actualizar el registro';
    }

    public function delete($id)
    {
        $model = new Personas();
        $model->set('id', $id);
        $status = $model->delete();
        return $status ? 'Registro eliminado' : 'Error al eliminar el registro';
    }
}
