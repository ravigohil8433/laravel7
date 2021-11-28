<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Category;
use App\Libraries\MCrypt;

class CategoryController extends Controller
{
    /**
     * List all categories with sub categories to N level
     */
    public function index(Request $request)
    {
        $categories = Category::with('childrenRecursive')->where('parent_id',0)->get();
        return response()->json([
            'data' => $categories,
        ]);
    }

    /**
     * Create new category/sub category
     * @param  [string] title
     * @param  [integer] parent_id
     * @return [object] category object
     */
    public function create(Request $request)
    {
        $crypt = new MCrypt();
        $request->validate([
            'title' => 'required|string'
        ]);
        $input = $request->all();

        $input['parent_id'] = empty($input['parent_id']) ? 0 :  $crypt->decrypt($input['parent_id']);
        $input['title'] = empty($input['title']) ? 0 :  $crypt->decrypt($input['title']);

        $category = Category::create($input);
        return response()->json([
            'message' =>'New Category added successfully',
            'data' => $category,
        ]);
    }

    /**
     * Delete category/sub category
     * @param  [integer] id
     */
    public function delete(Request $request)
    {
        $crypt = new MCrypt();
        $request->validate([
            'id' => 'required'
        ]);
        $input = $request->all();

        $input['id'] = empty($input['id']) ? 0 :  $crypt->decrypt($input['id']);

        Category::where('id',$input['id'])->delete();
        return response()->json([
            'message' =>'Category removed successfully',
        ]);
    }

}
