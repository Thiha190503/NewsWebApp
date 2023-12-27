@extends('admin.layouts.app')

@section('title')
    <h3 class="card-title">Admin List Page</h3>
@endsection

@section('content')
    @if (Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('deleteSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="{{ route('admin#accountSearch') }}" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="accountSearch" class="form-control float-right"
                                placeholder="Search">
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin['id'] }}</td>
                                <td>{{ $admin['name'] }}</td>
                                <td>{{ $admin['email'] }}</td>
                                <td>{{ $admin['phone'] }}</td>
                                <td>{{ $admin['address'] }}</td>
                                <td>{{ $admin['gender'] }}</td>
                                <td>
                                    @if ($admin['id'] != Auth::user()->id)
                                        <a href="{{ route('admin#accountDelete', $admin['id']) }}">
                                            <button class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end mr-5">
            {{ $admins->links() }}
        </div>
    </div>
@endsection
