<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\CommentFilter;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends BaseController
{
    public function __construct(){
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CommentFilter $filter)
    {
        $comment = Comment::filter($filter)->orderBy('id', 'desc')->get();

        return $this->sendResponse(CommentResource::collection($comment), __('comment.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = new Comment();

        if (!$comment->validate($request->all())) {
            return $this->sendError(__('auth.sign_up-error'), $comment->errors);
        }

        $input = $request->all();
        $comment->text = $input['text'];
        $comment->post_id = $input['post_id'];
        $comment->save();

        return $this->sendResponse(new CommentResource($comment), __('comment.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (is_null($comment)) {
            return $this->sendError(__('event.show-error'));
        }
        return $this->sendResponse(new CommentResource($comment), __('comment.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (!$comment->validate($request->all())) {
            return $this->sendError($comment->errors);
        }

        $input = $request->all();
        $comment->text = $input['text'];
        $comment->save();

        return $this->sendResponse(new CommentResource($comment), __('comment.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return $this->sendResponse([], __('post.destroy'));
    }
}
