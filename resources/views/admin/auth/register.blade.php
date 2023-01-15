@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-12 col-xl-6">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3>Sign Up</h3>
                </div>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingText" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <label for="floatingText">Name</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="Email"  name="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required autocomplete="new-password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password_confirmation" required autocomplete="new-password">
                    <label for="floatingPassword">Confirm Password</label>
                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
            </form>

            </div>
        </div>
    </div>
</div>
@endsection
