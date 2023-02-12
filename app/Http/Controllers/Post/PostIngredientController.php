<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PostIngredient;
use App\Http\Controllers\Controller;

class PostIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {

        //get ingredients and relative group, if exist
        $ingredientsInserted = PostIngredient::where('post_id', $post->id)->with('postIngredientsGroups')->get();

        //get all ingredients gruoped per post 
        $ingredientsGrouped = $post->postIngredientsGroups()->get();

        return view('posts.ingredients.index', 
                    compact('post',
                            'ingredientsGrouped',
                            'ingredientsInserted',
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
            'quantity' => 'nullable|regex:/^[0-9]+$/|integer|between:1,999',// only numbers
            // 'quantity' => 'integer|between:0,999',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'unit' => 'max:100',
            'name' => 'required|max:25',
        ]);

        // dd($request->quantity);

        $post->postIngredients()->create([
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'name' => $request->name,
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
    public function edit(PostIngredient $ingredient, $user, Post $post)//id ingredient and show form to modify ingredient
    {   
      

        // dd($user);
        return view('posts.ingredients.edit', 
                    compact('post',
                            'ingredient',
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
    public function update(Request $request, PostIngredient $ingredient, $user, Post $post)
    {

        //TODO policy - check if modifying the group from relative post
        //TODO policy - check if user is admin
        //TODO policy - check if id ingrediet is correct

        $request->validate([
            'quantity' => 'nullable|regex:/^[0-9]+$/|integer|between:1,999',// only numbers
            // 'quantity' => 'integer|between:0,999',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'unit' => 'max:100',
            'name' => 'required|max:25',
        ]);

        $post->postIngredients()->where('id', $ingredient->id)->first()->update([
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'name' => $request->name,
         ]);

         return redirect()->route('posts.ingredients', [$user, $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PostIngredient $ingredient, $user, Post $post)
    {
        //TODO policy - check if ingredient is from the post id
        //TODO policy - check if user is admin

        $post->postIngredients()->where('id', $ingredient->id)->delete();

        return back();
    }

    public function ungroup(Request $request, $ingredient, User $user, Post $post)
    {
        //TODO policy - check if deleteing the group from relative post

            $post->postIngredients()->where('id', $ingredient)
                                ->update([
                'post_ingredient_group_id' => NULL,
             ]);

        return back();


    }
}
