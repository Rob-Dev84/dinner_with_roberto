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
        // dd($request->ingredient);

        $request->validate([
            'title' => 'required|max:50|regex:/^[\pL\s]+$/u',// to accept hypen -> regex:/^[\pL\s\-]+$/u'
            'ingredient' => 'required|min:1',//todo minimum one, ?????? but we need to check (query) if already has one into the table
        ]);

        $groupCreated = $post->postIngredientsGroups()->create([ //add title
            'title' => $request->title,
         ]);

         // last id inserted ($groupCreated->id)                     

        foreach ($request->ingredient as $ingredient) {

            $post->postIngredients()->where('id', $ingredient)->update([ //add id each ingredient
                'post_ingredient_group_id' => $groupCreated->id,
                ]);
        }

        return redirect()->route('posts.ingredients', [$user, $post]);
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
    public function edit(PostIngredientGroup $ingredientGrouped, $user, Post $post)
    {

        return view('posts.ingredients.groups.edit',
        compact('post',
                'ingredientGrouped',
                ) 
        );
    }

    public function updateTitle(Request $request, PostIngredientGroup $ingredientGrouped, $user, Post $post)
    {

        //TODO policy -> only admin can do it
        //TODO policy -> check if the "id title" is the one belonging to the post

        $request->validate([
            'title' => 'required|max:50|regex:/^[\pL\s]+$/u',
        ]);

        $post->postIngredientsGroups()->where('id', $ingredientGrouped->id)
                                    ->first()
                                    ->update([ //add id each ingredient
            'title' => $request->title,
            ]);

            return redirect()->route('posts.ingredients', [$user, $post]);
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
        //TODO policy -> check if the ingredient is already inserted

        $request->validate([
            'group_title' => 'required|max:50|regex:/^[\pL\s]+$/u',
            'group_ingredient' => 'required|min:1',
        ]);

        //find title id
        $ingredientsGroup = PostIngredientGroup::where('title', $request->group_title)
                                                ->where('post_id', $post->id)
                                                ->first();

        //update ingredients grouped

        foreach ($request->group_ingredient as $ingredient) {

            $post->postIngredients()->where('id', $ingredient)->update([ //add id each ingredient
                'post_ingredient_group_id' => $ingredientsGroup->id,
                ]);
        }

        

        // return back();
        return redirect()->route('posts.ingredients', [$user, $post]);
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
        
        $ingredientsToUngroup = PostIngredient::where('post_id', $post->id)
                                            ->where('post_ingredient_group_id', $group_id)
                                            ->get();

        //if deleted loop and ungroup the ingredients in it
        foreach ($ingredientsToUngroup as $ingredient) {
            
            $post->postIngredients()->where('id', $ingredient->id)
                                ->update([ //add id each ingredient
                'post_ingredient_group_id' => NULL,
             ]);
        }

        $post->postIngredientsGroups()->delete();

        return back();


    }

    
}
