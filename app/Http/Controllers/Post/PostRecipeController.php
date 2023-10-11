<?php

namespace App\Http\Controllers\Post;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Post\Recipe\TimeHumanConversionHelper;

class PostRecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Collection of all the recipes
        $posts = Post::with('postImages')->get();
        
        // dd($posts->postRecipeSeoMetadata);

        return view('posts.recipes.index',
                compact('posts',
                ));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $metaPublishedTime = Carbon::parse($post->published_at)->setTimezone('Europe/Madrid')->toIso8601String();
        $metaUpdatedTime = Carbon::parse($post->updated_at)->setTimezone('Europe/Madrid')->toIso8601String();

        $ingredients = $post->postIngredients;

        //TODO: hasManyThrough or eager loading?
        // $methods = $post->postMethodsRecipe;

        //eager loading
        // $methods = Post::with('postMethods', 'postMethodsGroups')->get();


        

        $postMethodsGroups = $post->postMethodsGroups()->get();

        $postMethods = $post->postMethods()->get();

        $postMethods = $post->postMethods()->get();

        $postSeoMetadataRecipeCard = $post->postRecipeSeoMetadata()->first();

        // dd($postSeoMetadataRecipeCard);

        $formattedPrepTime = TimeHumanConversionHelper::formatMinutesToHoursAndMinutes($postSeoMetadataRecipeCard->prep_time_minutes);
        $formattedCookTime = TimeHumanConversionHelper::formatMinutesToHoursAndMinutes($postSeoMetadataRecipeCard->cooking_time_minutes);
        $formattedTotTime = TimeHumanConversionHelper::formatMinutesToHoursAndMinutes($postSeoMetadataRecipeCard->total_time_minutes);

        // TODO: move this to a sirvece (app/Services/Recipe/JsonLd/It/JsonLdService.php) 
        // Creating the JSON-LD object for the SEO

        $jsonLdObject = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "Article",
                    "@id" => url('/recipes/'.$post->slug) . '/#article',
                    "isPartOf" => [
                        "@id" => url('/recipes/'.$post->slug)
                    ],
                    "author" => [
                        "name" => "Roberto",
                        "@id" => url('/recipes/'.$post->slug) . '/#/schema/person/f2ec3b8956be0c3431af79ad7e71d6b5'
                    ],
                    "headline" => $post->title,
                    "datePublished" => $metaPublishedTime,
                    "dateModified" => $metaUpdatedTime,
                    "wordCount" => 960,
                    "commentCount" => 723,
                    "publisher" => [
                        "@id" => "https://www.gimmesomeoven.com/#organization"
                    ],
                    "image" => [
                        "@id" => "https://www.gimmesomeoven.com/rosemary-focaccia-bread/#primaryimage"
                    ],
                    "thumbnailUrl" => "https://www.gimmesomeoven.com/wp-content/uploads/2017/03/Rosemary-Focaccia-Bread-Recipe-1-2.jpg",
                    "articleSection" => [
                        "Baked Goods / Breads",
                        "Italian-Inspired"
                    ],
                    "inLanguage" => "en-US",
                    "potentialAction" => [
                        [
                            "@type" => "CommentAction",
                            "name" => "Comment",
                            "target" => [
                                "https://www.gimmesomeoven.com/rosemary-focaccia-bread/#respond"
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        
        $postMethod = $post->postMethodsRecipe()->first();//to get the method through the postMethodGroup model
        
        $jsonLd = [];//empty in case we haven't placed the methods yet 

        if ($postMethod) {//if empty I get an error
            $recipeInstructions = [];
        
            //The methods are collected in one record, separated from a line break. 
            //Easier to insert and change in the future. However we need to explode the paragraphs:
            $methods = explode("\r\n", $postMethod->method);

            //methods is an array, with some empty values, because we removed the line break above
            foreach ($methods as $index => $instruction) {
                
                if (!empty($instruction)) {//we only want to text (each element of this array)
                    $instructions[] = $instruction;

                    //The text a title (the opening sentece is the MOTEHOD TITLE)
                    //
                    if (trim($instruction) !== '') {
                        $title = Str::before($instruction, '.') . '.';
                        $content = Str::after($instruction, '.');
                    }
                
                    // Create the JSON-LD instruction object
                    $instruction = [
                        '@type' => 'HowToStep',
                        'name' => $title,
                        'text' => $content,
                        'url' => url('/recipes/'.$post->slug.'/instruction-step-'.floor($index / 2) + 1),
                        // Add additional properties as needed
                    ];
                    
                    // Add the instruction to the recipe instructions array
                    $recipeInstructions[] = $instruction;
                }
            
            }


            $jsonLdData = [
                // Other properties
                'recipeInstructions' => $recipeInstructions,
                // Other properties
            ];
            
            // Convert the array to JSON format
            $jsonLd = json_encode($jsonLdData);

            // dd($jsonLd);

            // $jsonDjsonLdata = $this->generateRecipeJson(); // Your logic to generate the JSON data

            // Store the JSON data in a file
            // $filePath = public_path('jsonld/recipe.json');
            // File::put($filePath, $jsonLdData);

        } else {//If methods are empty I give an empty array
            $jsonLd = json_encode($jsonLd);
        }

        //Get rating recipe  
        $averageRating = $post->postComments->avg('recipe_rating');
        $averageRatingFormatted  = number_format($averageRating, 1);// 4.1

        //Get 
        $commentsWithRatingCount = $post->postComments->filter(function ($comment) {
            return !is_null($comment->recipe_rating);
        })->count();

        // $commentsWithRatingCount = $post->postComments->where('recipe_rating', !null)->count();
        
        $commentsWithRatingCount = $post->postComments->whereNotNull('recipe_rating')->count();

        // dd($commentsWithRatingCount);

        // dd($methods);
        return view('posts.recipes.show',
                compact('post',
                        'metaPublishedTime',
                        'metaUpdatedTime',
                        'ingredients',
                        // 'methods',
                        'postMethods',
                        'postMethodsGroups',
                        'formattedPrepTime',
                        'formattedCookTime',
                        'formattedTotTime',
                        'jsonLd',
                        'averageRatingFormatted',
                        'commentsWithRatingCount',
                ));
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
