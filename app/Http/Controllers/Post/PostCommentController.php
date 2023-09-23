<?php

namespace App\Http\Controllers\Post;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Post\PostComment;
use App\Mail\Users\NotifyComment;
use App\Models\User\CookieConsent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\Post\Comment\StoreCommentRequest;

class PostCommentController extends Controller
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
    public function create(request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request, Post $post)
    {

        

        $user_id = auth()->user() ? auth()->user()->id : null;
        $email = $request->email;

        //set name/email cookies
        if ($request->cookies_consent == 1) {
            // Set cookies for name and email
            Cookie::queue('comment_author_name', $request->name, 347 * 24 * 60);  // 347 days
            Cookie::queue('comment_author_email', $request->email, 347 * 24 * 60);

            //TODO: on production use ->secure()
            //Cookie::queue('comment_author_email', $request->email, 347 * 24 * 60)->secure();
            //this will make cookies working only under https (secure server connection)

            
            // Check if a cookie consent record already exists for this email or user_id
            $cookieConsent = CookieConsent::where(function ($query) use ($email, $user_id) {
                $query->where('email', $email);
                if ($user_id !== null) {
                    $query->orWhere('user_id', $user_id);
                }
            })->first();

            if (!$cookieConsent) {// create user cookie
                CookieConsent::create([
                    'user_id' => $user_id,
                    'email' => $request->email,
                    'comment_consent' => $request->cookies_consent,
                    'comment_consent_at' => Carbon::now(),
                ]);
            }
        }


        if ($request->notify_on_reply == 1) {
            //send email to the user who wrote the comment when I (admin) replies to this comment
        }

        


        //TODO: add cookie_consent_id if user consents
        $post->postComments()->create([
            'parent_id' => NULL,
            'post_id' => $post->id,
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'user_ip' => $request->ip(),
            'recipe_rating' => $request->rating,
            'name' => $request->name,
            'email' => $request->email,
            'link' => $request->link,
            'comment' => $request->comment,
            'notify_on_reply' => $request->notify_on_reply,
         ]);
         

        // Return a JSON response indicating success
        // return response()->json(['success' => true]);
        return ['success' => true];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply(StoreCommentRequest $request, Post $post, PostComment $id)
    {
        dd($id);
        $user_id = auth()->user() ? auth()->user()->id : null;
        $email = $request->email;

        //set name/email cookies
        if ($request->cookies_consent == 1) {
            // Set cookies for name and email
            Cookie::queue('comment_author_name', $request->name, 347 * 24 * 60);  // 347 days
            Cookie::queue('comment_author_email', $request->email, 347 * 24 * 60);

            //TODO: on production use ->secure()
            //Cookie::queue('comment_author_email', $request->email, 347 * 24 * 60)->secure();
            //this will make cookies working only under https (secure server connection)

            
            // Check if a cookie consent record already exists for this email or user_id
            $cookieConsent = CookieConsent::where(function ($query) use ($email, $user_id) {
                $query->where('email', $email);
                if ($user_id !== null) {
                    $query->orWhere('user_id', $user_id);
                }
            })->first();

            if (!$cookieConsent) {// create user cookie
                CookieConsent::create([
                    'user_id' => $user_id,
                    'email' => $request->email,
                    'comment_consent' => $request->cookies_consent,
                    'comment_consent_at' => Carbon::now(),
                ]);
            }
        }

        $post->postComments()->create([
            'parent_id' => $id, // this is comment_id (parent)
            'post_id' => $post->id,
            'user_id' => $user_id,
            'user_ip' => $request->ip(),
            'recipe_rating' => $request->rating,
            'name' => $request->name,
            'email' => $email,
            'link' => $request->link,
            'comment' => $request->comment,
            'notify_on_reply' => $request->notify_on_reply,           
         ]);

        // Getting comment object and use for sending the email to the user 

        //BUG: need to check if you replying to a parent comment or a child
        //This will work if you are replying to a parent comment
        $comment = PostComment::where('id', $id)
                                ->where('post_id', $post->id)
                                ->where('notify_on_reply', 1)
                                ->first();
        dd($comment);
         
        if (auth()->user()->role->name === 'Admin' && $comment) {
            
            //send email to the user who wrote the comment
            Mail::to(auth()->user()->email)->send(new NotifyComment($post, $comment));

            //TODO: we need to check if user read the email we sent or not
         }

        // Return a JSON response indicating success
        // return response()->json(['success' => true]);
        return ['success' => true];
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
