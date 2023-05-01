<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
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
  
        $positions = ['intro', 'intro_end', 'method', 'method_end', 'recipe_card'];

        return view('posts.images.create', 
                    compact('post',
                            'positions',)
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
            // 'image' => 'mimes:jpg,jpeg,png|max:2048',//images/recipes/pasta/spaghetti-aglio-e-olio.jpg
            

            'path_*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*\.[a-z]{3,4}$/', // add your validation rules for each image input field
            'path' => 'required_without_all:image_1,image_2,image_3,image_4,image_5', // validate if at least one image is uploaded
            'title' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'alt' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'figcaption' => 'max:200',
        ]);

        

        
        //Create a recipe folder inside public/images 
        $postImagesPath = public_path('images/' . Str::slug($post->slug));
        File::makeDirectory($postImagesPath, $mode = 0777, true, true);

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
                    $image->move($postImagesPath, $imageName);
                    $post->path = $imageName;
                    
                    
                    // convert file name to: 1. lower case and 2. kebab-case
                    $imageName = str_replace([' ', '_'], '-', $imageName);
                    $imageName = strtolower($imageName);

                    //Add -position on each photo

                    // Get the file extension
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);

                    // Remove the extension from the file name
                    $fileNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);

                    // Append the position to the file name
                    $imageName = $fileNameWithoutExtension . '-' . $position . '.' . $extension;

                    dd($imageName);
                    
                }

            //this will be the path to store into the database
            $path = str_replace('/var/www/html/public/', '', $imagePath);

            $request->user()->posts()->find($post->id)->postImages()->create([
                'path' => $path,
             //    'title' => $request->title,
             //    'alt' => $request->alt,
             //    'figcaption' => $request->figcaption,
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
