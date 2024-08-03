@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        
        @if($post->user_id == Auth::id())
            <div class="mb-3">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning me-2">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endif
        
        <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-4">Back to Posts</a>

        <h3 class="mt-5">Comments</h3>
        @foreach($post->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $comment->comment_body }}</p>
                    <small class="text-muted">by {{ $comment->user->name }}</small>
                    @if($comment->user_id == Auth::id())
                        <div class="mt-2">
                            <a href="{{ route('comments.edit', [$comment]) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <h3 class="mt-5">Add Comment</h3>
        <form action="{{ route('comments.store', ['post' => $post]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="comment_body" class="form-label">Comment</label>
                <textarea name="comment_body" id="comment_body" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    </div>
@endsection
