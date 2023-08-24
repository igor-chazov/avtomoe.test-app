<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageSaver
{
    public function upload($model)
    {
        $title = $model->title;

        if ($title && request()->remove) {
            $this->remove($model);
        }

        $image = request()->file('image');

        if ($image) {

            if ($model->title) {
                $this->remove($model);
            }

            $name = 'image' . time() . '.' . $image->extension();
            $path = $image->storeAs('images', $name);
            $dst = str_replace('images', 'thumbnail', $path);

            $this->resize($path, $dst, 150, 150);
        }

        return array(
            'image_name' => $name,
            'image_path' => $path,
            'thumbnail_path' => $dst,
        );
    }

    private function resize($src, $dst, $width, $height)
    {
        $path = Storage::path($src);

        $image = Image::make($path)
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode(pathinfo($path, PATHINFO_EXTENSION), 100);
        Storage::put($dst, $image);

        $image->destroy();
    }

    public function remove($model)
    {
        $image = $model->title;

        if ($image) {
            Storage::delete('/images/' . $image);
            Storage::delete('/thumbnail/' . $image);
        }
    }
}
