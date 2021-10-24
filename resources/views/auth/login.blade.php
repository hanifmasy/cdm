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

.btn-block {
	display: block;
	width: 73%
}

.btn-block+.btn-block {
	margin-top: .5rem
}

input[type=button].btn-block,
input[type=reset].btn-block,
input[type=submit].btn-block {
	width: 100%
}
a:link    { color: white; text-decoration: none; }
a:visited { color: white; text-decoration: none; }
a:hover   { color: white; text-decoration: none; }
a:active  { color: white; text-decoration: none; }
</style>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="{{ route('login') }}" method="POST" class="sign-in-form">
                @csrf
                @if(session()->has('message'))
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Warning! </strong>{{ session()->get('message') }}
                    </div>
                </div>
                @endif
                @if($errors->has('username'))
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <strong>Warning! </strong>{{ $errors->first('username') }}
                    </div>
                </div>
                @endif
                @if($errors->has('password'))
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <strong>Warning! </strong>{{ $errors->first('password') }}
                    </div>
                </div>
                @endif
                <!-- <img src="{{ asset('public/img/great.png') }}" style="position:absolute;z-index:3;margin-top:-35%" alt="" width="35%"> -->
								<img src="{{ asset('public/img/epic_logo.png') }}" style="position:absolute;z-index:3;margin-bottom:50%" width="50%">
                <!-- <h2 class="title">{{ trans('panel.site_title') }}</h2> -->
                <!-- <h2 class="title"><img src="{{ asset('public/assets/img/logocuan.png') }}" width="100%" alt=""></h2> -->
                <br><br>
                <div class="input-field" style="position:absolute;z-index: 4;margin-top:0">
                    <i class="fas fa-user"></i>
                    <input id="username" type="text" required autofocus placeholder="{{ trans('global.login_username') }}" name="username" value="{{ old('username', null) }}">
                </div>
                <div class="input-field" style="position:absolute;z-index: 4;margin-top:20%">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" name="password" required placeholder="{{ trans('global.login_password') }}">
                </div>
                <button type="submit" class="btn solid btn-block btn-sm" style="width:58%;margin-top:69%;">{{ trans('global.login') }}</button>
                <div class="row">
                    <button class="btn solid btn-block btn-sm" style="float: left" id="sign-up-btn" onclick="window.location.href='{{ route('register') }}'" style="background-color: #23d9d3;">Daftar</button>
                    <button class="btn btn-sm" onclick="window.location.href='{{ route('password.request') }}'" style="background-color: #ff8000; float: right; margin-left: 15px">{{ trans('global.forgot_password') }}</button>
                </div>

            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h1>Halo</h1>
                <h1>Selamat Datang!</h1>
                <p>
                    Jangan lupa menggunakan masker,
                    serta menjalankan protokol kesehatan
                    dimanapun anda berada!
                </p>
                <p>#staysafe #stayhealth</p>
            </div>
            {{-- <div class="content" style="margin-bottom: -100px">
                <br>
                <h3>Pendatang baru ?</h3>
                <p>
                    Kamu belum memiliki akun ? Silahkan klik tombol dibawah ini untuk mendaftar!
                </p>
                <a href="{{ route('register') }}"><button class="btn transparent" id="sign-up-btn">
                    Sign up
                </button></a>
            </div> --}}
            {{-- <img src="{{ asset('public/assets/login/img/log.png') }}" class="image" alt="" /> --}}
        </div>
        {{-- <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                    laboriosam ad deleniti.
                </p>
                <a href="{{ route('login') }}"><button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button></a>
            </div>
            <img src="{{ asset('public/assets/login/img/register.png') }}" class="image" alt="" />
        </div>
    </div> --}}
</div>
@section('scripts')
<script src="{{ asset('public/assets/login/js/app.js') }}"></script>
@endsection
@endsection
