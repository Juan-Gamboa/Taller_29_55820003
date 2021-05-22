<?php

namespace api;

class ParseArrayResponse
{
    private function getArrayDataModel($data)
    {
        $dataReturn = [];
        foreach ($data as $model) {
            $element = $this->getArrayModel($model);
            if (count($element) > 0) {
                array_push($dataReturn, $element);
            }
        }
        return $dataReturn;
    }

    private function getArrayModel($model)
    {
        $element = [];
        $keys = $model->getFields();
        foreach ($keys as $key) {
            $element[$key] = $model->get($key);
        }
        return $element;
    }

    protected function toArray($data, $type = 'index')
    {
        if ($type == 'index') {
            return $this->getArrayDataModel($data);
        } else if ($type == 'model') {
            return $this->getArrayModel($data);
        } else {
            return $data;
        }
    }
}
