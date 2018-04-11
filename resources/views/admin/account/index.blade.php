@extends('layouts.app')
@section('title', 'حساب ها -')
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.account') }}">حساب ها</a></li>
                    </ol>
                </nav>
                <div class="card card-default">
                    <div class="card-header">حساب ها
                        <a href="{{route('admin.account.create')}}" class="btn btn-primary btn-sm pull-left"><i class="fa fa-plus-circle"></i>ایجاد حساب جدید</a>
                    </div>

                    <div class="card-body">

                        <table id="account" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>موجودی</th>
                                <th>اقدام ها</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>موجودی</th>
                                <th>اقدام ها</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')
    <script>
        $('#account').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('admin.account.data') }}',
            columns: [
                {data: 'id'},
                {data: 'title'},
                {data: 'inventory', orderable: false, searchable: false},
                {data: 'action', orderable: false, searchable: false}
            ],
            oLanguage:{
                "sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
                "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                "sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
                "sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "نمایش _MENU_ رکورد",
                "sLoadingRecords": "در حال بارگزاری...",
                "sProcessing":     "در حال پردازش...",
                "sSearch":         "جستجو:",
                "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
                "oPaginate": {
                    "sFirst":    "ابتدا",
                    "sLast":     "انتها",
                    "sNext":     "بعدی",
                    "sPrevious": "قبلی"
                },
                "oAria": {
                    "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
                    "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                }
            }
        });
    </script>
@endsection
