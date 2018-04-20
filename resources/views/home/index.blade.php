@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mb-2">
            <h1>{{ config('platform.name') }}
                <small class="text-muted">{{ $page->description }}</small>
                @if(Auth::check())
                    @if(Auth::user()->level == 'admin')
                        <a href="{{ route('admin.page.edit',['id' => $page->id])  }}" class="btn btn-primary pull-left btn-sm"><i class="fa fa-edit"></i> ویرایش صفحه</a>
                    @endif
                @endif
            </h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 mb-2">
                    <div class="card card-default">
                        <div class="card-header">{{ $page->title }}</div>

                        <div class="card-body">
                            {!! $page->text !!}
                        </div>
                    </div>
        </div>
    </div>
    <div class="row justify-content-center mb-2">
    @foreach($files as $file)
        <div class="col-md-3 col-sm-3">
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
                            {{ $file->description }}
                    </p>
                    <div class="row">
                        <div class="col"><a href="{{ route('file.view',['id'=>$file->id]) }}" class="btn btn-danger btn-block btn-sm"><i class="fa fa-eye"></i> مشاهده</a></div>
                        @if($file->version_id)
                            @if($file->type == 'paid')
                                <div class="col"><a href="{{ route('file.add-cart',['id'=>$file->id]) }}" class="btn btn-warning btn-block btn-sm"><i class="fa fa-cart-plus"></i> خرید فایل</a></div>
                            @else
                                <div class="col"><a href="{{ route('file.download',['id'=>$file->id]) }}" class="btn btn-success btn-block btn-sm"><i class="fa fa-download"></i> دریافت فایل</a></div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    <div class="row justify-content-center mb-2">
        <div class="col-md-6 mb-2">
            <div class="card card-default">
                <div class="card-header">
                    آخرین اخبار
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($articles as $article)
                        <a href="{{route('article.slug', ['id'=>$article->id,'slug' => $article->slug])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$article->title}}</h5>
                                <small>انتشار:{{ jDate::forge($article->created_at)->format('Y/m/d') }}</small>
                            </div>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card card-default">
                <div class="card-header">
                    مباحث انجمن
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($discussions as $discussion)
                        <a href="{{route('discussion.view', ['id'=>$discussion->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$discussion->title}}</h5>
                                <small>بروز رسانی:{{ jDate::forge($discussion->updated_at)->format('Y/m/d') }}</small>
                            </div>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @include('global.logo')
    .
@endsection

@section('js')

@endsection
