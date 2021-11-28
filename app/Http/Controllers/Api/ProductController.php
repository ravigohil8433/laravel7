<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Libraries\MCrypt;

class ProductController extends Controller
{
    /**
     * List all products with assigned category
     */
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate();
        return response()->json([
            'data' => $products,
        ]);
    }

    /**
     * Create new product
     * @param  [string] name
     * @param  [string] description
     * @param  [integer] category_id
     * @return [object] product object
     */
    public function create(Request $request)
    {
        $crypt = new MCrypt();
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);
        $input = $request->all();

        $input['category_id'] = empty($input['category_id']) ? 0 :  $crypt->decrypt($input['category_id']);
        $input['name'] = empty($input['name']) ? 0 :  $crypt->decrypt($input['name']);
        $input['description'] = empty($input['description']) ? 0 :  $crypt->decrypt($input['description']);

        $product = Product::create($input);
        return response()->json([
            'message' =>'New Product added successfully',
            'data' => $product,
        ]);
    }

    /**
     * Delete product
     */
    public function delete(Request $request)
    {
        $crypt = new MCrypt();
        $request->validate([
            'id' => 'required'
        ]);
        $input = $request->all();

        $input['id'] = empty($input['id']) ? 0 :  $crypt->decrypt($input['id']);

        Product::where('id',$input['id'])->delete();
        return response()->json([
            'message' =>'Product removed successfully',
        ]);
    }
}
