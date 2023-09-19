<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Post\PostComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreCommentRequest;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        // dd($request->ip());
        // dd($post);
        
        if ($post->cookies_consent == 1) {
            // dd($request->cookies_consent);

            //TODO: set the cookies here
            // Generate and set a cookie - you need to store name & email
            // $response->cookie('cookie_name', 'cookie_value', $minutes);
            // $response->cookie('name', 'John', 60);
        }

        //cookies
        if ($request->cookies_consent === NULL || $request->cookies_consent != 1) {
            // $cookies_consent = 0;
           
            // dd($cookies_consent);
        }

        $post->postComments()->create([
            'parent_id' => NULL,
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'post_comment_status_id' => 1,
            'user_ip' => $request->ip(),
            'recipe_rating' => $request->rating,
            'name' => $request->name,
            'email' => $request->email,
            'link' => $request->link,
            'comment' => $request->comment,
            'cookies_consent' => $request->cookies_consent,
            'notify_on_reply' => $request->notify_on_reply,
            'pinned' => false,
            
         ]);

         if ($request->notify_on_reply == 1) {
            //send email to the user who wrote the comment
         }

        // Return a JSON response indicating success
        // return response()->json(['success' => true]);
        return ['success' => true];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(StoreCommentRequest $request, Post $post, $id)
    {

        // dd($id);

        $post->postComments()->create([
            'parent_id' => $id, // this is comment_id (parent)
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'post_comment_status_id' => 1,
            'user_ip' => $request->ip(),
            'recipe_rating' => $request->rating,
            'name' => $request->name,
            'email' => $request->email,
            'link' => $request->link,
            'comment' => $request->comment,
            'cookies_consent' => $request->cookies_consent,
            'notify_on_reply' => $request->notify_on_reply,
            'pinned' => false,
            
         ]);

         //TODO: send email to ADMIN when user write a comment
         if ($request->notify_on_reply == 1) {
            //send email to the user who wrote the comment
         }

        // Return a JSON response indicating success
        // return response()->json(['success' => true]);
        return ['success' => true];
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
