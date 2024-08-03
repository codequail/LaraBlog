@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="body">Body</label>
                <textarea name="body" id="body" class="form-control" rows="10">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Post</button>
        </form>
    </div>
@endsection
