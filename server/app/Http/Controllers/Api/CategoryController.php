<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    public function index(){
        $category = Category::latest()->get();
        return response()->json(['data' => $category]);
    }

    public function show(Category $category){
        return response()->json([
            'success' => true,
            'message' => 'List data Category',
            'data' => $category
        ], 200
        );
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'category'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'category' => $request->category
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Berhasil Di tambhakan!',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, Category $category){

        $validator = Validator::make($request->all(), [
            'category'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category->update([
            'category' => $request->category
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Berhasil Di Update!',
            'data' => $category
        ], 200);
    }

    public function destroy(Category $category){
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Kategori Berhasil Di Hapus!',
            'data' => $category
        ], 200);
    }
}
