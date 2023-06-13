<?php

namespace App\Http\Controllers\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Rules\UniqueTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {

        $tags = Tag::get();
        $postTags = $post->postTags()->with('tags')->get();
        // dd($postTags);

        return view('posts.tags.index',
                    compact(
                            'post',
                            'tags',
                            'postTags',
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
    public function store(request $request, User $user, Post $post)
    {

        $request->validate([
            'tag' => [
                'required',
                'integer',
                new UniqueTag($post->id), // Pass the post ID to the rule
            ],
            // other validation rules...
        ]);

        //Insert tag
        $post->postTags()->create([
            'tag_id' => $request->tag,
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'Tag successfully inserted.');

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
    public function destroy(User $user, Post $post, $tag)
    {
        //TODO: add user permission

        $post->postTags()->where('post_id', $post->id)
                        ->where('tag_id', $tag)
                        ->first()->delete();

        return back()->with('success', 'Tag successfully deleted.');
    }
}
