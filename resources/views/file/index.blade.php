@extends('layouts.app')

@section('title', "نرم افزار - ")

@section('css')

@endsection

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('file') }}">نرم افزار</a></li>
                    </ol>
                </nav>
                <h1>نرم افزار
                    @if(Auth::check())
                        @if(Auth::user()->level == 'admin')
                            <a href="{{ route('file.create')  }}" class="btn btn-primary pull-left btn-sm"><i class="fa fa-plus"></i>افزودن فایل</a>
                        @endif
                    @endif
                </h1>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        @include('file.sidebar',['categories'=>$categories])
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            @foreach($files as $file)
                            <div class="col-md-4 col-sm-6">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="{{ Storage::url($file->source) }}" alt="image" style="width:100%">
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="{{ route('file.view',['id'=>$file->id]) }}">{{$file->title}}</a></h4>
                                        <p class="card-text">
                                            @if($file->type == 'paid')
                                            قیمت:
                                          <strong>{{number_format($file->price)}}</strong> تومان
                                            @else
                                                <strong>رایگان</strong>
                                           @endif
                                            <br />
                                            {{$file->description}}</p>
                                        <div class="row">
                                            <div class="col"><a href="{{ route('file.view',['id'=>$file->id]) }}" class="btn btn-danger btn-block btn-sm"><i class="fa fa-eye"></i> مشاهده</a></div>
                                            @if($file->version_id)
                                                @if($file->type == 'paid')
                                                    <div class="col"><a href="{{ route('cart.add-one-cart',['id' => $file->item_id]) }}" class="btn btn-warning btn-block btn-sm"><i class="fa fa-cart-plus"></i> خرید فایل</a></div>
                                                @else
                                                    <div class="col"><a href="{{ route('file.download',['id' => $file->id]) }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-download"></i> دریافت فایل</a></div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $files->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')

@endsection
