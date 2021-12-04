<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait UploderImages
{
    protected function saveImage($fileName,$request)
    {
        if ($file = $request->file($fileName)) {
            $destinationPath = public_path('/images/'); // upload path
            $imageName = date('YmdHis') . $file->getClientOriginalName();
            $file->move($destinationPath, $imageName);

            return $imageName;
        }
    }

    protected function deleteImage($fileName)
    {
        $image_path = public_path("images/{$fileName}");
        File::delete($image_path);
    }

    protected function saveImageArr($fileName,$request)
    {
        if($request->hasFile($fileName)) {
            //run actions with files
            $files = $request->file($fileName);
            $images = [];
            foreach($files as $key => $file){
                $destinationPath = public_path('/images/'); // upload path
                $imageName = date('YmdHis') . $file->getClientOriginalName();
                $images[] = $imageName;
                $file->move($destinationPath, $imageName);
            }
            return $images;
        }
    }

}
