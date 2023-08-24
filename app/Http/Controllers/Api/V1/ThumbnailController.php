<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ImageSaver;
use App\Http\Requests\ImageStoreRequest;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use App\Http\Resources\Thumbnail as ThumbnailResource;

class ThumbnailController extends BaseController
{
    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

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
        $data = $this->imageSaver->upload($request);

        $thumbnail = new Thumbnail();

        $thumbnail->fill($request->except('title', 'path', 'thumbnail_path'));
        $thumbnail->title = $data['image_name'];
        $thumbnail->path = $data['image_path'];
        $thumbnail->thumbnail_path = $data['thumbnail_path'];
        $thumbnail->save();

        return $this->sendResponse(new ThumbnailResource($thumbnail), __('thumbnail.store'));
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
        $data = $this->imageSaver->upload($thumbnail);

        $image = $request->except('title', 'path', 'thumbnail_path');
        $image['title'] = $data['image_name'];
        $image['path'] = $data['image_path'];
        $image['thumbnail_path'] = $data['thumbnail_path'];
        $thumbnail->update($image);

        return $this->sendResponse(new ThumbnailResource($thumbnail), __('thumbnail.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $thumbnail = Thumbnail::find($id);

        if (empty($thumbnail)) {
            return $this->sendError(__('messages.error_record'));
        }

        $this->imageSaver->remove($thumbnail);
        $thumbnail->delete();
        return $this->sendResponse([], __('thumbnail.destroy'));
    }
}
