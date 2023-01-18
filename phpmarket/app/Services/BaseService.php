<?php

namespace App\Services;

use App\Interfaces\BaseRepository;

abstract class BaseService {

    protected BaseRepository $repository;

    protected function __construct(BaseRepository $repository) {
        $this->repository = $repository;
    }
    public function exists($id) {
        return $this->repository->exists($id);
    }
    protected function get($id) {
        return $this->repository->getById($id);
    }
    public function getAll() {
        return $this->repository->getAll();
    }
    protected function update($id, $request) {
        return $this->repository->update($id, $request);
    }
    protected function delete($id) {
        $this->repository->delete($id);
    }


}
