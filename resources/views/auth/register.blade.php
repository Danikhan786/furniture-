@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-form-light text-left p-5">
                    <div class="brand-logo">
                        <!-- <img src="{{ asset('backend/assets/images/logo-dark.svg') }}"> -->
                        <h1>Oasis Meubles</h1>
                    </div>
                    <h4>Hello! let's get started</h4>
                    <h6 class="font-weight-light">Create an account to continue.</h6>
                    <form class="pt-3" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputName1"
                                placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name"
                                autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                placeholder="Email" name="email" value="{{ old('email') }}" required
                                autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                placeholder="Password" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="exampleInputPassword2"
                                placeholder="Confirm Password" name="password_confirmation" required
                                autocomplete="new-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">REGISTER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
