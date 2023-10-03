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
        $category = Category::latest()->paginate(5);

        return new ApiResource(true, 'List Data Kategori', $category);
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

        // return response 
        return new ApiResource(true, 'Data Kategori Berhasil Di tambhakan!', $category);
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

        return new ApiResource(true, 'Data Kategori Berhasil Di Update!', $category);
    }

    public function destroy(Category $category){
        $category->delete();

        return new ApiResource(true, 'Data Kategori Berhasil Di Hapus!', $category);
    }
}
