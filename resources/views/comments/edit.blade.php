@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <div class="container">
        <h1>Edit Comment</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="comment_body">Comment</label>
                <textarea name="comment_body" id="comment_body" class="form-control">{{ old('comment_body', $comment->comment_body) }}</textarea>
                @error('comment_body')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Comment</button>
        </form>
    </div>
@endsection
