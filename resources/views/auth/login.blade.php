@extends('layouts.app')

@section('title')
    ورود به سیستم -
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">ورود</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @method('post')
                        <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label @lang('platform.input-pull')">ایمیل/شماره همراه</label>

                            <div class="col-md-7">
                                <input id="text" type="text" dir="ltr" class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                @if ($errors->has('login'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label @lang('platform.input-pull')">کلمه عبور</label>

                            <div class="col-md-7">
                                <input id="password" dir="ltr" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ذخیره اطلاعات ورود من
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-mobile">
                                    <i class="fa fa-sign-in"></i>
                                    ورود
                                </button>

                                <a class="btn btn-link btn-mobile" href="{{ route('password.request') }}">
                                    <i class="fa fa-key"></i>
                                    فراموشی رمز عبور
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
