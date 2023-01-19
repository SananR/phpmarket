<?php

namespace App\Services;

use App\Interfaces\BaseService;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;

class StoreService extends BaseService
{
    protected $userRepository;

    public function __construct(StoreRepository $storeRepository, UserRepository $userRepository) {
        parent::__construct($storeRepository);
        $this->userRepository = $userRepository;
    }
    public function getStore($id) {
        return parent::get($id);
    }

    public function createStore($name, $address, $longitude, $latitude) {
        return $this->repository->create($name, $address, $longitude, $latitude);
    }

    public function updateStore($id, $request) {
        return $this->repository->update($id, $request);
    }

    public function deleteStore($id) {
        $this->repository->delete($id);
    }

    public function userHasPermission($user_id, $store_id) {
        if ($this->userRepository->getById($user_id)->isOfType('admin')) return true;
        foreach ($this->repository->getById($store_id)->admins as $admin) {
            if ($admin->id == $user_id) return true;
        }
        return false;
    }








}
