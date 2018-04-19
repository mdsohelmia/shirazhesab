@extends('layouts.app')
@if(Request::segment(4) == 'income')
    @section('title', 'ثبت درآمد - ')
@elseif(Request::segment(4) == 'expense')
    @section('title', 'ثبت هزینه - ')
@endif
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css"/>
@endsection
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.transaction') }}">تراکنش ها</a></li>
                        @if(Request::segment(4) == 'income')
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.transaction.create.income') }}"> ثبت درآمد</a></li>
                        @elseif(Request::segment(4) == 'expense')
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.transaction.create.expense') }}"> ثبت هزینه</a></li>
                        @endif

                    </ol>
                </nav>
                <div class="card card-default">
                    <div class="card-header">
                        @if(Request::segment(4) == 'income')
                            ثبت درآمد
                        @elseif(Request::segment(4) == 'expense')
                            ثبت هزینه
                        @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.transaction.insert') }}" onsubmit="$('#amount').unmask();">
                            @csrf
                            @method('post')
                            @if(Request::segment(4) == 'income')
                                <input type="hidden" name="type" value="income" />
                            @elseif(Request::segment(4) == 'expense')
                                <input type="hidden" name="type" value="expense" />
                            @endif
                            <div class="form-group">
                                <label for="amount">مبلغ</label>
                                <div class="input-group mb-2 ml-sm-2">
                                    <input id="amount" type="text" dir="ltr" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required autofocus>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">تومان</div>
                                    </div>
                                </div>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="transaction_at">تاریخ</label>
                                <input id="transaction_at" placeholder="____/__/__" dir="ltr" type="text" class="form-control{{ $errors->has('transaction_at') ? ' is-invalid' : '' }}" name="transaction_at" value="{{ old('transaction_at') }}" required>

                                @if ($errors->has('transaction_at'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('transaction_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">توضیحات</label>

                                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description"> {{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="category_id">دسته</label>

                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}"{{ old('category_id') == $category->id  ? ' selected' : '' }}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="account_id">حساب</label>

                                <select name="account_id" id="account_id" class="form-control">
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}"{{ old('account_id') == $account->id  ? ' selected' : '' }}>{{$account->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('account_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('account_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="user_id">شخص</label>

                                <select name="user_id" id="user_id" class="form-control">
                                        <option value="">بدون شخص</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"{{ old('user_id') == $user->id  ? ' selected' : '' }}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        ثبت تراکنش
                                    </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    <script>
        $(function() {
            $('#amount').mask('#,##0', {reverse: true});
            $('#transaction_at').mask('0000/00/00');
            $("#transaction_at").persianDatepicker({format: 'YYYY/MM/DD',initialValue: false,autoClose: true,persianDigit:false});
        });
    </script>
@endsection
