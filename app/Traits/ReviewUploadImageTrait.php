<?php

namespace App\Traits;
trait ReviewUploadImageTrait
{
    protected $path = 'upload/review/';

    public function veryfy($request)
    {
        return $request->has('image');
    }
    public function saveImage($request)
    {
        if ($this->veryfy($request)) {
            $images = $request->file('image');

            $name = time().'.'.$images->getClientOriginalExtension();
            $img = file_get_contents($images->getRealPath());
            $img = imagecreatefromstring($img);
            $resizedImg = imagescale($img, 360, 430);
            imagejpeg($resizedImg, $this->path.$name);
            return $name;
        }
    }
}
