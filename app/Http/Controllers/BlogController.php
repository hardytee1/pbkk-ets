<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Likes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('likes.user')->get();

        return view('dashboard', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'caption' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = $request->file('image_path')->store('uploads', 'public');

        $user = Auth::user();

        $post = new Blog();
        $post->caption = $request->caption;
        $post->image_path = $imagePath;
        $post->user_id = $user->id;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $blogs = $user->blogs;

        return view('bio.show', compact('user', 'blogs'));
    }
    
    public function bio_store(Request $request, User $user)
    {
        $request->validate([
            'bio' => 'required',
        ]);

        $user->update([
            'bio' => $request->bio,
        ]);

        $blogs = $user->blogs;

        return view('bio.show', compact('user', 'blogs'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
        if ($blog->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to edit this blog.');
        }

        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
        if ($blog->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to update this blog.');
        }

        // Validate the request data
        $request->validate([
            'caption' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = $request->file('image_path')->store('uploads', 'public');

        // Update the post with the new data
        $blog->update([
            'caption' => $request->caption,
            'image_path' => $imagePath,
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
        if ($blog->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this post.');
        }
        $blog->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}
