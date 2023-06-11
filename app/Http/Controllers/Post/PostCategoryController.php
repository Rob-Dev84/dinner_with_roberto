<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {

        // $category = $post->postCategory->name;
        // $subcategory = $post->postSubcategory;
        // dd($category);

        $categories = PostCategory::get();


        return view('posts.categories.index', 
                    compact(
                            'post',
                            // 'category',
                            // 'subcategory',
                            'categories',
                            ));
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
        //TODO: Check if category_id exists in the category table.
        //TODO: Check if user is admin.
        // dd($request->category);

        $request->user()->posts()->first()->update([
            'category_id' => $request->category,
         ]);

         return redirect()->route('posts')->with('success', 'Category successfully inserted.');
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
        $categories = PostCategory::get();

        // dd($post);
        return view('posts.categories.edit', compact('post',
                                                     'categories',
                                                    ));
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
        // dd($request);
        // $request->

        $request->user()->posts()->first()->update([
            'category_id' => $request->category,
         ]);

        return redirect()->route('posts')->with('success', 'Category successfully modified.');
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
