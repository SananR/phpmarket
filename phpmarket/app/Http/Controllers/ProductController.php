<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Store;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use HttpResponses;

    private function hasAuth($store_id) {
        foreach (Auth::user()->stores as $store) {
            //is owner of the store or admin user
            if ($store->id == $store_id) return true;
        }
        return false;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($id)
    {
        $product = Product::where('id',$id);
        if (!$product->exists()) return $this->notFoundError();
        $store = Store::where('id', $product->store_id);
        if (!$store) return $this->notFoundError();
        if (!$store->first()->isAdmin(Auth::user()->id)) return $this->notFoundError();
        if (!$store->first()->isAdmin(Auth::user()->id) && !Auth::user()->isOfType('admin')) return $this->authError();
        else return ProductResource::collection(
            $product->first()
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ProductResource
     */
    public function store(ProductRequest $request)
    {
        $request->validated($request->all());
        if (!$this->hasAuth($request->store_id) && !Auth::user()->isOfType('admin')) return $this->authError();
        if (!Store::where('id', $request->store_id)->exists()) return $this->notFoundError();
        $product = Product::create([
            'store_id'=>$request->store_id,
            'name'=>$request->name,
            'bin'=>$request->bin,
            'quantity'=>$request->quantity
        ]);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($this->hasAuth($product->store_id) || Auth::user()->isOfType('admin')) {
            $product->update($request->all());
            return new ProductResource($product);
        } else return $this->authError();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!Auth::user()->isOfType('admin') && !$this->hasAuth($product->store_id)) return $this->authError();
        $product = $product->delete();
        return response(null, 204);
    }
}
