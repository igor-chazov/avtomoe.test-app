<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\ImageStoreRequest;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use App\Http\Resources\Thumbnail as ThumbnailResource;

class ThumbnailController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thumbnail = Thumbnail::all();
        return $this->sendResponse(ThumbnailResource::collection($thumbnail), __('thumbnail.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageStoreRequest $request)
    {
        $image_name = $this->uploadImage($request);

        $thumbnail = new Thumbnail();

        $input = $request->all();
        $thumbnail->title = $image_name;
        $thumbnail->path = '/uploads/' . $image_name;
        $thumbnail->post_id = $input['post_id'];
        $thumbnail->save();

        return $this->sendResponse(new ThumbnailResource($thumbnail) , __('thumbnail.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $thumbnail = Thumbnail::findOrFail($id);

        if (is_null($thumbnail)) {
            return $this->sendError(__('event.show-error'));
        }
        return $this->sendResponse(new ThumbnailResource($thumbnail), __('thumbnail.show'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageStoreRequest $request, Thumbnail $thumbnail)
    {
        $image_name = $this->uploadImage($request);

        $input = $request->all();
        $thumbnail->title = $image_name;
        $thumbnail->path = '/uploads/' . $image_name;
        $thumbnail->post_id = $input['post_id'];
        $thumbnail->save();

        return $this->sendResponse(new ThumbnailResource($thumbnail) , __('thumbnail.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Thumbnail $thumbnail)
    {
        $thumbnail->delete();
        return $this->sendResponse([], __('thumbnail.destroy'));
    }

    public function uploadImage($request)
    {
        $image = $request->file('image');
        $image_name = 'image' . time() . '.' . $image->extension();
        $image_path = public_path(). '/uploads';
        $image->move($image_path, $image_name);

        return $image_name;
    }
}
