@extends('layouts.app')

@section('title', $file->title . "-")

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('file') }}">محصولات</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('file.view',['id' => $file->id]) }}">{{ $file->title }}</a></li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $file->title }}
                        <small class="text-muted">{{ $file->description }}</small>
                        @if(Auth::check())
                            @if(Auth::user()->level == 'admin' || $file->user_id == Auth::user()->id)
                                <div class="btn-group pull-left" role="group" aria-label="Basic example">
                                    <a href="{{ route('file.edit',['id' => $file->id])  }}" class="btn btn-mobile btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش فایل</a>
                                    <button type="button" onclick="$('#deleteFile').toggle();" class="btn btn-mobile btn-danger btn-sm"><i class="fa fa-trash-o"></i> حذف فایل</button>
                                    <a type="button" href="{{ route('file-version.create',['id' => $file->id]) }}" class="btn btn-mobile btn-dark btn-sm"><i class="fa fa-plus"></i> افزودن نسخه جدید</a>
                                </div>
                            @endif
                        @endif
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <img class="card-img-top mb-2" src="{{ Storage::url($file->source) }}" alt="image" style="width:100%">
                    @if($file->version_id)
                        @if($file->type == 'paid')
                            <a href="{{ route('file.add-cart',['id'=>$file->id]) }}" class="btn btn-mobile btn-warning btn-lg btn-block"><i class="fa fa-cart-plus"></i> خرید فایل</a>
                        @else
                            <a href="{{ route('file.download',['id'=>$file->id]) }}" class="btn btn-mobile btn-success btn-lg btn-block"><i class="fa fa-download"></i> دریافت فایل</a>
                        @endif
                    @endif
                        <ul class="list-group mt-2">
                            <li class="list-group-item">قیمت:
                                @if($file->type == 'paid')
                                    <strong>{{number_format($file->price)}}</strong> تومان
                                @else
                                    <strong>رایگان</strong>
                                @endif
                            </li>
                            <li class="list-group-item">تعداد دریافت:{{$file->downloads}}</li>
                            @if($file->type == 'paid')
                            <li class="list-group-item">تعداد خرید:{{$file->purchases}}</li>
                            @endif
                            <li class="list-group-item">تاریخ ایجاد فایل:{{ jDate::forge($file->created_at)->format('Y/m/d') }}</li>
                            <li class="list-group-item">تاریخ بروز رسانی فایل:{{ jDate::forge($file->updated_at)->ago() }}</li>
                        </ul>
                        <div class="alert alert-info mt-2">چنانچه فایل را قبلا خریده اید با کلیک بر روی خرید فایل به صفحه دریافت هدایت می شوید.</div>
                </div>

                <div class="col-md-9">
                    <div class="alert alert-danger" id="deleteFile" role="alert" style="display: none;">
                        <h4 class="alert-heading">حذف فایل</h4>
                        <p>آیا از حذف فایل اطمینان دارید؟</p>
                        <hr>
                        <p class="mb-0">
                            <form style="display: inline" action="{{ route('file.delete',['id'=>$file->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">حذف</button>

                            </form>
                            <button type="button" onclick="$('#deleteFile').hide();" class="btn btn-sm btn-dark">لغو حذف</button>
                        </p>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="file-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="text" data-toggle="tab" href="#file-text" role="tab" aria-controls="text" aria-selected="true">توضیحات</a></li>
                                <li class="nav-item"><a class="nav-link" id="versions" data-toggle="tab" href="#file-versions" role="tab" aria-controls="versions" aria-selected="false">نسخه های فایل</a></li>
                                @if($file->support_link)
                                    <li class="nav-item"><a class="nav-link" id="support" href="{{ $file->support_link }}">پشتیبانی</a></li>
                                @endif
                                @if($file->learn_link)
                                    <li class="nav-item"><a class="nav-link" id="support" href="{{ $file->learn_link }}">آموزش</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="file-tabsContent">
                                <div class="tab-pane fade show active" id="file-text" role="tabpanel" aria-labelledby="file-tab">{!! $file->text  !!}</div>
                                <div class="tab-pane fade" id="file-versions" role="tabpanel" aria-labelledby="versions-tab">
                                    شما می توانید سایر نسخه ها و فایل های مربوطه را دریافت کنید.
                                    <ul class="list-group">
                                    @foreach($file->versions as $version)
                                            <a href="{{ route('file.download-version',['id'=>$file->id, 'version_id'=>$version->id])  }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{$version->title}}</h5>
                                                    <small>{{ jDate::forge($version->created_at)->format('Y/m/d') }}</small>
                                                </div>
                                                <p class="mb-1">{{$version->description}}</p>
                                            </a>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('js')

@endsection
