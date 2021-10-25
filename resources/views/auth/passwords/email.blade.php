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
</style>
<div class="container sign-in-mode">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="{{ route('password.email') }}" method="POST" class="sign-in-form">
                @csrf
                @if(session('status'))
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Warning!</strong> {{ session('status') }}
                    </div>
                </div>
                @endif
                @if($errors->has('email'))
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <strong>Warning!</strong>{{ $errors->first('email') }}
                    </div>
                </div>
                @endif
                <img src="{{ asset('public/img/epic_logo.png') }}" style="position:absolute;z-index:3;margin-top:-34%;" alt="" width="30%">
                <!-- <h2 class="title">{{ trans('panel.site_title') }}</h2> -->
                <!-- <h2 class="title"><img src="{{ asset('public/assets/img/logocuan.png') }}" style="position: absolute;z-index:2;margin-left:-30%;margin-top:-10%;" width="60%" alt=""></h2> -->
                <br><br>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">
                </div>
                <button class="btn solid btn-block">Submit</button>
            </form>
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>Pendatang baru ?</h3>
                <p>
                    Kamu belum memiliki akun ? Silahkan klik tombol dibawah ini untuk mendaftar!
                </p>
                <a href="{{ route('register') }}"><button class="btn transparent" style="background-color: #ffffff; color: #b23541">
                    Sign up
                </button></a>
            </div>
            {{-- <img src="{{ asset('public/assets/login/img/log.png') }}" class="image" alt="" /> --}}
        </div>
        <div class="panel right-panel">
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
            {{-- <img src="{{ asset('public/assets/login/img/register.png') }}" class="image" alt="" /> --}}
        </div>
    </div>
</div>
@section('scripts')
<script src="{{ asset('public/assets/login/js/app.js') }}"></script>
@endsection
