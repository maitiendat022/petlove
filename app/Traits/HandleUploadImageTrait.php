<?php

namespace App\Traits;
trait HandleUploadImageTrait
{
    protected $path = 'upload/user/';

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
            $resizedImg = imagescale($img, 360, 360);
            imagejpeg($resizedImg, $this->path.$name);
            return $name;
        }
    }
    public function uploadImage($request, $curentImage)
    {
        if ($this->veryfy($request)) {
            $this->deleteImage($curentImage);
            return $this->saveImage($request);
        }
        return $curentImage;
    }
    public function deleteImage($imageName)
    {
        if (file_exists($this->path.$imageName)) {
            unlink($this->path.$imageName);
        }
    }
}
