<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Function index | show all posts
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    // Function ajax search | search posts
    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%$query%")
                    ->orWhere('body', 'LIKE', "%$query%")
                    ->get();

        return response()->json($posts);
    }

    // Function create posts
    public function create()
    {
        return view('posts.create');
    }

    // Function store posts
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');

    }

    // Function show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Function edit post
    public function edit(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        return view('posts.edit', compact('post'));
    }

    // Function update post
    public function update(Request $request, Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    
    }

    // Function delete post
    public function destroy(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    
    }
}
