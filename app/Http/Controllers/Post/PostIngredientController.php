<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PostIngredient;
use App\Models\PostIngredientGroup;
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

        $ingredientsInserted = PostIngredient::where('post_id', $post->id)->with('postIngredientsGroups')->get();

        // dd($ingredientsInserted->postIngredientsGroups->name);

        $ingredientsNotGruoped = PostIngredient::where('post_ingredient_group_id', NULL)->get();

        // $ingredientsGrouped = PostIngredientGroup::where('post_id', $post)->get();









        // $ingredients = PostIngredient::get();

        // $ingredientsGroups = PostIngredientGroup::get();

        return view('posts.ingredients.index', 
                    compact('post',
                            'ingredientsInserted',
                            'ingredientsNotGruoped',
                            // 'ingredients',
                            // 'ingredientsGroups',
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
