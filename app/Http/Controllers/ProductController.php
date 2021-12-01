<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list()
    {
        try {
            $products = Product::all();
            return response()->json(['status' => true, 'products' => $products->toArray()]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required'
            ], [
                'name.required' => 'please add platform',
                'description.required' => 'Please add description'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
            }

            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->save();
            return response()->json(['status' => true, 'message' => 'data saved']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function item($id) {
        try {
            $products = Product::find($id);
            return response()->json(['status' => true, 'product' => $products]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errMessage' => $e->getMessage()]);
        }
    }

    public function updateItem($id, Request $request)
    {
        try {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->save();
            return response()->json(['status' => true, 'message' => 'date updated']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errMessage' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            return response()->json(['status' => true, 'message' => 'data product deleted']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
