<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PostIngredient;
use App\Models\PostIngredientGroup;
use App\Http\Controllers\Controller;

class PostIngredientGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $post)
    {

        $ingredients = PostIngredient::get();

        $ingredientsGroups = PostIngredientGroup::get();

        // $ingredientsInserted = PostIngredient::where('post_id', $post->id)->with('postIngredientsGroups')->get();


        return view('posts.ingredients.groups.index', 
                compact('post',
                        'ingredients',
                        'ingredientsGroups',
                        // 'ingredientsInserted',
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
    public function store(Request $request, User $user, Post $post)//here we group the ingredients, if needed
    {

        $request->validate([
            'title' => 'required|max:50|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'ingredient' => 'required|min:2',//todo minimum two, but we need to check (query) if already has two into the table
        ]);

        $post->postIngredientsGroups()->create([ //add title
            'title' => $request->title,
         ]);

        $ingredientsGroups = PostIngredientGroup::where('post_id', $post->id)->where('title', $request->title)->get();

        foreach ($ingredientsGroups as $ingredientGroup) {
            
            $post->postIngredients()->update([ //add id each ingredient
                'post_ingredient_group_id' => $ingredientGroup->id,
             ]);
        }

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
    public function edit(User $user, Post $post)
    {
        // dd($post);

        return view('posts.ingredients.edit', [
            // 'posts' => $posts 
        ]);
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
