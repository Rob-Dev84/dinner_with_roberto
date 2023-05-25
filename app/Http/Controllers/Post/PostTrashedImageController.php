<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostImage;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostTrashedImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {
        $images = PostImage::where('post_id', $post->id)
                                    ->onlyTrashed()
                                    ->get();
        // dd($images);
        // Modify the image paths
        // foreach ($images as $image) {
        //     $image->deleted_path = ImageHelper::getDeletedImagePath($image);
        // }

        // dd($image);

        return view('posts.images.trash.index', 
                    compact('post',
                            // 'image',
                            'images',
                            )
                );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $image, $user, Post $post)
    {

        // dd($request);
        $image = PostImage::withTrashed()->findOrFail($image);

        $fileName = pathinfo($image->path, PATHINFO_FILENAME); // 'image-name'
        $extension = pathinfo($image->path, PATHINFO_EXTENSION); // 'png'

        $path_directory = dirname($image->path) . '/';
        
        $restoredFilename = $fileName . '.' . $extension;//add an unique deleted id at the file name


        //TODO: before moving you could check if the decode id on image-name matches the actual id
        
        //Move file the original path
        if (File::exists($image->deleted_path)) {
            
            File::move($image->deleted_path, $path_directory . $restoredFilename);

            //TODO: if deleted folder is empty, delete the folder... is it necessary?

            
            $image->deleted_path = NULL;
            $image->restore();
            $image->save();

            // $image->update([
            //     'deleted_path' => null,
            //     'deleted_at' => null,
            // ]);

            return redirect()->back()->with('success', 'Image restored successfully.');

        }

        return redirect()->back()->with('error', 'Image not found.');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
