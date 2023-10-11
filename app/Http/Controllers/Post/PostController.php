<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdatePostRecipeRquest;

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

        // TODO: check if Eager Loading logic here is necessary
        $posts = Post::with(['postImages', 'postImagesTrashed', 'postRecipeSeoMetadata', 'postPrimaryComments.children'])->get();
        //get deleted images
        // dd($posts);

        // $trasedImages = PostImage::onlyTrashed()->where('post_id', )->count();
        // dd($trasedimages);

        return view('posts.index', [
            'posts' => $posts,
            // 'trasedImages' => $trasedImages,
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

        //TODO move store validation

        $request->validate([
            'title' => 'required|unique:posts|max:100|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'subtitle' => 'required|unique:posts|max:100|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'meta_title' => 'max:100',
            'meta_description' => 'max:200',
            'intro' => 'regex:/^[\pL\s\-]+$/u',
            'description' => 'regex:/^[\pL\s\-]+$/u',
            'note' => 'regex:/^[\pL\s\-]+$/u',
        ]);

        //change title format (lowerCase and add (-) aech withe space)
        $slug = str_replace(' ','-', $request->title);
        $slug = strtolower($slug);

        $request->user()->posts()->create([
           'title' => $request->title,
           'slug' => $slug,
           'subtitle' => $request->subtitle,
           'meta_title' => $request->meta_title,
           'meta_description' => $request->meta_description,
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
    public function update(UpdatePostRecipeRquest $request, User $user, Post $post)
    {

        //TODO move update validation
        // $request->validate([
        //     'title' => 'required|unique:posts|max:100|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
        //     'meta_title' => 'max:100',
        //     'meta_description' => 'max:200',
        //     'intro' => 'regex:/^[\pL\s\-]+$/u',
        //     'note' => 'regex:/^[\pL\s\-]+$/u',
        // ]);

        $slug = str_replace(' ','-', $request->title);
        $slug = strtolower($slug);

        $request->user()->posts()->first()->update([
           'title' => $request->title,
           'slug' => $slug,
           'subtitle' => $request->subtitle,
           'meta_title' => $request->meta_title,
           'meta_description' => $request->meta_description,
           'intro' => $request->intro,
           'description' => $request->description,
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
