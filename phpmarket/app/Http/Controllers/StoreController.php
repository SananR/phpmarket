<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreateRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Services\StoreService;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    use HttpResponses;
    protected StoreService $service;

    public function __construct(StoreService $service)
    {
        $this->service = $service;
    }

    private function getAuthUser() {
        return Auth::user();
    }

    public function index()
    {
        return StoreResource::collection(
            $this->service->getAllStores()
        );
    }

    public function store(StoreCreateRequest $request)
    {
        $request->validated($request->all());
        if (!$this->getAuthUser()->isOfType('admin')) return $this->authError();
        $store = $this->service->createStore($request->name, $request->address, $request->longitude, $request->latitude);
        return new StoreResource($store);
    }

    public function show(Store $store)
    {
        $res = new StoreResource($store);
        if ($this->service->userHasPermission($this->getAuthUser()->id, $store->id)) return $res;
        else return $this->notFoundError();
    }
    public function update(StoreUpdateRequest $request, Store $store)
    {
        $request->validated($request->all());
        if ($this->service->userHasPermission($this->getAuthUser()->id, $store->id)) {
            $store = $this->service->updateStore($store->id, $request);
            return new StoreResource($store);
        } else return $this->authError();
    }
    public function destroy(Store $store)
    {
        if (!$this->getAuthUser()->isOfType('admin')) return $this->authError();
        $this->service->deleteStore($store->id);
        return response(null, 204);
    }
}
