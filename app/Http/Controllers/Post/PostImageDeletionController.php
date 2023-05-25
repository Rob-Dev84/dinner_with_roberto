<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostImageDeletionController extends Controller
{

    

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {
        $images = $post->find($post->id)->postImages()->get();
        // dd($images);

        return view('posts.images.deletions.index',
        compact('post',
                'images',)
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
    public function update(Request $request, $id)
    {
        //
    }

    public function softDelete(Request $request, $image, $user, $post)
    {
        

        $image = PostImage::findOrFail($image);
       
        $fileName = pathinfo($image->path, PATHINFO_FILENAME); // 'image-name'
        $extension = pathinfo($image->path, PATHINFO_EXTENSION); // 'png'
        
        $directory = dirname($image->path) . '/';// gives: images/recipes/name-recipe/

        // $deletedFilename = $fileName . '-' . time() . '.' . $extension;

        $encodedId = base64_encode($image->id);//Encode the image post ID

        $deletedFilename = $fileName . '-' . $encodedId . '.' . $extension;//add an unique deleted id at the file name

        if (File::exists($image->path)) {
            $deletedPath = $directory . 'deleted';//Add "deleted" directory: images/recipes/name-recipe/deleted
            
            if (!File::exists($deletedPath)) {//to create the subfolder "deleted"
                File::makeDirectory($deletedPath, 0755, true);
            }
            File::move($image->path, $deletedPath . '/' . $deletedFilename);

        }

        // Soft Delete the image
        $image->deleted_path = $deletedPath . '/' . $deletedFilename;
        $image->delete();
        $image->save();

        return redirect()->back()->with('success', 'Image deleted successfully.');
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
