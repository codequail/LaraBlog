@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <h1>Featured Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($post->body, 100) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                                @if($post->user_id == Auth::id())
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
