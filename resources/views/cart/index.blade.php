@extends('layouts.app')
@section('title', 'سبد خرید - ')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('cart') }}">سبد خرید</a></li>
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
                        <a href="{{ route('cart.information')  }}" class="btn btn-warning pull-left"><i class="fa fa-user-circle-o"></i>تکمیل اطلاعات</a>
                        @endif
                    </div>
                </div>
                <div class="list-group mb-2">
                    @foreach(Cart::content() as $item)
                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$item->name}}</h5>
                            <small><a href="{{ route('file.remove-cart',['id'=>$item->rowId]) }}" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> حذف</a></small>
                        </div>
                        <p class="mb-1">قیمت واحد:{{number_format($item->price)}}تومان
                            <br />
                            مقدار:{{number_format($item->qty)}}
                            <br />
                            جمع:{{number_format($item->price * $item->qty)}}تومان
                        </p>
                        <small>{{$item->options->description}}</small>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-2">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-info"><strong>جمع کل:</strong>{{ number_format(Cart::total()) }} تومان</div>
                    </div>
                </div>

            </div>
        </div>
@endsection
