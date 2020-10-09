@extends('auth.template-auth')
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="row align-middle">
            <div class="col-sm-12 col-md-12">
                <nav aria-label="breadcrumb" class="">
                    <ol class="breadcrumb px-0 button_breadcrumb">
                        <li class="breadcrumb-item" style="color: #41B1CD !important;"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                        <li aria-current="page" style="font-weight: bold;">&nbsp;&nbsp;| Sign In</li>
                    </ol> 
                </nav>
            </div>
        </div>
        <div class="row section_content">
            <div class="col-sm-12 mb-5">
                <h1 class="text-center" style="color: #41B1CD; font-weight: bold; font-size: 50px;">Sign In</h1>
                <h6 class="text-center">Use your account</h6>
                <form method="POST" action="{{ route('cust_cek_login') }}">
                    @csrf
                    <div id="card-login" class="contact_card" style="border-radius: 30px;">
                        <div class="card-body">
                            <input type="email" name="email" class="form-control contact_input card-email @error('email') is-invalid @enderror" placeholder="Email" id="email" required autocomplete="off" autofocus value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="hidden" name="role" value="customer">
          
                            <input type="password" name="password" class="form-control contact_input @error('password') is-invalid @enderror" placeholder="Password" id="password" required autocomplete="off" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ route('password.request') }}"><h6 class="text-center">{{ __('Forgot your password?') }}</h6></a>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn btn-lg button_success_block" style="background-color: #C13EB7; padding: 7px 100px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); "><h3 class="text-center" style="color: #fff !important">{{ __('Sign In') }}</h3></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
