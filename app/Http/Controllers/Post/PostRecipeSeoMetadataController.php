<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
// use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Recipe\StoreSeoMetadataRequest;

class PostRecipeSeoMetadataController extends Controller
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
    public function create(User $user, Post $post)
    {
        return view('posts.recipes.metadatas.create', 
                compact(
                    'post'
                ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeoMetadataRequest $request, User $user, Post $post)
    {
// dd($user);
        
        // Retrieve selected hours and minutes from the request
        $prepTimeHours = $request->input('prep_time_hours', 0);
        $prepTimeMinutes = $request->input('prep_time_minutes', 0);
        // Calculate total preparation time in minutes
        $prepTimeInMinutes = ($prepTimeHours * 60) + $prepTimeMinutes;
        $prepTimeInMinutes = $prepTimeInMinutes === 0 ? null : $prepTimeInMinutes;//if 0 convert to NULL


        $cookingTimeHours = $request->input('cooking_time_hours', 0);
        $cookingTimeMinutes = $request->input('cooking_time_minutes', 0);
        $cookingTimeInMinutes = ($cookingTimeHours * 60) + $cookingTimeMinutes;
        $cookingTimeInMinutes = $cookingTimeInMinutes === 0 ? null : $cookingTimeInMinutes;//if 0 convert to NULL

        $prepTimeHours = $request->input('total_time_hours', 0);
        $prepTimeMinutes = $request->input('total_time_minutes', 0);
        $totalPrepTimeInMinutes = ($prepTimeHours * 60) + $prepTimeMinutes;
        $totalPrepTimeInMinutes = $totalPrepTimeInMinutes === 0 ? null : $totalPrepTimeInMinutes;//if 0 convert to NULL
        

        // dd($request->user()->posts());

        $post->postRecipeSeoMetadata()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'cooking_method' => $request->cooking_method,
            'prep_time_minutes' => $prepTimeInMinutes,
            'cooking_time_minutes' => $cookingTimeInMinutes,
            'total_time_minutes' => $totalPrepTimeInMinutes,
            'yield' => $request->yield,
         ]);
 
         return redirect('posts');

        
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
