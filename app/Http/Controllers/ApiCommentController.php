<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class ApiCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // Function Store comment
    public function store(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment = new Comment();
        $comment->comment_body = $request->comment_body;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return response()->json([
            'message' => 'Comment added successfully!',
            'data' => new CommentResource($comment)
        ], 201);
    }

    // Function update comment
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment->comment_body = $request->comment_body;
        $comment->save();

        return response()->json([
            'message' => 'Comment updated successfully!',
            'data' => new CommentResource($comment)
        ]);
    }

    // Function delete comment
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully.']);
    }
}
