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
                                        // ->with('postIngredientsGroups')
                                        ->get();

        $methodsGrouped = $post->postMethodsGroups()->get();
        // dd($methodsInserted);


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
