<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Tag as TagResource;

class TagController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Tag::all();
        return $this->sendResponse(TagResource::collection($category), __('tag.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tag = new Tag();

        if (!$tag->validate($request->all())) {
            return $this->sendError(__('auth.sign_up-error'), $tag->errors);
        }

        $input = $request->all();
        $post = Tag::create($input);

        return $this->sendResponse(new TagResource($post) , __('tag.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        if (is_null($tag)) {
            return $this->sendError(__('event.show-error'));
        }
        return $this->sendResponse(new TagResource($tag), __('tag.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        if (!$tag->validate($request->all())) {
            return $this->sendError($tag->errors);
        }

        $input = $request->all();
        $tag->slug = null;
        $tag->title = $input['title'];
        $tag->save();

        return $this->sendResponse(new TagResource($tag), __('tag.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->sendResponse([], __('tag.destroy'));
    }
}
