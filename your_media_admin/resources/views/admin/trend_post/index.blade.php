@extends('admin.layouts.app')

@section('title')
    <h3 class="card-title">Admin List Page</h3>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>View Count</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item['post_id'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>
                                    <img class="rounded shadow" width="100px"
                                        @if (!$item['image']) src="{{ asset('storage/default/default_image.jpg') }}"
                                        @else
                                        src="{{ asset('postImage/' . $item['image']) }}" @endif>
                                </td>
                                <td>
                                    <i class="fa-solid fa-eye"></i> {{ $item['post_count'] }}
                                </td>
                                <td>
                                    {{-- <a href="{{ route('admin#trendPostDetails', $item['post_id']) }}">
                                        <button class="btn btn-sm bg-dark text-white">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </button>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- <div class="d-flex justify-content-end mr-5">
                    {{ $post->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
