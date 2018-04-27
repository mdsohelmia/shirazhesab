@extends('layouts.app')
@section('title', 'اطلاعات تکمیلی - ')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('cart') }}">سبد خرید</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.information') }}">اطلاعات تکمیلی</a></li>
                </ol>
            </nav>
            <div class="row mb-2">

                <div class="col-md-12">
                    @if(config('platform.cart-type') == 'file')
                        <a href="{{ route('file')  }}" class="btn btn-primary pull-right"><i class="fa fa-shopping-basket"></i> ادامه خرید</a>
                    @endif
                    @if(config('platform.cart-type') == 'order')
                        <a href="{{ route('cart.order')  }}" class="btn btn-primary pull-right"><i class="fa fa-shopping-bag"></i> ادامه خرید</a>
                    @endif
                    @if(config('platform.cart-type') == 'both')
                        <a href="{{ route('file')  }}" class="btn btn-primary pull-right"><i class="fa fa-shopping-basket"></i>خرید محصولات</a>
                        <a href="{{ route('cart.order')  }}" class="btn btn-success pull-right"><i class="fa fa-shopping-bag"></i>خرید فروشگاهی</a>
                    @endif
                    @if(Cart::total() != 0)
                        <button onclick="$('#information').submit();" class="btn btn-warning pull-left"><i class="fa fa-check-circle-o"></i>ثبت اطلاعات و پرداخت</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">اطلاعات تکمیلی</div>

                <div class="card-body">
                    <form method="POST" id="information" action="{{ route('cart.store-information') }}">
                        @csrf
                        @method('post')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label @lang('platform.input-pull')">نام و نام خانوادگی</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',Auth::user()->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label @lang('platform.input-pull')">جنسیت</label>

                            <div class="col-md-7">
                                <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required>
                                    <option value="male"{{ old('gender', Auth::user()->gender) == 'male' ? ' selected' :'' }}>مرد</option>
                                    <option value="female"{{ old('gender', Auth::user()->gender) == 'female' ? ' selected' :'' }}>زن</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
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
                            <label for="phone" class="col-md-4 col-form-label @lang('platform.input-pull')">شماره تماس</label>

                            <div class="col-md-7">
                                <input id="phone" type="text" dir="ltr" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', Auth::user()->mobile) }}" required>

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
                            <label for="address" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس پستی</label>

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
                                    ثبت اطلاعات و پرداخت
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
