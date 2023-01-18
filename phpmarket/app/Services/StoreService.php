<?php

namespace App\Services;

use App\Interfaces\StoreRepository;
use App\Interfaces\UserRepository;
use App\Repositories\EloquentUserRepository;

class StoreService
{
    protected $storeRepository;
    protected $userRepository;

    public function __construct(StoreRepository $storeRepository, UserRepository $userRepository) {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
    }
    public function storeExists($id) {
        return !is_null($this->storeRepository->getById($id));
    }
    public function getStore($id) {
        return $this->storeRepository->getById($id);
    }
    public function getAllStores() {
        return $this->storeRepository->getAll();
    }

    public function createStore($name, $address, $longitude, $latitude) {
        return $this->storeRepository->create($name, $address, $longitude, $latitude);
    }

    public function updateStore($id, $request) {
        return $this->storeRepository->update($id, $request);
    }

    public function deleteStore($id) {
        $this->storeRepository->delete($id);
    }

    public function userHasPermission($user_id, $store_id) {
        if ($this->userRepository->getById($user_id)->isOfType('admin')) return true;
        foreach ($this->storeRepository->getById($store_id)->admins as $admin) {
            if ($admin->id == $user_id) return true;
        }
        return false;
    }








}
