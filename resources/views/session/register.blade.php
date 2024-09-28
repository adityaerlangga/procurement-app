@extends('layouts.user_type.guest')

@section('content')

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
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
                                            @if (session('error'))
                                                <li>{{ session('error') }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome!</h3>
                                    <p class="mb-0">Create account for new vendor account<br></p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="/register">
                                        @csrf
                                        <label>Vendor Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name') }}" placeholder="Vendor Name"
                                                aria-label="Vendor Name" aria-describedby="name-addon">
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Address</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="address" id="address"
                                                value="{{ old('address') }}" placeholder="Address" aria-label="Address"
                                                aria-describedby="address-addon">
                                            @error('address')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ old('email') }}" placeholder="Email" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-check form-check-info text-left">
                                            <input class="form-check-input" type="checkbox" name="agreement"
                                                id="flexCheckDefault" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="javascript:;"
                                                    class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                            @error('agreement')
                                                <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions,
                                                    then try register again.</p>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Do you have an account?
                                        <a href="login" class="text-info text-gradient font-weight-bold">Sign in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
