@extends('admin.layouts.app')

@section('content')
    <div class="offset-1 col-10 mt-5">
        <a href="#">
            <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
        </a>
        <div class="card-header">
            <div class="text-center">
                <img class="rounded shadow" width="400px"
                    @if (!$post['image']) src="{{ asset('storage/default/default_image.jpg') }}"
                @else
                src="{{ asset('postImage/' . $post['image']) }}" @endif>
            </div>
        </div>
        <div class="card-body">
            <h1 class="text-center">{{ $post['title'] }}</h1>
            <h4 class="text-center">{{ $post['description'] }}</h4>
            {{-- <h2 class="card-title mb-2">{{ $post->category->title ?? 'No Category' }}</h2> --}}
            <p class="text-center">{{ $post['news'] }}</p>
        </div>
    </div>
@endsection
