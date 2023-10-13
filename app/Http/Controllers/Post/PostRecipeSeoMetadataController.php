<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
// use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\PostRecipeSeoMetadata;
use App\Models\Post\PostRecipeCookingMethod;
use App\Helpers\Post\Recipe\TimeHumanConversionHelper;
use App\Http\Requests\Post\Recipe\StoreSeoMetadataRequest;
use App\Http\Requests\Post\Recipe\UpdateSeoMetadataRquest;

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

        //get all the Cooking methods available
        $recipeCookingMethods = PostRecipeCookingMethod::get();

        return view('posts.recipes.metadatas.create', 
                compact(
                    'post',
                    'recipeCookingMethods',
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

        $totTimeHours = $request->input('total_time_hours', 0);
        $totTimeMinutes = $request->input('total_time_minutes', 0);
        $totalPrepTimeInMinutes = ($totTimeHours * 60) + $totTimeMinutes;
        $totalPrepTimeInMinutes = $totalPrepTimeInMinutes === 0 ? null : $totalPrepTimeInMinutes;//if 0 convert to NULL
        

        // dd($request->user()->posts());

        $post->postRecipeSeoMetadata()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'post_recipe_cooking_method_id' => $request->cooking_method,
            'prep_time_minutes' => $prepTimeInMinutes,
            'cooking_time_minutes' => $cookingTimeInMinutes,
            'total_time_minutes' => $totalPrepTimeInMinutes,
            'yield' => $request->yield,
         ]);

         return redirect()->route('posts')->with('success', 'Cooking information successfully inserted.');

        
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
    public function edit(User $user, Post $post, PostRecipeSeoMetadata $postRecipeSeoMetadata)
    {

        //get all the Cooking methods available
        $recipeCookingMethods = PostRecipeCookingMethod::get();

        
        //here we use the helper to transform the minutes into hours minutes.
        //Ps. I could save a lot of my time if I had added 3 extra fields in order to store minutes and hours for each slot
        $formattedPrepTime = TimeHumanConversionHelper::convertMinutesToHoursAndMinutes($postRecipeSeoMetadata->prep_time_minutes);
        $formattedCookTime = TimeHumanConversionHelper::convertMinutesToHoursAndMinutes($postRecipeSeoMetadata->cooking_time_minutes);
        $formattedTotTime = TimeHumanConversionHelper::convertMinutesToHoursAndMinutes($postRecipeSeoMetadata->total_time_minutes);
        
        return view('posts.recipes.metadatas.edit', 
                compact(
                    'post',
                    'postRecipeSeoMetadata',
                    'recipeCookingMethods',
                    'formattedPrepTime',
                    'formattedCookTime',
                    'formattedTotTime',
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
    public function update(UpdateSeoMetadataRquest $request, User $user, Post $post, PostRecipeSeoMetadata $postRecipeSeoMetadata)
    {
        

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

        $totTimeHours = $request->input('total_time_hours', 0);
        $totTimeMinutes = $request->input('total_time_minutes', 0);
        $totalPrepTimeInMinutes = ($totTimeHours * 60) + $totTimeMinutes;
        $totalPrepTimeInMinutes = $totalPrepTimeInMinutes === 0 ? null : $totalPrepTimeInMinutes;//if 0 convert to NULL
        
        // dd($totalPrepTimeInMinutes);


        $post->postRecipeSeoMetadata()->update([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'post_recipe_cooking_method_id' => $request->cooking_method,
            'prep_time_minutes' => $prepTimeInMinutes,
            'cooking_time_minutes' => $cookingTimeInMinutes,
            'total_time_minutes' => $totalPrepTimeInMinutes,
            'yield' => $postRecipeSeoMetadata->yield,
         ]);


        return redirect()->route('posts')->with('success', 'Cooking information successfully modified.');
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
