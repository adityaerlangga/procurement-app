@extends('layouts.user_type.auth')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="mx-4">
                    @if (session('success'))
                        <div class="alert alert-success text-white" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error') || $errors->any())
                        <div class="alert alert-danger text-white" role="alert">
                            <strong class="mb-2">Error!</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">Edit User</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="/users/{{ $user->id }}/edit" method="POST" class="px-4">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter user name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter user email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="password">Password <small>(leave blank if you don't want to change it)</small></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password (optional)">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password (optional)">
                            </div>

                            <div class="form-group mt-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="ADMIN" {{ $user->role === 'ADMIN' ? 'selected' : '' }}>Admin</option>
                                    <option value="STAFF" {{ $user->role === 'STAFF' ? 'selected' : '' }}>Staff Procurement</option>
                                    <option value="VENDOR" {{ $user->role === 'VENDOR' ? 'selected' : '' }}>Vendor</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn bg-gradient-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.btn-delete-user').click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.form-delete-user-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
