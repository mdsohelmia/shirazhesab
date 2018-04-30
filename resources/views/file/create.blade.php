@extends('layouts.app')

@section('title', "افزودن فایل - ")

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('file') }}">نرم افزار</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('file.create') }}">افزودن فایل</a></li>
                    </ol>
                </nav>
                <h1>افزودن فایل</h1>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">افزودن فایل</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('file.insert') }}" enctype="multipart/form-data" onsubmit="$('#price').unmask();">
                                    @csrf
                                    @method('post')
                                    <div class="form-group row">
                                        <label for="title" class="col-md-4 col-form-label @lang('platform.input-pull')">عنوان</label>
                                        <div class="col-md-7">
                                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="level" class="col-md-4 col-form-label @lang('platform.input-pull')">دسته فایل</label>

                                        <div class="col-md-7">
                                            <select name="category_id" id="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}"{{old('category_id') == $category->id ? ' selected' : ''}}>{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('category_id') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label @lang('platform.input-pull')">توضیحات مختصر</label>
                                        <div class="col-md-7">
                                            <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{old('description')}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="text" class="col-md-4 col-form-label @lang('platform.input-pull')">توصیف و توضیحات کامل</label>
                                        <div class="col-md-7">
                                            <textarea name="text" id="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}">{{old('text')}}</textarea>
                                            @if ($errors->has('text'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('text') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="source" class="col-md-4 col-form-label @lang('platform.input-pull')">تصویر</label>
                                        <div class="col-md-7">
                                            <input id="source" type="file" class="form-control{{ $errors->has('source') ? ' is-invalid' : '' }}" name="source" required>
                                            @if ($errors->has('source'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('source') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="type" class="col-md-4 col-form-label @lang('platform.input-pull')">وضعیت فروش</label>
                                        <div class="col-md-7">
                                            <select id="type" name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                                <option value="paid"{{old('type') == 'paid' ? ' selected' : ''}}>تجاری</option>
                                                <option value="free"{{old('type') == 'free' ? ' selected' : ''}}>رایگان</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('type') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="top" class="col-md-4 col-form-label @lang('platform.input-pull')">ویژه</label>
                                        <div class="col-md-7">
                                            <select id="top" name="top" class="form-control{{ $errors->has('top') ? ' is-invalid' : '' }}">
                                                <option value="yes"{{old('top') == 'yes' ? ' selected' : ''}}>بلی</option>
                                                <option value="no"{{old('top') == 'no' ? ' selected' : ''}}>خیر</option>
                                            </select>
                                            @if ($errors->has('top'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('top') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="price" class="col-md-4 col-form-label @lang('platform.input-pull')">قیمت</label>
                                        <div class="col-md-7">
                                            <div class="input-group mb-2 ml-sm-2">
                                                <input id="price" type="text" dir="ltr" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">تومان</div>
                                                </div>
                                            </div>
                                            @if ($errors->has('price'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
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
                                    <div class="form-group row">
                                        <label for="title" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس پشتیبانی</label>
                                        <div class="col-md-7">
                                            <input id="title" dir="ltr" type="text" class="form-control{{ $errors->has('support_link') ? ' is-invalid' : '' }}" name="support_link" value="{{ old('support_link') }}">
                                            @if ($errors->has('support_link'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('support_link') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="title" class="col-md-4 col-form-label @lang('platform.input-pull')">آدرس آموزش نصب،راه اندازی و نگه داری</label>
                                        <div class="col-md-7">
                                            <input id="title" dir="ltr" type="text" class="form-control{{ $errors->has('learn_link') ? ' is-invalid' : '' }}" name="learn_link" value="{{ old('learn_link') }}">
                                            @if ($errors->has('learn_link'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('learn_link') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-plus"></i>
                                                افزودن فایل
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
    @include('global.ckeditor',['editors' => ['text']])
    <script>
        $(function() {
            $('#price').mask('#,##0', {reverse: true});
        });
    </script>
@endsection
