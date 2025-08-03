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

        if($request->hasFile('image')){
            $path = $request->file('image')->store('images/posts', 'public');
            $post['image'] = $path;
        }

        $createdPost = Post::create([
            'title' => $post['title'],
            'content' => $post['content'],
            'user_id' => $request->user()->id, // Associate the post with the authenticated user
            'category' => $post['category'],
            'image' => $post['image'] ?? null,
            'status' => $post['status'] ?? 'draft',
            'tags' => json_encode($post['tags'] ?? []),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Post created successfully', 'post_id' => $createdPost->id], 201);
    }

    public function like(Post $post)
    {
        $post->increment('rating'); // Increment the rating for the post
        // Logic to like a post
        return response()->json(['message' => 'Post liked successfully', 'rating' => $post->rating]);
    }

    public function dislike(Post $post)
    {
        $post->increment('rating', -1); // Decrement the rating for the post
        // Logic to dislike a post
        return response()->json(['message' => 'Post disliked successfully', 'rating' => $post->rating]);
    }
}
