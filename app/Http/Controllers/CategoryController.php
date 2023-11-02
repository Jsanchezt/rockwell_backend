<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): CategoryResource
    {
        return new CategoryResource(Category::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return Category::create($request->all());
    }


    /**
     * Show the specified resource from storage.
     */
    public function show($category_id)
    {
        $category = Category::find($category_id);
        if (!$category){
            throw new ModelNotFoundException();
        }
        return $category;
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
