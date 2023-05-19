<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getDeletedImagePath($image)
    {
        if ($image->deleted_at) {
            // Add "deleted" subfolder to the path
            $directory = dirname($image->path);
            $filename = basename($image->path);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $encodedId = base64_encode($image->id);
            $originalFilename = str_replace('.' . $extension, '', $filename);
            $newFilename = $originalFilename . '-' . $encodedId . '.' . $extension;
            return $directory . '/deleted/' . $newFilename;
        } else {
            // Use the original path
            return $image->path;
        }
    }


    public static function createDeletedImagePath($image)
    {
        if (is_null($image->deleted_at)) {
            // Add id before image (.png) and decode it
            
            //code here

            // return $directory . '/deleted/' . $newFilename;
        } else {
            // Error message 
            return 'error massege: the image is already deleted';
        }
    }
}
