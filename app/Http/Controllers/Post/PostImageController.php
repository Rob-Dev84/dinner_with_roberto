<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function store(Request $request, User $user, Post $post)
    {
        $request->validate([
            'image' => 'mimes:jpg,jpeg,png|max:2048',//images/recipes/pasta/spaghetti-aglio-e-olio.jpg
            'title' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'alt' => 'max:125|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'figcaption' => 'max:200',
        ]);

        //store image into the folder... app/public/images/file.extension
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs(
                'images/recipes',
                // $request->file('img_link')->getClientOriginalExtension(),
                $request->file('image')->getClientOriginalName(),
                'public',
            );
        }

        $request->user()->posts()->create([
           'path' => $imagePath,
           'title' => $request->title,
           'alt' => $request->alt,
           'figcaption' => $request->figcaption,
        ]);

        return redirect('posts');
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
