@extends('layouts.app')
@section('title', 'کاربرها - ')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.basictable/1.0.8/basictable.min.css" />
@endsection
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.user') }}">کاربرها</a></li>
                    </ol>
                </nav>
                <div class="card card-default">
                    <div class="card-header">کاربرها
                        <a href="{{route('admin.user.create')}}" class="btn btn-primary btn-sm pull-left"><i class="fa fa-plus-circle"></i> ایجاد کاربر جدید</a>
                    </div>

                    <div class="card-body">

                        <table id="users" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <th>شماره</th>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th>شماره همراه</th>
                                <th>موجودی</th>
                                <th>اقدام ها</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script>
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{ route('admin.user.data') }}',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'mobile'},
                {data: 'balance'},
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.basictable/1.0.8/jquery.basictable.min.js"></script>
    <script>
        $(function() {
            $('.table').basictable();
        });
    </script>
@endsection
