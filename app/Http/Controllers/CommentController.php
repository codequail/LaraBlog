<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    // Function store comment
    public function store(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = new Comment();
        $comment->comment_body = $request->comment_body;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    
    }

    // Function edit comment
    public function edit(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $comment->post_id)->with('error', 'Unauthorized access.');
        }

        $post = Post::find($comment->post_id);
        return view('comments.edit', compact('post', 'comment'));
    }

    // Function update comment
    public function update(Request $request, Comment $comment)
    {
        $post = Post::find($comment->post_id);

        // Check if the authenticated user is the owner of the comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $post)->with('error', 'Unauthorized access.');
        }

        // validate request
        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment->comment_body = $request->comment_body;
        $comment->save();

        return redirect()->route('posts.show', $post)->with('success', 'Comment updated successfully.');
    
    }

    // Function delete comment
    public function destroy(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $comment->post_id)->with('error', 'Unauthorized access.');
        }

        // Delete the comment
        $comment->delete();

        // Redirect back to the post
        return redirect()->route('posts.show', $comment->post_id)->with('success!', 'Comment deleted successfully.');
    }

}
