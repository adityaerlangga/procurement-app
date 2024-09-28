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
                                <h5 class="mb-0">Create Product</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="/products/create" method="POST" enctype="multipart/form-data" class="px-4">
                            @csrf
                            @method('POST')
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if (Auth::user()->hasRole('ADMIN'))
                            <div class="form-group mt-3">
                                <label for="role">Vendor</label>
                                <select name="vendor_id" id="vendor_id" class="form-control">
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                            @if (Auth::user()->hasRole('VENDOR'))
                            <input type="hidden" name="vendor_id" value="{{ Auth::user()->vendor->id }}">
                            @endif
                           

                            <div class="form-group mt-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter product description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Enter product price" value="{{ old('price') }}" step="0.01">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="image">Product Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn bg-gradient-primary">Create Product</button>
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
