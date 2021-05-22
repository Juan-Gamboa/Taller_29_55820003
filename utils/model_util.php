<?php
namespace utils;

class ModelUtil
{

    public function get($nameField)
    {
        return $this->{$nameField};
    }

    public function set($nameField, $val)
    {
        $this->{$nameField} = $val;
    }

    protected function getSql($type, $table)
    {
        if ($type == 'select') {
            return "select * from $table ";
        } else if ($type == 'insert') {
            return "insert into $table ";
        } else if ($type == 'update') {
            return "update $table set ";
        } else if ($type == 'delete') {
            return "delete from $table ";
        }
    }

    protected function getDataRows($data, $model)
    {
        $rowData = [];
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $keys = array_keys($row);
                $instancia = get_class($model);
                $object = new $instancia();
                foreach ($keys as $key) {
                    $object->set($key, $row[$key]);
                }
                array_push($rowData, $object);
            }
        }
        return  $rowData;
    }

    public function getFieldsClassModel($class)
    {
        return array_keys(get_class_vars(get_class($class)));
    }

    public function getDiffFieldsModels($parentClass, $chieldClass, $removeFields = [])
    {
        $model = $this->getFieldsClassModel($parentClass);
        $chModel = $this->getFieldsClassModel($chieldClass);
        $result = array_diff($chModel, $model);
        return array_diff($result, $removeFields);
    }
}
