<?php

namespace App\Http\Controllers;

use App\Http\HttpResponses;
use App\Http\Requests\product\ProductCreateRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\StoreService;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use HttpResponses;
    protected ProductService $productService;
    protected StoreService $storeService;

    public function __construct(ProductService $productService, StoreService $storeService) {
        $this->productService = $productService;
        $this->storeService = $storeService;
    }

    private function hasAuth($store_id) {
        foreach (Auth::user()->stores as $store) {
            //is owner of the store or admin user
            if ($store->id == $store_id) return true;
        }
        return false;
    }


    public function show($id)
    {
        if (!$this->productService->exists($id)) return $this->notFoundError();
        else return new ProductResource($this->productService->getProduct($id));
    }


    public function store(ProductCreateRequest $request)
    {
        $request->validated($request->all());
        if (!$this->hasAuth($request->store_id) && !Auth::user()->isOfType('admin')) return $this->notFoundError();
        $product = $this->productService->createProduct($request->store_id, $request->name, $request->bin, $request->quantity);
        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $request->validated($request->all());
        if (!$this->productService->exists($id)) return $this->notFoundError();
        $product = $this->productService->getProduct($id);
        if (!$this->hasAuth($product->store_id) && !Auth::user()->isOfType('admin')) return $this->notFoundError();
        $product = $this->productService->updateProduct($id, $request);
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        if (!Auth::user()->isOfType('admin') && !$this->hasAuth($product->store_id)) return $this->authError();
        $product = $product->delete();
        return response(null, 204);
    }
}
