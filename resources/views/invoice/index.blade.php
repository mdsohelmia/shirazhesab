@extends('layouts.app')

@section('title', "فاکتورها - ")

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.basictable/1.0.8/basictable.min.css" />
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ config('platform.name') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('invoice') }}">فاکتورها</a></li>
                </ol>
            </nav>
        </div>
            <div class="col-md-12">
                <h1>فاکتورها</h1>
            </div>
        </div>

            <div class="row justify-content-center">
                <div class="col-md-3">
                    @include('sidebar')
                </div>
                <div class="col-md-9">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">شماره</th>
                            <th scope="col" class="text-center">جمع</th>
                            <th scope="col" class="text-center">تاریخ</th>
                            <th scope="col" class="text-right">اقدام</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td scope="row" class="text-center">{{$invoice->id}}</td>
                                <td class="text-center">{{number_format($invoice->total)}}</td>
                                <td class="text-center">{{ jDate::forge($invoice->invoice_at)->format('Y/m/d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('invoice.view',['id' => $invoice->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> مشاهده جزئیات
                                    </a>
                                    @if($invoice->status == 'paid' || $invoice->status == 'approved')
                                        <br />
                                        زمان پرداخت:
                                        <span dir="ltr">{{jDate::forge($invoice->paid_at)->format('Y/m/d H:i:s')}}</span>
                                    @else
                                        <a href="{{ route('invoice.pay-link',['id' => $invoice->id]) }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-money"></i> پرداخت فاکتور
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.basictable/1.0.8/jquery.basictable.min.js"></script>
    <script>
        $(function() {
            $('.table').basictable();
        });
    </script>
@endsection
