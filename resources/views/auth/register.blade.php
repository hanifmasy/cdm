@extends('layouts.app')
@section('content')
<style>
.alert {
	position: relative;
	padding: .75rem 1.25rem;
	margin-bottom: 1rem;
	border: 1px solid transparent;
	border-radius: .25rem
}

.alert-link {
	font-weight: 700
}

.alert-info {
	color: #0c5460;
	background-color: #d1ecf1;
	border-color: #bee5eb
}

.alert-info hr {
	border-top-color: #abdde5
}

.alert-info .alert-link {
	color: #062c33
}

.alert-warning {
	color: #856404;
	background-color: #fff3cd;
	border-color: #ffeeba
}

.alert-warning hr {
	border-top-color: #ffe8a1
}

.alert-warning .alert-link {
	color: #533f03
}

.alert-danger {
	color: #721c24;
	background-color: #f8d7da;
	border-color: #f5c6cb
}

.alert-danger hr {
	border-top-color: #f1b0b7
}

.alert-danger .alert-link {
	color: #491217
}
</style>
<div class="container sign-up-mode">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="{{ route('register') }}" method="POST" class="sign-up-form">
                {{ csrf_field() }}
                @if($errors->has('name'))
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Warning!</strong>{{ $errors->first('name') }}
                    </div>
                </div>
                @endif
                @if($errors->has('email'))
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Warning!</strong>{{ $errors->first('email') }}
                    </div>
                </div>
                @endif
                @if($errors->has('username'))
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Warning!</strong>{{ $errors->first('username') }}
                    </div>
                </div>
                @endif
                @if($errors->has('password'))
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Warning!</strong>{{ $errors->first('password') }}
                    </div>
                </div>
                @endif
                <img src="{{ asset('public/img/great.png') }}" style="position:absolute;z-index:3;margin-top:-40%;" alt="" width="20%">
                <!-- <h2 class="title">{{ trans('panel.site_title') }}</h2> -->
                <h2 class="title"><img src="{{ asset('public/assets/img/logocuan.png') }}" style="position: absolute;z-index:2;margin-left:-25%;" width="50%" alt=""></h2>
                <div style="padding-top: 20%;"></div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="{{ trans('global.login_username') }}" value="{{ old('username', '') }}" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" required placeholder="{{ trans('global.login_password') }}">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" required placeholder="{{ trans('global.login_password_confirmation') }}">
                </div>
                <button type="submit" class="btn">{{ trans('global.register') }}</button>
            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>Sudah memiliki akun ?</h3>
                <p>
                    Kamu sudah memiliki akun ? Silahkan klik tombol dibawah ini untuk masuk!
                </p>
                <a href="{{ route('register') }}"><button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button></a>
            </div>
            <img src="img/log.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>Sudah memiliki akun ?</h3>
                <p>
                    Kamu sudah memiliki akun ? Silahkan klik tombol dibawah ini untuk masuk!
                </p>
                <a href="{{ route('login') }}">
                    <button class="btn transparent" id="sign-in-btn" style="background-color: #ffffff; color: #b23541">Sign in</button>
                </a>
            </div>
            {{-- <img src="{{ asset('public/assets/login/img/register.png') }}" class="image" alt="" /> --}}
        </div>
    </div>
</div>
@section('scripts')
<script src="{{ asset('public/assets/login/js/app.js') }}"></script>
@endsection
@endsection