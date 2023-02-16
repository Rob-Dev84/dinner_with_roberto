<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {
        $methodsInserted = PostMethod::where('post_id', $post->id)
                                        // ->with('postMethodsGroups')
                                        ->get();

        $methodsGrouped = $post->postMethodsGroups()->get();


        return view('posts.methods.index', 
                    compact('post',
                            'methodsInserted',
                            'methodsGrouped',
                            ) 
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
            'method' => 'required|max:65535|regex:/^[\pL\s\-]+$/u',
        ]);

        $post->postMethods()->create([
            'method' => $request->method,
         ]);

         return back();
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
    public function edit(PostMethod $method, $user, Post $post)
    {
     
        return view('posts.methods.edit', 
                    compact('post',
                            'method',
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
    public function update(Request $request, PostMethod $method, $user, Post $post)
    {

        // dd($request->method);
        //TODO policy - check if modifying the group from relative post
        //TODO policy - check if user is admin
        //TODO policy - check if id method is correct

        // $request->validate([
        //     'method' => 'required|max:65535|regex:/^[\pL\s\-]+$/u',
        // ]);

        $post->postMethods()->where('id', $method->id)->first()->update([
            'method' => $request->method,
         ]);

         return redirect()->route('posts.methods', [$user, $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PostMethod $method, $user, Post $post)
    {
        //TODO policy - check if method is from the post id
        //TODO policy - check if user is admin

        $post->postMethods()->where('id', $method->id)->delete();

        return back();
    }


    public function ungroup(Request $request, $method, User $user, Post $post)
    {
        //TODO policy - check if deleteing the group from relative post

            $post->postMethods()->where('id', $method)
                                ->update([
                'post_method_group_id' => NULL,
             ]);

        return back();


    }



}
