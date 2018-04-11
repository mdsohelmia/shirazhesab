@extends('layouts.app')

@section('title', $ticket->title . " -" )

@section('css')

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ticket') }}">پشتیبانی</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('ticket.view', ['id' => $ticket->id]) }}">{{ $ticket->title }}</a></li>
                </ol>
            </nav>
            <h1>{{ $ticket->title }}
                @if($ticket->priority == 'urgent')
                    <span class="badge badge-danger">ضروری</span>
                @endif
                @if($ticket->priority == 'important')
                    <span class="badge badge-warning">مهم</span>
                @endif
            </h1>
        </div>
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    @include('sidebar')
                </div>
                <div class="col-md-9">
                        <div id="accordion">
                            <div class="card card-info mb-2">
                                <div class="card-header" data-toggle="collapse" href="#collapseOne"><i class="fa fa-arrow-circle-left"></i> پاسخ به تیکت</div>

                                <div class="card-body collapse" id="collapseOne" data-parent="#accordion">
                                    <form method="POST" action="{{ route('ticket.replay',['id'=> $ticket->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <label for="text">متن</label>
                                            <textarea name="text" id="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}">{{old('text')}}</textarea>
                                            @if ($errors->has('text'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('text') }}</strong></span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-mobile btn-sm"><i class="fa fa-send"></i>ارسال پاسخ</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        @foreach($replays as $replay)
                            @if($replay->user_id == $ticket->user_id)
                                <div class="card card-default ml-5 mb-2">
                                    @else
                                        <div class="card card-default mr-5 mb-2">
                                            @endif
                                            <div class="card-header">
                                                {{ $replay->user->name }}
                                                @if($replay->user->title)
                                                    ({{$replay->user->title}})
                                                @endif
                                                <span class="badge badge-dark pull-left">{{ jDate::forge($replay->created_at)->ago() }}</span>
                                            </div>
                                            <div class="card-body">
                                                {!! nl2br($replay->text)  !!}
                                            </div>
                                        </div>
                                        @endforeach
                                        {{ $replays->links() }}
                    <div class="card card-default mb-2">
                        <div class="card-header">
                            {{ $ticket->title }} ({{$ticket->user->name}})
                            <span class="badge badge-dark pull-left">{{ jDate::forge($ticket->created_at)->ago() }}</span>
                        </div>
                        <div class="card-body">
                            {!! nl2br($ticket->text)  !!}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
