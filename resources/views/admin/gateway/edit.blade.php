@extends('layouts.app')
@section('title', 'ویرایش واسط:' . $gateway->title . " - ")
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.sidebar')
        </div>
        <div class="col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">مدیریت سیستم</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.gateway') }}">واسط پرداخت</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش واسط:{{ $gateway->title }}</li>
                </ol>
            </nav>
            <div class="card card-default">
                <div class="card-header">ویرایش واسط:{{ $gateway->title }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.gateway.update', [$gateway->id]) }}">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $gateway->title) }}" required autofocus>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="code">کد پرداخت آزاد</label>
                            <input id="code" dir="ltr" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code', $gateway->code) }}" required>
                            @if ($errors->has('code'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">توضیحات</label>

                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description"> {{ old('description', $gateway->description) }}</textarea>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="user_id">کاربر</label>

                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">بدون کاربر</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"{{ old('user_id', $gateway->user_id) == $user->id  ? ' selected' : '' }}>{{$user->name}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('user_id'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="gateway">درکاه پرداخت</label>

                            <select name="gateway" id="gateway" class="form-control">
                                @foreach(config('gateway') as $key => $payment_gateway)
                                    @if(isset($payment_gateway['enable']))
                                        @if($payment_gateway['enable'] == 'yes')
                                            <option value="{{$key}}"{{ old('gateway', $gateway->gateway) == $key  ? ' selected' : '' }}>{{$payment_gateway['title']}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('gateway'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gateway') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="enable">فعال</label>

                            <select name="enable" id="enable" class="form-control">
                                <option value="yes"{{ old('enable', $gateway->enable) == 'yes'  ? ' selected' : '' }}>بله</option>
                                <option value="no"{{ old('enable', $gateway->enable) == 'no' ? ' selected' : '' }}>خیر</option>
                            </select>
                            @if ($errors->has('enable'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('enable') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="verity">تایید</label>

                            <select name="verity" id="enable" class="form-control">
                                <option value="yes"{{ old('verity', $gateway->verity) == 'yes'  ? ' selected' : '' }}>بله</option>
                                <option value="no"{{ old('verity', $gateway->verity) == 'no' ? ' selected' : '' }}>خیر</option>
                            </select>
                            @if ($errors->has('verity'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('verity') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="payment_password">رمز پرداخت</label>
                            <input id="payment_password" type="text" dir="ltr" class="form-control{{ $errors->has('payment_password') ? ' is-invalid' : '' }}" name="payment_password" value="{{ old('payment_password', $gateway->payment_password) }}" required>
                            @if ($errors->has('payment_password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('payment_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="callback_password">رمز بازگشت</label>
                            <input id="callback_password" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="callback_password" value="{{ old('callback_password', $gateway->callback_password) }}" dir="ltr" required>
                            @if ($errors->has('callback_password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('callback_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="website">وب سایت</label>
                            <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ old('website', $gateway->website) }}" dir="ltr">
                            @if ($errors->has('website'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="callback_hook">هوک بازگشت</label>
                            <input id="callback_hook" type="text" class="form-control{{ $errors->has('callback_hook') ? ' is-invalid' : '' }}" name="callback_hook" value="{{ old('callback_hook', $gateway->callback_hook) }}" dir="ltr">
                            @if ($errors->has('callback_hook'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('callback_hook') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            ویرایش واسط پرداخت
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
