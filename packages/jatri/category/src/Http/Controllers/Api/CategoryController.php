<?php

namespace Jatri\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Jatri\Models\Category;
use Illuminate\Support\Str;
use Jatri\Http\Requests\CategoryRequest;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController{
    /**
     * Method for store the category information
     */
    public function store(CategoryRequest $request){

        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();
        try {
            Category::create($validated);
        }catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
                'success' => true,
                'message' => 'Category created successfully!',
            ], 201);
    }
    /**
     * Method for update the category information
     */
    public function update(CategoryRequest $request){
        $validated = $request->validated();
        
        $category   = Category::where('slug',$request->slug)->first();
        if(!$category){
            return response()->json([
                'success' => false,
                'message' => 'Sorry! Category not found.',
            ], 500);
        }       
        
        try{
            $category->update($validated); 
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
        ], 201);
    }
    /**
     * Method for delete the category information
     */
    public function delete(Request $request){
        $slug       = $request->slug;
        $data       = Category::where('slug',$slug)->first();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Sorry! Category not found.',
            ], 500);
        }
        
        try{
            $data->delete(); 
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category: ' . $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!',
        ], 201);
    }

}