@extends('layouts.app')

@section('title', $file->title . "-")

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('file') }}">محصولات</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('file.view',['id' => $file->id]) }}">{{ $file->title }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('file-version.create',['id' => $file->id]) }}">افزودن نسخه جدید</a></li>
                </ol>
            </nav>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">افزودن فایل</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('file-version.insert',['id'=>$file->id]) }}" enctype="multipart/form-data" onsubmit="$('#price').unmask();">
                                @csrf
                                @method('post')

                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label @lang('platform.input-pull')">عنوان نسخه</label>
                                    <div class="col-md-7">
                                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
                                        <small id="titleHelp" class="form-text">عنوان نسخه فایل را بنوبسید برای مثال 1.0.0 یا اصلاحات جدید.</small>
                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label @lang('platform.input-pull')">نام فایل نسخه</label>
                                    <div class="col-md-7">
                                        <input id="name" type="text" dir="ltr" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                                        <small id="nameHelp" class="form-text">نام فایل به انگلیسی و همراه با پسوند وارد شود. برای مثال:ShirazSoft.zip</small>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label @lang('platform.input-pull')">توضیحات نسخه</label>
                                    <div class="col-md-7">
                                        <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{old('description')}}</textarea>
                                        <small id="descriptionHelp" class="form-text">چنانچه این نسخه از فایل دارای توضیحات خاصی است بنویسید.</small>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="source" class="col-md-4 col-form-label @lang('platform.input-pull')">فایل نسخه (فایل اصلی)</label>
                                    <div class="col-md-7">
                                        <input id="source" type="file" class="form-control{{ $errors->has('source') ? ' is-invalid' : '' }}" name="source" required>
                                        <small id="sourceHelp" class="form-text">فایل اصلی را در این قسمت انتخاب کنید.</small>
                                        @if ($errors->has('source'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('source') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="published" class="col-md-4 col-form-label @lang('platform.input-pull')">وضعیت انتشار</label>
                                    <div class="col-md-7">
                                        <select id="published" name="published" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                            <option value="yes"{{old('published') == 'yes' ? ' selected' : ''}}>منتشر شده</option>
                                            <option value="no"{{old('published') == 'no' ? ' selected' : ''}}>فایل موقت</option>
                                        </select>
                                        <small id="publishedHelp" class="form-text">در صورت نیاز شما می توانید یک فایل را به صورت پیشنویس قرار دهید و پس از نهایی شدن ویرایش ها آن را منتشر کنید.</small>
                                        @if ($errors->has('published'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('published') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                            بارگذاری فایل جدید
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')

@endsection
