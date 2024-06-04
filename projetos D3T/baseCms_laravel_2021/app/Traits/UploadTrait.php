<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait UploadTrait
{
    protected static function uploadValidFile($dir, $file, $isBanner = false)
    {
        if ($file->isValid()) {
            $image = self::upload($file, $dir);

            if($file->getMimeType() == "image/*" && $isBanner == false){
                self::resizeImage($image);
            }
            return $image;
        }
    }

    private static function upload($file, $dir)
    {
        $name = preg_replace("/[^A-Za-z0-9\-\_]/", "_", pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        
        $extension = $file->getClientOriginalExtension();
        $fileName = date('YmdHis') . '_' . $name . '.' . $extension;
        $upload = $file->storeAs("$dir", $fileName);
        if (!$upload) {
            return false;
        }
        return "storage/$dir/$fileName";
    }

    protected static function deleteFile($fileName)
    {
        $file = str_replace('storage/', '', $fileName);
        return Storage::delete($file);
    }

    private static function resizeImage($image)
    {
        $mainImage = Image::make($image);
        if ($mainImage->width() > 1366) {
            if($mainImage->width() > $mainImage->height()){
                $mainImage->resize(1366, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $mainImage->resize(null, 768, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }
        $mainImage->save($image);
        return true;
    }
}