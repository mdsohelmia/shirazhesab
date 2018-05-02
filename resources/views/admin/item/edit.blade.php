@extends('layouts.app')
@section('title', 'ویرایش آیتم ' .$item->title . " - ")
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.item') }}">اقلام</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش آیتم {{$item->title}}</li>
                </ol>
            </nav>
            <div class="card card-default">
                <div class="card-header">ویرایش آیتم {{$item->title}}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.item.update',['id' => $item->id]) }}" onsubmit="$('.price').unmask();">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label for="title">عنوان</label>
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $item->title) }}" required autofocus>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">توضیحات</label>

                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description"> {{ old('description', $item->description) }}</textarea>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="purchase_price">قیمت خرید</label>
                            <div class="input-group mb-2 ml-sm-2">
                                <input id="purchase_price" type="text" dir="ltr" class="price form-control{{ $errors->has('purchase_price') ? ' is-invalid' : '' }}" name="purchase_price" value="{{ old('purchase_price', $item->purchase_price) }}" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">تومان</div>
                                </div>
                            </div>
                            @if ($errors->has('purchase_price'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('purchase_price') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sale_price">قیمت فروش</label>
                            <div class="input-group mb-2 ml-sm-2">
                                <input id="sale_price" type="text" dir="ltr" class="price form-control{{ $errors->has('sale_price') ? ' is-invalid' : '' }}" name="sale_price" value="{{ old('sale_price', $item->sale_price) }}" required>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">تومان</div>
                                </div>
                            </div>
                            @if ($errors->has('sale_price'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sale_price') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="revival_price">قیمت تمدید</label>
                            <div class="input-group mb-2 ml-sm-2">
                                <input id="revival_price" type="text" dir="ltr" class="price form-control{{ $errors->has('revival_price') ? ' is-invalid' : '' }}" name="revival_price" value="{{ old('revival_price', $item->revival_price) }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">تومان</div>
                                </div>
                            </div>
                            @if ($errors->has('revival_price'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('revival_price') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="period">دوره زمانی</label>
                            <div class="input-group mb-2 ml-sm-2">
                                <input id="period" type="text" dir="ltr" class="form-control{{ $errors->has('period') ? ' is-invalid' : '' }}" name="period" value="{{ old('period', $item->period) }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">روز</div>
                                </div>
                            </div>
                            @if ($errors->has('period'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('period') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category_id">دسته</label>

                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"{{ old('category_id', $item->category_id) == $category->id  ? ' selected' : '' }}>{{$category->title}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="enable">فعال</label>

                            <select name="enable" id="enable" class="form-control">
                                <option value="yes"{{ old('enable', $item->enable) == 'yes'  ? ' selected' : '' }}>بله</option>
                                <option value="no"{{ old('enable', $item->enable) == 'no' ? ' selected' : '' }}>خیر</option>
                            </select>
                            @if ($errors->has('enable'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('enable') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="asset">انبارداری</label>

                            <select name="asset" id="asset" class="form-control">
                                <option value="yes"{{ old('asset', $item->asset) == 'yes'  ? ' selected' : '' }}>دارد</option>
                                <option value="no"{{ old('asset', $item->asset) == 'no' ? ' selected' : '' }}>ندارد</option>
                            </select>
                            @if ($errors->has('asset'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('asset') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cart">فروشگاهی</label>

                            <select name="cart" id="cart" class="form-control">
                                <option value="yes"{{ old('cart', $item->cart) == 'yes'  ? ' selected' : '' }}>بله</option>
                                <option value="no"{{ old('cart', $item->cart) == 'no' ? ' selected' : '' }}>خیر</option>
                            </select>
                            @if ($errors->has('cart'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cart') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="post">فروش پستی</label>

                            <select name="post" id="enable" class="form-control">
                                <option value="yes"{{ old('post', $item->post) == 'yes'  ? ' selected' : '' }}>بله</option>
                                <option value="no"{{ old('post', $item->post) == 'no' ? ' selected' : '' }}>خیر</option>
                            </select>
                            @if ($errors->has('post'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('post') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i>
                            ویرایش آیتم
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('.price').mask('#,##0', {reverse: true});
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.basictable/1.0.8/jquery.basictable.min.js"></script>
@endsection
