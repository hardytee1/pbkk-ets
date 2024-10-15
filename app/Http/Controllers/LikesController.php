<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Blog $blog)
    {
        //
        $user = Auth::user();
        $like = Likes::where('blog_id', $blog->id)->where('user_id', $user->id)->first();
    
        if ($like) {
            $like->delete();
            $blog->decrement('like_count'); // Decrement like count directly in database
            $message = 'Post unliked successfully!';
        } else {
            $like = new Likes();
            $like->blog_id = $blog->id;
            $like->user_id = $user->id;
            $like->save();
            $blog->increment('like_count'); // Increment like count directly in database
            $message = 'Post liked successfully!';
        }
    
        return redirect()->route('dashboard')->with('success', $message);
    }

    public function bio_store(Blog $blog)
    {
        //
        $user = Auth::user();
        $like = Likes::where('blog_id', $blog->id)->where('user_id', $user->id)->first();
    
        if ($like) {
            $like->delete();
            $blog->decrement('like_count'); // Decrement like count directly in database
            $message = 'Post unliked successfully!';
        } else {
            $like = new Likes();
            $like->blog_id = $blog->id;
            $like->user_id = $user->id;
            $like->save();
            $blog->increment('like_count'); // Increment like count directly in database
            $message = 'Post liked successfully!';
        }

        $user_bio = $blog->user;

        return redirect()->route('bio.show', ['id' => $user_bio->id])->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Likes $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Likes $likes)
    {
        //
    }
}
