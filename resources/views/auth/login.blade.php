@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <div class="brand-logo">
                <!-- <img src="{{asset('backend/assets/images/logo-dark.svg')}}"> -->
                <h1>Oasis Meubles</h1>
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="{{ route('login') }}">
                    @csrf
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
              </div>
              <div class="my-2 d-flex justify-content-between align-items-center">
                
               
              </div>
              <div class="mb-2">
                <a href="{{ route('register') }}" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Create an account</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    
</div>
@endsection
