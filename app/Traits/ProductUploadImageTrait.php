<?php

namespace App\Traits;

trait ProductUploadImageTrait
{
    protected $path = 'upload/product/';

    public function veryfy($request)
    {
        return $request->has('image');
    }
    public function saveImage($request)
    {
        if ($this->veryfy($request)) {
            $images = $request->file('image');
            $imageNames = [];
            foreach ($images as $key => $file) {
                $name = time().'_'.$key.'.'.$file->getClientOriginalExtension();
                $img = file_get_contents($file->getRealPath());
                $img = imagecreatefromstring($img);
                $resizedImg = imagescale($img, 360, 432);
                imagejpeg($resizedImg, $this->path.$name);
                $imageNames[] = $name;
            }
            return $imageNames;
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
