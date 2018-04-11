@extends('layouts.app')

@section('title', "پشتیبانی - ")

@section('css')

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('ticket') }}">پشتیبانی</a></li>
                </ol>
            </nav>
        </div>
            <div class="col-md-12">
                <h1>پشتیبانی</h1>
            </div>
    </div>
    <div class="row justify-content-center">
                <div class="col-md-3">

                    @include('sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card card-default">
                        <div class="card-header">
                            تیکت های شما
                            <a href="{{ route('ticket.create')  }}" class="btn btn-primary pull-left mb-2 btn-sm"><i class="fa fa-ticket"></i>ایجاد تیکت جدید</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($tickets as $ticket)
                                <a href="{{route('ticket.view', ['id'=>$ticket->id])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5>
                                            {{$ticket->title}}
                                            @if($ticket->priority == 'urgent')
                                            <span class="badge badge-danger">ضروری</span>
                                            @endif
                                            @if($ticket->priority == 'important')
                                                <span class="badge badge-warning">مهم</span>
                                            @endif
                                            <p>{{ $ticket->category->title }}</p>
                                        </h5>
                                        <small>
                                            {{ jDate::forge($ticket->created_at)->ago() }}
                                            <br />
                                            {{ $ticket->user->name }}
                                            <br />
                                            @if($ticket->status == 'open')
                                                جدید
                                            @endif
                                            @if($ticket->status == 'close')
                                                بسته شده
                                            @endif
                                            @if($ticket->status == 'staff')
                                                پاسخ پشتیبانی
                                            @endif
                                            @if($ticket->status == 'user')
                                                پاسخ کاربر
                                            @endif
                                            @if($ticket->status == 'waiting')
                                                در انتظار بررسی
                                            @endif
                                            @if($ticket->status == 'lock')
                                                قفل شده
                                            @endif
                                        </small>
                                    </div>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                    {{ $tickets->links() }}
                </div>
            </div>
@endsection

@section('js')

@endsection
