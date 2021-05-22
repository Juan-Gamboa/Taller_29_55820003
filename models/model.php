<?php

namespace models;

use db\ConexionDB;
use utils\ModelUtil;

class Model extends ModelUtil
{

    protected $table = '';
    protected $namePK = 'id';
    private $childModel = null;

    public function superClass(Model $model)
    {
        $this->childModel = $model;
    }

    public function all()
    {
        $sql = $this->getSql('select', $this->table);
        $connDB = new ConexionDB();
        $resultSQL = $connDB->getReturnSQL($sql);
        $rowData = $this->getDataRows($resultSQL, $this->childModel);
        $connDB->close();
        return  $rowData;
    }

    public function where($conditions = [], $operador = 'and')
    {
        $values = "";
        foreach ($conditions as $condition) {
            $values .= (empty($values) ? '' : " $operador ") . " ($condition[0] $condition[1] '$condition[2]') ";
        }
        $sql = $this->getSql('select', $this->table) . " where $values";
        $connDB = new ConexionDB();
        $resultSQL = $connDB->getReturnSQL($sql);
        $rowData = $this->getDataRows($resultSQL, $this->childModel);
        $connDB->close();
        return  $rowData;
    }

    public function find($id)
    {
        $sql = $this->getSql('select', $this->table) . " where $this->namePK=$id";
        $connDB = new ConexionDB();
        $resultSQL = $connDB->getReturnSQL($sql);
        $rowData = $this->getDataRows($resultSQL, $this->childModel);
        $connDB->close();
        return !empty($rowData) ? $rowData[0] : null;
    }

    public function save()
    {
        $objectModel = $this->childModel;
        $fieldsModel = $this->getDiffFieldsModels(new Model(), $objectModel, [$this->namePK]);
        $values = "";
        foreach ($fieldsModel as $field) {
            $values .= (empty($values) ? '' : ',') . "'" . $objectModel->{$field} . "'";
        }
        $fields = implode(',', $fieldsModel);
        $sql = $this->getSql('insert', $this->table) . " ($fields) values ($values)";
        $connDB = new ConexionDB();
        $resultSQL = $connDB->getReturnSQL($sql);
        $connDB->close();
        return $resultSQL;
    }

    public function update()
    {
        $id = $this->childModel->{$this->namePK};
        $object = $this->find($id);
        if (empty($object)) {
            return false;
        }
        $fieldsModel = $this->getDiffFieldsModels(new Model(), $this->childModel, [$this->namePK]);
        $values = "";
        foreach ($fieldsModel as $field) {
            $values .= (empty($values) ? '' : ',') . " $field='" .  $this->childModel->{$field} . "' ";
        }
        $sql = $this->getSql('update', $this->table) . " $values where $this->namePK=$id";
        $connDB = new ConexionDB();
        $resultSQL = $connDB->getReturnSQL($sql);
        $connDB->close();
        return $resultSQL;
    }

    public function delete()
    {
        $id = $this->childModel->{$this->namePK};
        $object = $this->find($id);
        if (empty($object)) {
            return false;
        }
        $sql = $this->getSql('delete', $this->table) . " where $this->namePK=$id";
        $connDB = new ConexionDB();
        $resultSQL = $connDB->getReturnSQL($sql);
        $connDB->close();
        return $resultSQL;
    }

    public function getFields(){
        $fieldsModel = $this->getDiffFieldsModels(new Model(), $this->childModel);
        return $fieldsModel;
    }
}
