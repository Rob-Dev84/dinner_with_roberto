<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
// use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostImageController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {
        //TODO - in model add relationship post images and we can get the images for related post

        return view('posts.images.index', 
                    compact('post',)
                );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, Post $post)
    {
  
        $positions = ['intro', 'intro_end', 'method', 'method_end', 'recipe_card'];//This are the positions for each image

        $images = $post->find($post->id)->postImages()->get();

        $usedPositions = [];//To get all the occupade positions

        foreach ($images as $image) {
            $usedPositions[] = $image->position;
        }

        // dd($usedPositions);

        return view('posts.images.create', 
                    compact('post',
                            'positions',
                            'images',
                            'usedPositions',)
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Post $post)
    {

        // dd($request->hasFile('path'));

        $request->validate([
            'path_*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*\.[a-z]{3,4}$/', // add your validation rules for each image input field
            'path' => 'required_without_all:path_1,path_2,path_3,path_4,path_5', // validate if at least one image is uploaded
            'title_*' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'alt_*' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'figcaption_*' => 'max:200|regex:/^[\pL\s]+$/u',
        ]);

        // dd($request->title_4);

        //Create a recipe folder inside public/images /recipes
        
        // $postImagesPath = public_path('images/recipes/' . Str::slug($post->slug));
        $postImagesPath = public_path('images/recipes/' . $post->slug);
        File::makeDirectory($postImagesPath, $mode = 0777, true, true);

        // dd(public_path('images/recipes/' . $post->slug));

        // dd(File::makeDirectory($postImagesPath, $mode = 0777, true, true));
        

            //for each index we assign an image position
            $imageMap = [
                1 => 'intro',
                2 => 'intro_end',
                3 => 'method',
                4 => 'method_end',
                5 => 'recipe_card',
            ];

            

            foreach ($request->file() as $key => $image) {
                $index = substr($key, -1);
                $position = $imageMap[$index];

                
                
                if ($request->hasFile('path_'.$index)) {
                    $image = $request->file('path_'.$index);
                    $imageName = $image->getClientOriginalName();
                    // $originalName = $image->getClientOriginalName();
                    $imagePath = $postImagesPath . '/' . $imageName;
                    
                    $post->path = $imageName;
                    // dd($postImagesPath, $imageName);
                    
                    // convert file name to: 1. lower case and 2. kebab-case
                    $imageName = str_replace([' ', '_'], '-', $imageName);
                    $imageName = strtolower($imageName);

                    //Add -position on each photo

                    // Get the file extension
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);

                    // Remove the extension from the file name
                    $fileNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);

                    //this moves image to the folder
                    $image->move($postImagesPath, $fileNameWithoutExtension .'-'. $position .'.'. $extension);

                    //this will be the path to store into the database
                    $path = str_replace('/var/www/html/public/', '', $imagePath);

                    // Append the position to the file name
                    $imagePath = dirname($path) . "/" . $fileNameWithoutExtension .'-'. $position .'.'. $extension;
                            
                    
                    // dd($imagePath);


                    

                    
                }

                

            

            // dd($request->input('alt_'.$index));

        
            $request->user()->posts()->find($post->id)->postImages()->firstOrCreate([
                'path' => $imagePath,
                'title' => $request->input('title_'.$index),
                'alt' => $request->input('alt_'.$index),
                'figcaption' => $request->input('figcaption_'.$index),
                'position' => $position,
             ]);

             
            }
              
           
            

        //     return redirect()->route('posts')->with('success', 'Post created successfully.');
        // }

        

        

        // $post->save();

        return redirect()->route('posts')->with('success', 'Post created successfully.');

        // return redirect('posts');
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
    public function edit(User $user, Post $post)
    {
        // $positions = ['intro', 'intro_end', 'method', 'method_end', 'recipe_card'];//This are the positions for each image

        $images = $post->find($post->id)->postImages()->get();
        // dd($images);
        // $usedPositions = [];//To get all the occupade positions
        
        return view('posts.images.edit', 
                    compact('post',
                            // 'positions',
                            'images',
                            // 'usedPositions',
                            )
                );
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

    //To show modal with unique image id
    public function getDeleteModal($id)
{
    $image = PostImage::findOrFail($id);
    // $images = $post->find($post->id)->postImages($image->id)->get();

    return view('posts.images.partials.delete-modal', compact('image'))->render();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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
