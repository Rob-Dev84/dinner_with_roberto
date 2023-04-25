<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $posts = Post::with(['user'])->paginate(6);
        $posts = Post::get();

        // dd($posts);

        return view('posts.index', [
            'posts' => $posts 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        // dd($request->hasFile('img_link'));

        

        $request->validate([
            'title' => 'required|unique:posts|max:100|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'meta_title' => 'max:100',
            'meta_description' => 'max:200',
            'img_link' => 'mimes:jpg,jpeg,png|max:2048',
            'intro' => 'regex:/^[\pL\s\-]+$/u',
            'note' => 'regex:/^[\pL\s\-]+$/u',
        ]);

        //change title format (lowerCase and add (-) aech withe space)
        $slug = str_replace(' ','-', $request->title);
        $slug = strtolower($slug);


        //store image into the folder... app/public/images/file.extension
        $imagePath = null;
        if ($request->hasFile('img_link')) {
            $imagePath = $request->file('img_link')->storeAs(
                'images',
                // $request->file('img_link')->getClientOriginalExtension(),
                $request->file('img_link')->getClientOriginalName(),
                'public',
            );
        }

        $request->user()->posts()->create([
           'title' => $request->title,
           'slug' => $slug,
           'meta_title' => $request->meta_title,
           'meta_description' => $request->meta_description,
           'img_link' => $imagePath,
           'intro' => $request->intro,
           'note' => $request->note,
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
    public function edit(User $user, Post $post)
    {
        // $post = str_replace('-',' ', $post);

        // dd($post);
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Post $post)
    {

        //TODO Add validation here
        $request->validate([
            'title' => 'required|unique:posts|max:100|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'meta_title' => 'max:100',
            'meta_description' => 'max:200',
            'img_link' => 'mimes:jpg,jpeg,png|max:2048',
            'intro' => 'regex:/^[\pL\s\-]+$/u',
            'note' => 'regex:/^[\pL\s\-]+$/u',
        ]);

        //store image into the folder... app/public/images/file.extension
        $imagePath = null;
        if ($request->hasFile('img_link')) {
            $imagePath = $request->file('img_link')->storeAs(
                'images',
                // $request->file('img_link')->getClientOriginalExtension(),
                $request->file('img_link')->getClientOriginalName(),
                'public',
            );
        }


        $slug = str_replace(' ','-', $request->title);
        $slug = strtolower($slug);

        $request->user()->posts()->first()->update([
           'title' => $request->title,
           'slug' => $slug,
           'meta_title' => $request->meta_title,
           'meta_description' => $request->meta_description,
           'img_link' => $imagePath,
           'intro' => $request->intro,
           'note' => $request->note,
        ]);

        return redirect('posts');
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