<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    use HttpResponses;


    private function hasAuth(Store $store) {
        foreach ($store->admins as $admin) {
            //is owner of the store or admin user
            if ($admin->id == Auth::user()->id) return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StoreResource::collection(
            Store::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StoreResource
     */
    public function store(StoreRequest $request)
    {
        $request->validated($request->all());
        if (!Auth::user()->isOfType('admin')) return $this->authError();
        $store = Store::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude
        ]);

        return new StoreResource($store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return StoreResource
     */
    public function show(Store $store)
    {
        $res = new StoreResource($store);
        if ($this->hasAuth($store) || Auth::user()->isOfType('admin')) return $res;
        else return $this->notFoundError();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        if ($this->hasAuth($store) || Auth::user()->isOfType('admin')) {
            $store->update($request->all());
            return new StoreResource($store);
        } else return $this->authError();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if (!Auth::user()->isOfType('admin')) return $this->authError();
        $store = $store->delete();
        return response(null, 204);
    }
}
