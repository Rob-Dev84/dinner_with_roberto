<?php

namespace App\Helpers;

class ImageHelper
{
    //TODO: logic for creating deleted path when image is soft deleted
    public static function createDeletedImagePath($image)
    {
        if (is_null($image->deleted_at)) {
            // Add "deleted" subfolder to the path
            $directory = dirname($image->path);
            $filename = basename($image->path);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            // Add "id" after image name and before the image extention and encode itid
            dd($image->id);
            $encodedId = base64_encode($image->id);
            $originalFilename = str_replace('.' . $extension, '', $filename);
            $newFilename = $originalFilename . '-' . $encodedId . '.' . $extension;
            return $directory . '/deleted/' . $newFilename;
        } else {
            // Error message 
            return redirect()->back()->with('error', 'this image is already deleted.');
        }
    }

    //Use this when to display deleted image path without the 
    public static function decodeDeletedImagePath($image)
    {
        if ($image->deleted_at) {
            // $directory = dirname($image->path);
            $filename = basename($image->path);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            // Add "id" after image name and before the image extention and encode itid
            
            // $encodedId = base64_encode($image->id);
            // $decoldeId = base64_decode($encodedId);


            $removedSuffix = substr($filename, 0, strrpos($filename, '-'));
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $newImageName = $removedSuffix . '.' . $extension;


            $originalFilename = str_replace('.' . $extension, '', $filename);
            $newFilename = $originalFilename . '-' . $encodedId . '.' . $extension;
            return $directory . '/deleted/' . $newFilename;
        } else {
            // Error message 
            return redirect()->back()->with('error', 'this image cannot be restored.');
        }
    }

    //TODO: you could use this method for creating the deleted_path with the encode ID
    public static function moveImageToRecipeFoder($image)
    {
        if ($image->deleted_at) {
            // Add id before image (.png) and decode it
            
            //code here

            // return $directory . '/deleted/' . $newFilename;
        } else {
            // Error message 
            return redirect()->back()->with('error', 'this image cannot be restored.');
        }
    }
}
