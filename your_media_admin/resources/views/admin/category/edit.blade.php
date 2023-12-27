@extends('admin.layouts.app')

@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#categoryUpdate', $oldData['category_id']) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="categoryName" class="form-control" placeholder="Enter Category Name"
                            value="{{ old('categoryName', $oldData['title']) }}">
                        @error('categoryName')
                            <div class="text-danger">{{ message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="categoryDescription" class="form-control" placeholder="Enter Description" id="" cols="30"
                            rows="10">{{ old('categoryDescription', $oldData['description']) }}
                        </textarea>
                        @error('categoryDescription')
                            <div class="text-danger">{{ message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin List Page</h3>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category['category_id'] }}</td>
                                <td>{{ $category['title'] }}</td>
                                <td>{{ $category['description'] }}</td>
                                <td>
                                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm bg-danger text-white"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
