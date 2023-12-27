@extends('admin.layouts.app')

@section('title')
    <h1 class="card-title">Post Page</h1>
@endsection


@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#postUpdate', $postDetails['post_id']) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="postTitle" class="form-control" placeholder="Enter Post Name"
                            value="{{ old('postTitle', $postDetails['title']) }}">
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="postDescription" class="form-control" placeholder="Enter Description" id="" cols="10"
                            rows="0">{{ old('postDescription', $postDetails['description']) }}</textarea>
                        @error('postDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">News</label>
                        <textarea name="postNews" class="form-control" placeholder="Enter News" id="" cols="30" rows="10">{{ old('postNews', $postDetails['news']) }}</textarea>
                        @error('postNews')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <img class="rounded shadow" width="100%"
                            @if ($postDetails['image'] == null) src="{{ asset('storage/default/default_image.jpg') }}"
                            @else
                            src="{{ asset('postImage/' . $postDetails['image']) }}" @endif>
                        <input type="file" name="postImage" class="form-control" value="">
                        @error('postImage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Category Name</label>
                        <select name="postCategory" id="" class="form-control">
                            <option value="">Choose Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['category_id'] }}"
                                    @if ($category['category_id'] == $postDetails['category_id']) selected @endif>{{ $category['title'] }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-7">
        <div class="card-header">
            <div class="text-center">
                <img class="rounded shadow" width="400px"
                    @if (!$detailPost['image']) src="{{ asset('storage/default/default_image.jpg') }}"
                @else
                src="{{ asset('postImage/' . $detailPost['image']) }}" @endif>
            </div>
        </div>
        <div class="card-body">
            <h1 class="text-center">{{ $detailPost['title'] }}</h1>
            <h4 class="text-center">{{ $detailPost['description'] }}</h4>
            <p class="text-center">{{ $detailPost['news'] }}</p>
        </div>
    </div>
@endsection
