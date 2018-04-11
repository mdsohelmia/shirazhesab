@extends('layouts.app')

@section('title', "فاکتور شماره:" . $invoice->id . " - ")

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('invoice') }}">فاکتورها</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('invoice.view',['id' => $invoice->id]) }}">فاکتور شماره:{{ $invoice->id }}</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <h1>فاکتور شماره:{{ $invoice->id }}</h1>
        </div>
    </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    @include('sidebar')
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">ردیف</th>
                                    <th scope="col" class="text-center">شرح کالا</th>
                                    <th scope="col" class="text-center">تعداد</th>
                                    <th scope="col" class="text-center">قیمت واحد</th>
                                    <th scope="col" class="text-center">مبلغ کل</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoice->records as $record)
                                    <tr>
                                        <td scope="row" class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">
                                            @if($record->item_id && $record->item->factory)
                                                <a href="{{ route('item.view', ['id'=>$record->item_id]) }}">{{$record->description}}</a>
                                            @else
                                                {{$record->description}}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ abs($record->quantity) }}</td>
                                        <td class="text-center">{{number_format($record->price)}}</td>
                                        <td class="text-center">{{number_format($record->total)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="alert alert-dark">
                                تخفیف: {{ number_format($invoice->discount)  }} تومان
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="alert alert-dark">
                                مالیات: {{ number_format($invoice->tax)  }} تومان
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="alert alert-dark">
                                مجموع حروف: {{ number_to_letters($invoice->total) }} تومان
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="alert alert-dark">
                                جمع کل: {{ number_format($invoice->total)  }} تومان
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 text-center">
                            @if($invoice->status == 'paid' || $invoice->status == 'approved')
                                <div class="alert alert-success">
                                    زمان پرداخت
                                    <br /><span dir="ltr">{{jDate::forge($invoice->paid_at)->format('Y/m/d H:i:s')}}</span>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <form action="{{ route('invoice.pay') }}" method="post">
                                        @csrf
                                        @method('post')

                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <div class="form-group">
                                            <label for="gateway text-center">درگاه انتخابی</label>
                                            <select name="gateway" id="gateway" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
                                                @foreach(config('gateway') as $key => $gateway)
                                                    @if(isset($gateway['enable']))
                                                        @if($gateway['enable'] == 'yes')
                                                            <option value="{{$key}}"{{ old('gateway') == $key  ? ' selected' : '' }}>{{$gateway['title']}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('gateway'))
                                                <span class="invalid-feedback">
                                                <strong>{{ $errors->first('gateway') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fa fa-money"></i>
                                            پرداخت
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
@endsection
