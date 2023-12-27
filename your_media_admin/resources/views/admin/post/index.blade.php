@extends('admin.layouts.app')

@section('title')
    <h1 class="card-title">Post Page</h1>
@endsection

@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#postCreate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="postTitle" class="form-control" placeholder="Enter Post Name">
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="postDescription" class="form-control" placeholder="Enter Description" id="" cols="10"
                            rows="0"></textarea>
                        @error('postDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">News</label>
                        <textarea name="postNews" class="form-control" placeholder="Enter News" id="" cols="30" rows="10"></textarea>
                        @error('postNews')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" value="{{ old('postImage') }}" name="postImage" class="form-control">
                        @error('postImage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Category Name</label>
                        <select name="postCategory" id="" class="form-control">
                            <option value="">Choose Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['category_id'] }}">{{ $category['title'] }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
        {{-- alert --}}
        @if (Session::has('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('createSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Session::has('updateSuccess'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ Session::get('updateSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- alert --}}

        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="{{ route('admin#postSearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="postSearch" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Post Name</th>
                            <th>Description</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post['post_id'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['description'] }}</td>
                                <td>
                                    <img class="rounded shadow" width="100px"
                                        @if (!$post['image']) src="{{ asset('default/default_image.jpg') }}"
                                        @else
                                        src="{{ asset('postImage/' . $post['image']) }}" @endif>
                                </td>
                                <td>
                                    <a href="{{ route('admin#postEditPage', $post['post_id']) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#postDelete', $post['post_id']) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end mr-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
