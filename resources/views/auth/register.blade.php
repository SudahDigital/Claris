@extends('auth.template-auth')
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li aria-current="page" style="font-weight: bold;">&nbsp;&nbsp;| Register</li>
                    </ol> 
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 mb-5">
                <h1 class="text-center" style="color: #41B1CD; font-weight: bold; font-size: 50px;">Sign Up</h1>
                <h6 class="text-center">Use your account</h6>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div id="card-register" class="contact_card" style="border-radius: 30px;">
                        <div class="card-body">
                            <input type="text" name="name" class="form-control contact_input card-form-regis @error('name') is-invalid @enderror" placeholder="Nama" id="name" required autocomplete="off" autofocus value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="hidden" name="role" value="customer">

                            <input type="email" name="email" class="form-control contact_input card-form-regis @error('email') is-invalid @enderror" placeholder="Email" id="email" required autocomplete="off" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="password" name="password" class="form-control contact_input card-form-regis @error('password') is-invalid @enderror" placeholder="Password" id="password" required autocomplete="off" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="password" name="password_confirmation" class="form-control contact_input" placeholder="Konfirmasi Password" id="password-confirm" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group mt-3 text-center">
                        <button type="submit" class="btn btn btn-primary btn-lg button_success_block" style="background-color: #41B1CD; padding: 20px 100px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); ">{{ __('Sign Up') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
@endsection
