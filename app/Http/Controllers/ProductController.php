<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceSort;
use App\Category;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProductResource(Product::all());
    }

    /**
     * Display a listing of the resource.
     */
    public function index_available()
    {
        return Product::select(['id','name','brand','price','image_principal'])->where('available', "1")->get();
      
    }


    /**
     * Display a listing of the resource.
     */
    public function best_seller()
    {
        return new ProductResource(Product::where('available', "1")->where('best_seller', "1")->get());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $product = new Product();
            $product->fill($data);
            $product->save();
            return $product;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }


    /**
     * Show the specified resource from storage.
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);
        if (!$product){
            throw new ModelNotFoundException();
        }
        return $product;
    }


    /**
     * Show the specified resource from storage.
     */
    public function update(Request $request, $product_id)
    {
        $attributes = $request->all();
        $product = Product::find($product_id);
        if (!$product){
            throw new ModelNotFoundException();
        }
        $product->fill($attributes);
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        if (!$category){
            throw new ModelNotFoundException();
        }
        $category->delete();
        return ["deleted"=>"ok"];
    }
}
