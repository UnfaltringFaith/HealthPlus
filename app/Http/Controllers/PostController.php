<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(10); // Eager load the user relationship
        return response()->json($posts);
    }

    public function show(Post $post)
    {
        $post->load('user');
        return response()->json($post);
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        // Logic to show the post creation form
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $post = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // Validate image file
            'status' => 'in:draft,published,archived',
            'tags' => 'nullable|array',
        ]);

        
    }
}
