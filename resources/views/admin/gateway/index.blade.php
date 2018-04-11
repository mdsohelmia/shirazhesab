@extends('layouts.app')
@section('title', 'واسط پرداخت - ')
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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.gateway') }}">واسط پرداخت</a></li>
                </ol>
            </nav>
            <div class="card card-default">
                <div class="card-header">واسط پرداخت
                    <a class="btn-primary btn btn-sm pull-left" href="{{ route('admin.gateway.create') }}"><i class="fa fa-plus"></i> ایجاد واسط</a>
                </div>

                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">عنوان</th>
                            <th scope="col" class="text-center">حجم تراکنش</th>
                            <th scope="col" class="text-center">اقدام ها</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gateways as $gateway)
                            <tr>
                                <td scope="row" class="text-center">
                                    {{ $gateway->title }}
                                </td>
                                <td class="text-center">
                                    {{ $gateway->getInventory() }}
                                </td>

                                <td>
                                    <form method="post" action="{{ route('admin.transaction.delete',['id' => $transaction->id]) }}" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('آیا از عملیات حذف اطمینان دارید؟')" class="btn btn-danger btn-sm btn-mobile"><i class="fa fa-trash"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $gateways->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
