@extends('layouts.app')

@section('title', "سخت افزار - ")

@section('css')

@endsection

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('product') }}">سخت افزار</a></li>
                    </ol>
                </nav>
                <h1>سخت افزار
                    @if(Auth::check())
                        @if(Auth::user()->level == 'admin')
                            <a href="{{ route('product.create')  }}" class="btn btn-primary pull-left btn-sm"><i class="fa fa-plus"></i>افزودن کالا</a>
                        @endif
                    @endif
                </h1>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        @include('product.sidebar',['categories'=>$categories])
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-4 col-sm-6">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="{{ Storage::url($product->source) }}" alt="image" style="width:100%">
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="{{ route('product.view',['id'=>$product->id]) }}">{{$product->title}}</a></h4>
                                        <p class="card-text">
                                            قیمت:
                                          <strong>{{number_format($product->price)}}</strong> تومان
                                            {{$product->description}}</p>
                                        <div class="row">
                                            <div class="col"><a href="{{ route('product.view',['id'=>$product->id]) }}" class="btn btn-danger btn-block btn-sm"><i class="fa fa-eye"></i> مشاهده</a></div>
                                            <div class="col"><a href="{{ route('cart.add-one-cart',['id'=>$product->item_id]) }}" class="btn btn-warning btn-block btn-sm"><i class="fa fa-cart-plus"></i> خرید</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')

@endsection
