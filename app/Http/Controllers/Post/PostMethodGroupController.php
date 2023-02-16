<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
// use App\Models\PostMethod;
use App\Models\User;
// use App\Models\PostMethod;
use Illuminate\Http\Request;
use App\Models\PostMethodGroup;
use App\Http\Controllers\Controller;

class PostMethodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {
        // $methods = PostMethod::get();
        // $methodsGroups = PostMethodGroup::get();

        $methods = $post->postMethods()->get();
        $methodsGroups = $post->postMethodsGroups()->get();

        // dd($post->postMethods()->get());

        // dd($post->postMethodsGroups()->with('post_methods')->get());

        return view('posts.methods.groups.index', 
                compact('post',
                        'methods',
                        'methodsGroups',
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
    public function store(Request $request, User $user, Post $post)//here we group the methods, if needed
    {
        // dd($request->ingredient);

        $request->validate([
            'title' => 'required|max:50|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'method' => 'required|min:1',
        ]);

        $groupCreated = $post->postMethodsGroups()->create([ //add title
            'title' => $request->title,
         ]);

         // last id inserted ($groupCreated->id)                     

        foreach ($request->method as $method) {

            $post->postMethods()->where('id', $method)->update([ //add id each ingredient
                'post_method_group_id' => $groupCreated->id,
                ]);
        }

        return redirect()->route('posts.methods', [$user, $post]);
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
    public function edit(PostMethodGroup $methodGrouped, $user, Post $post)
    {

        return view('posts.methods.groups.edit',
        compact('post',
                'methodGrouped',
                ) 
        );
    }

    public function updateTitle(Request $request, PostMethodGroup $methodGrouped, $user, Post $post)
    {

        //TODO policy -> only admin can do it
        //TODO policy -> check if the "id title" is the one belonging to the post

        $request->validate([
            'title' => 'required|max:50|regex:/^[\pL\s]+$/u',
        ]);

        $post->postMethodsGroups()->where('id', $methodGrouped->id)
                                    ->first()
                                    ->update([ //add id each ingredient
            'title' => $request->title,
            ]);

            return redirect()->route('posts.methods', [$user, $post]);
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

        //TODO policy -> only admin can do it
        //TODO policy -> check if the "id title" is the one belonging to the post
        //TODO policy -> check if the method is already inserted
        // dd($user);
        $request->validate([
            'group_title' => 'required|max:50|regex:/^[\pL\s]+$/u',
            'group_method' => 'required|min:1',
        ]);

        //find title id
        // $methodGroup = PostMethodGroup::where('title', $request->group_title)
        //                                         ->where('post_id', $post->id)
        //                                         ->first();

        //FIXME - update here
        $methodGroup = $post->postMethodsGroups()->where('title', $request->group_title)
                                                ->where('post_id', $post->id)
                                                ->first();
        //update ingredients grouped

        foreach ($request->group_method as $method) {

            $post->postMethods()->where('id', $method)->update([ //add id each method
                'post_method_group_id' => $methodGroup->id,
                ]);
        }

        return redirect()->route('posts.methods', [$user, $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $group_id, User $user, Post $post)
    {
        //TODO policy - check if deleteing the group from relative post
        
        // $methodsToUngroup = PostMethod::where('post_id', $post->id)
        //                                     ->where('post_method_group_id', $group_id)
        //                                     ->get();

        $methodsToUngroup = $post->postMethods()->where('post_id', $post->id)
                                                ->where('post_method_group_id', $group_id)
                                                ->get();

        //if deleted loop and ungroup the ingredients in it
        foreach ($methodsToUngroup as $method) {
            
            $post->postMethods()->where('id', $method->id)
                                ->update([ //add id each ingredient
                'post_method_group_id' => NULL,
             ]);
        }

        $post->postMethodsGroups()->delete();

        return back();


    }
}
