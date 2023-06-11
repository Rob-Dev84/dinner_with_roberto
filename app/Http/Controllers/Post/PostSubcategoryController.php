<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PostSubcategory;
use App\Http\Controllers\Controller;

class PostSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {

        $subcategories = PostSubcategory::get();

        return view('posts.subcategories.index', 
                    compact(
                            'post',
                            'subcategories',
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

        $request->validate([
            'subcategory' => 'required|integer',
        ]);

        if (!is_null($post->subcategory_id)) {
            return redirect()->route('posts')->with('error', 'Post already contains a subcategory');
        }

        if ($request->subcategory) {

            $post->first()
                ->where('id', $post->id)
                ->update([
                'subcategory_id' => $request->subcategory,
             ]);
    
            return redirect()->route('posts')->with('success', 'Subcategory successfully inserted.');
        }

        
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
        $subcategories = PostSubcategory::get();

        return view('posts.subcategories.edit', 
                                compact('post',
                                        'subcategories',
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
        $request->validate([
            'subcategory' => 'required|integer',
        ]);
         
        // if ($request->subcategory) {

        //     PostSubcategory::first()->where('id', $request->subcategory)->update([
        //         'category_id' => $post->category_id,
        //     ]);

        //     return redirect()->route('posts')->with('success', 'Category successfully modified.');
        // }

        if ($request->subcategory) {

            $post->first()
                ->where('id', $post->id)
                ->update([
                'subcategory_id' => $request->subcategory,
             ]);
    
            return redirect()->route('posts')->with('success', 'Subcategory successfully inserted.');
        }
        
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
