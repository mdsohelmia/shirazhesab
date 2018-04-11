@extends('layouts.app')
@section('title', 'مشخصات کاربری - ')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('profile') }}">مشخصات کاربری</a></li>
                </ol>
            </nav>
        </div>
    </div>
    
    @if(Auth::user()->verified =='created' || Auth::user()->verified =='rejected' || Auth::user()->verified =='waiting')
    <div class="row justify-content-center mb-2">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">مشخصات کاربری</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile') }}">
                        @csrf
                        @method('post')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label @lang('platform.input-pull')">نام و نام خانوادگی</label>

                            <div class="col-md-7">
                                <input id="name" readonly type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',Auth::user()->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس ایمیل</label>

                            <div class="col-md-7">
                                <input id="email" type="email" dir="ltr" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',Auth::user()->email) }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label @lang('platform.input-pull')">شماره همراه</label>

                            <div class="col-md-7">
                                <input id="mobile" type="text" dir="ltr" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile',Auth::user()->mobile) }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    بروز رسانی پروفایل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">مشخصات تکمیلی</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('information') }}">
                        @csrf
                        @method('post')

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label @lang('platform.input-pull')">جنسیت</label>

                            <div class="col-md-7">
                                <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required>
                                    <option value="male"{{ old('gender', Auth::user()->gender) == 'male' ? ' selected' :'' }}>مرد</option>
                                    <option value="female"{{ old('gender', Auth::user()->gender) == 'female' ? ' selected' :'' }}>زن</option>
                                </select>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="national_code" class="col-md-4 col-form-label @lang('platform.input-pull')">کد ملی</label>

                            <div class="col-md-7">
                                <input id="national_code" type="text" dir="ltr" class="form-control{{ $errors->has('national_code') ? ' is-invalid' : '' }}" name="national_code" value="{{ old('national_code',Auth::user()->national_code) }}" required>

                                @if ($errors->has('national_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('national_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_certificate_code" class="col-md-4 col-form-label @lang('platform.input-pull')">شماره شناسنامه</label>

                            <div class="col-md-7">
                                <input id="birth_certificate_code" type="text" dir="ltr" class="form-control{{ $errors->has('birth_certificate_code') ? ' is-invalid' : '' }}" name="birth_certificate_code" value="{{ old('birth_certificate_code',Auth::user()->birth_certificate_code) }}" required>

                                @if ($errors->has('birth_certificate_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birth_certificate_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label @lang('platform.input-pull')">تلفن ثابت</label>

                            <div class="col-md-7">
                                <input id="phone" type="text" dir="ltr" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label @lang('platform.input-pull')">کد پستی</label>

                            <div class="col-md-7">
                                <input id="zip_code" type="text" dir="ltr" class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}" name="zip_code" value="{{ old('zip_code', Auth::user()->zip_code) }}" required>

                                @if ($errors->has('zip_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس</label>

                            <div class="col-md-7">
                                <textarea class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="" required>{{ old('address', Auth::user()->address) }}</textarea>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    تکمیل مشخصات
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(Auth::user()->verified =='verified')
        <div class="alert alert-info">
            با توجه به تایید شدن حساب کاربری شما، برای تغییر مشخصات از طریق سیستم پشتیبانی و ارسال تیکت اقدام فرمایید.
        </div>

        <div class="row justify-content-center mb-2">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header">مشخصات کاربری</div>

                    <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label @lang('platform.input-pull')">نام و نام خانوادگی</label>

                                <div class="col-md-7">
                                    <input id="name" readonly type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',Auth::user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس ایمیل</label>

                                <div class="col-md-7">
                                    <input id="email" readonly type="email" dir="ltr" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',Auth::user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label @lang('platform.input-pull')">شماره همراه</label>

                                <div class="col-md-7">
                                    <input id="mobile" readonly type="text" dir="ltr" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile',Auth::user()->mobile) }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header">مشخصات تکمیلی</div>

                    <div class="card-body">

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label @lang('platform.input-pull')">جنسیت</label>

                                <div class="col-md-7">
                                    <select readonly class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required>
                                        <option value="male">مرد</option>
                                        <option value="female">زن</option>
                                    </select>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="national_code" class="col-md-4 col-form-label @lang('platform.input-pull')">کد ملی</label>

                                <div class="col-md-7">
                                    <input readonly id="national_code" type="text" dir="ltr" class="form-control{{ $errors->has('national_code') ? ' is-invalid' : '' }}" name="national_code" value="{{ old('national_code',Auth::user()->national_code) }}" required>

                                    @if ($errors->has('national_code'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('national_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birth_certificate_code" class="col-md-4 col-form-label @lang('platform.input-pull')">شماره شناسنامه</label>

                                <div class="col-md-7">
                                    <input readonly id="birth_certificate_code" type="text" dir="ltr" class="form-control{{ $errors->has('birth_certificate_code') ? ' is-invalid' : '' }}" name="birth_certificate_code" value="{{ old('birth_certificate_code',Auth::user()->birth_certificate_code) }}" required>

                                    @if ($errors->has('birth_certificate_code'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birth_certificate_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label @lang('platform.input-pull')">تلفن ثابت</label>

                                <div class="col-md-7">
                                    <input readonly id="phone" type="text" dir="ltr" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone',Auth::user()->phone) }}" required>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس</label>

                                <div class="col-md-7">
                                    <textarea readonly class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="" required>{{ old('address',Auth::user()->address) }}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
