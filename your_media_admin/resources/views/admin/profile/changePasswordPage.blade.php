@extends('admin.layouts.app')

@section('title')
    <legend class="text-center">Change Password Page</legend>
@endsection

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            @if (Session::has('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('fail') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal ps-5" method="post" action="{{ route('admin#changePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-3 col-form-label">Old Password</label>
                                    <div class="col-6">
                                        <input type="password" name="oldPassword" class="form-control" id="inputName"
                                            placeholder="Enter Your Old Password...">
                                        @error('oldPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-3 col-form-label">New Password</label>
                                    <div class="col-6">
                                        <input type="password" name="newPassword" class="form-control" id="inputEmail"
                                            placeholder="Enter Your New Password...">
                                        @error('newPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail" class="col-3 col-form-label">Confirm Password</label>
                                    <div class="col-6">
                                        <input type="password" name="confirmPassword" class="form-control" id="inputEmail"
                                            placeholder="Enter Your Confirm Password...">
                                        @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn bg-dark text-white">Change Password</button>
                            </div>
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
