<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return $this->sendResponse(CategoryResource::collection($category), __('category.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();

        if (!$category->validate($request->all())) {
            return $this->sendError(__('auth.sign_up-error'), $category->errors);
        }

        $input = $request->all();
        $post = Category::create($input);

        return $this->sendResponse(new CategoryResource($post) , __('category.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if (is_null($category)) {
            return $this->sendError(__('event.show-error'));
        }
        return $this->sendResponse(new CategoryResource($category), __('category.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (!$category->validate($request->all())) {
            return $this->sendError($category->errors);
        }

        $input = $request->all();
        $category->slug = null;
        $category->title = $input['title'];
        $category->save();

        return $this->sendResponse(new CategoryResource($category), __('category.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse([], __('category.destroy'));
    }
}
