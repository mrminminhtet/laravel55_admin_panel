@extends('admin.layout.auth')

@section('content')
<div class="container">
    <!-- begin login -->
    <div class="login bg-black animated fadeInDown">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand" style="padding-top: 10px!important;padding-bottom: 50px!important;">
                <span><img src="{{asset('images/logo.png')}}" class="img-fluid" width="50%"></span>Color Admin
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end brand -->
        <div class="login-content">
            <form class="margin-bottom-0" role="form" method="POST" action="{{ url('/admin/login') }}">
                {{ csrf_field() }}
                <div class="form-group m-b-20">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus class="form-control input-lg inverse-mode no-border" placeholder="Email Address" required />
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group m-b-20">
                    <input id="password" type="password" name="password" class="form-control input-lg inverse-mode no-border" placeholder="Password" required />
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="checkbox m-b-20">
                    <label>
                        <input type="checkbox" name="remember" /> Remember Me
                    </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                    <a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
    <!-- end login -->
</div>
@endsection
