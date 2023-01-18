<?php

namespace App\Interfaces;

use App\Models\Store;

abstract class BaseRepository
{
    protected $modelORM;

    function __call($name, $args) {
        if ($name == 'create') {
            if (count($args) == 1) return $this->modelORM::create($args[0]);
        }
    }

    protected function __construct($modelORM) {
        $this->modelORM = $modelORM;
    }
    public function where($condition, $value) {
        $query = $this->modelORM::where($condition, $value);
        return $query->get();
    }
    public function getAll() {
        return $this->modelORM::all();
    }
    public function getById($id) {
        return $this->modelORM::find(intval($id));
    }
    public function delete($id) {
        $this->modelORM::destroy($id);
    }
    public function update($id, $request) {
        $model = $this->modelORM::where('id', $id)->get()->first();
        $model->update($request == null ? [] : $request);
        return $model;
    }
}
