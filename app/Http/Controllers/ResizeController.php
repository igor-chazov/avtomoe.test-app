<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ResizeController extends Controller
{
    public function index()
    {
        return view('image');
    }
    public function resizeImage(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $image = $request->file('file');

        $input['file'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail');

        $imgFile = Image::make($image->getRealPath());

        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['file']);

        $destinationPath = public_path('/uploads');

        $image->move($destinationPath, $input['file']);

        return back()
            ->with('success',__('messages.upload_image'))
            ->with('fileName', $input['file']);
    }
}
