<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Response;


class ProductController extends Controller
{
public function index()
{
    $products = Product::all();

    if($products->count() > 0)
    {
        return response()->json([
        
            'status'=> 200,
        
            'message'=>$products
        ],200);
}else{
    return response()->json([
        'status'=> 404,
        'message'=>'no record found'
    ],404);
}
}


public function store(Request $request)
{
    $validator = validator::make($request->all(),[
        'productname'=> 'required|string|max:191',
        'description' => 'required|string|max:191',
        'quantity' => 'required|string|max:191',
        'weight' => 'required|string|max:191',
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=> 422,
            'error' => $validator->messages()
        ],422);
    }else{
        $product =product::create([
            'productname' => $request->productname,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
        ]);
        if($product){
            return response()->json([
                'status'=> 200,
        
            'message'=> "product Create Successfully"
            ],200);
        }else{
            return response()->json([
                'status'=> 500,
        
            'message'=> "something went wrong"
            ],500);
        }
    }

}

public function show($id)
{
    $product = product::find($id);
    if ($product){
        return response()->json([
            'status'=> 200,
    
        'message'=>  $product
        ],200);

    }else{
        return response()->json([
            'status'=> 404,
    
        'message'=> "no product find"
        ],404);
    }
}

public function edit($id) {


    $product = product::find($id);
    if ($product){
        return response()->json([
            'status'=> 200,
    
        'message'=>  $product
        ],200);

    }else{
        return response()->json([
            'status'=> 404,
    
        'message'=> "no product find"
        ],404);

}
}
public function update(Request $request, int $id) {

    $validator = validator::make($request->all(),[
        'productname'=> 'required|string|max:191',
        'description' => 'required|string|max:191',
        'quantity' => 'required|string|max:191',
        'weight' => 'required|string|max:191',
    ]);
    if($validator->fails()){
        return response()->json([
            'status'=> 422,
            'error' => $validator->messages()
        ],422);
    }else{

        $product =product::find($id);
       
        if($product){

            $product ->update([
                'productname' => $request->productname,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'weight' => $request->weight,
            ]);
            return response()->json([
                'status'=> 200,
        
            'message'=> "product Updated Successfully"
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
        
            'message'=> "No Such Product Find"
            ],404);
        }

}

}

public function destory($id){
$product = product::find($id);
if ($product){
    $product->delete();
    return response()->json([
        'status'=> 200,

    'message'=> "Product Deleted Successfull"
    ],200);

}else{
    return response()->json([
        'status'=> 404,

    'message'=> "No Such Product Find"
    ],404);

}
}
  
}
