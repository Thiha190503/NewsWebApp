@extends('admin.layouts.app')

@section('title')
    <h1 class="card-title">Home</h1>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top rounded shadow h-50"
                            @if (!$post['image']) src="{{ asset('storage/default/default_image.jpg') }}"
                            @else
                            src="{{ asset('postImage/' . $post['image']) }}" @endif>
                        <div class="card-body">
                            <h1 class="card-title mb-3" style="font-size: 24px">{{ $post['title'] }}</h1>
                            <p class="card-text">{{ $post['description'] }}</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><small class="text-muted">2 hours ago</small></p>
                            <a href="{{ Route('admin#newsDetails', $post['post_id']) }}" class="btn btn-primary">Read</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
