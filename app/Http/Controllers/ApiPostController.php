<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Resources\PostResource;

class ApiPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    // Function index | returns all posts with User and Comments
    public function index()
    {
        $posts = Post::with('user', 'comments')->latest()->paginate(10);
        return response()->json(['data' => PostResource::collection($posts)]);
    }

    // Function Store post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->save();

        return response()->json([
            'message' => 'Post published successfully!',
            'data' => new PostResource($post)
        ], 201);
    }

    // Function show | returns single post
    public function show(Post $post)
    {
        $post->load('user', 'comments');
        return response()->json(['data' => new PostResource($post)]);
    }

    // Function update | update post
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return response()->json([
            'message' => 'Post updated successfully!',
            'data' => new PostResource($post)
        ]);
    }

    // function delete post
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully.']);
    }
}
