<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\PostFilter;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use Illuminate\Support\Facades\Gate;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostFilter $filter)
    {
        $post = Post::filter($filter)->orderBy('id', 'desc')->get();

        return $this->sendResponse(PostResource::collection($post), __('post.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!Gate::allows('banned')) {
            return $this->sendError(__('auth.ban'));
        }

        $post = new Post();

        if (!$post->validate($request->all())) {
            return $this->sendError(__('auth.sign_up-error'), $post->errors);
        }

        $input = $request->all();
        $post = Post::create($input);

        return $this->sendResponse(new PostResource($post) , __('post.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (is_null($post)) {
            return $this->sendError(__('event.show-error'));
        }
        return $this->sendResponse(new PostResource($post), __('post.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (!$post->validate($request->all())) {
            return $this->sendError($post->errors);
        }

        $input = $request->all();
        $post->slug = null;
        $post->title = $input['title'];
        $post->description = $input['description'];
        $post->content = $input['content'];
        $post->save();

        return $this->sendResponse(new PostResource($post), __('post.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->sendResponse([], __('post.destroy'));
    }

}
