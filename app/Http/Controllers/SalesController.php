<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Product;
use App\Sale;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function index()
    {
        return Sale::latest()->get();

    }

    public function store(SaleRequest $request)
    {
        $sale = new Sale();
        $user = $request->user();
        $attrs = array_merge($request->all(), $user->toArray());
        $products = Product::select(['id','name','price','category','image_principal'])->whereIn('id', $attrs['products'])
                ->get();
        $total = 0;
        foreach ($products as $prod){
            $total += floatval($prod['price']);
        }
        $sale->fill(array_merge($attrs,[
            'user_id'=> $user->getKey(),
            'status' => 'pending',
            'products' => json_encode($products),
            'total' => $total,
        ]));
        $sale->save();
        return $sale;
    }


    public function show($id)
    {
        $sale = Sale::find($id);
        if (!$sale){
            throw new ModelNotFoundException();
        }
        return $sale;
    }

    public function changeStatus($id, $status)
    {
        $sale = Sale::find($id);
        if (!$sale){
            throw new ModelNotFoundException();
        }
        $sale->fill(['status'=>$status]);
        $sale->save();
        return $sale;
    }


    public function destroy($id)
    {
        $sale = Sale::find($id);
        if (!$sale){
            throw new ModelNotFoundException();
        }
        $sale->delete();
        return ["deleted"=>"ok"];
    }


    public function my_sales(Request $request)
    {
        $user = $request->user();
        $user_id = $user->getKey();
        return Sale::where('user_id', $user_id)->get();
    }
}
