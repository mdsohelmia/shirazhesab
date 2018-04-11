@extends('layouts.app')
@section('title', 'اقلام - ')
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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.item') }}">اقلام</a></li>
                </ol>
            </nav>
            <div class="card card-default">
                <div class="card-header">اقلام
                    <a href="{{route('admin.item.create')}}" class="btn btn-primary btn-sm pull-left"><i class="fa fa-plus-circle"></i>آیتم جدید</a>
                </div>

                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">نوع</th>
                            <th scope="col" class="text-center">عنوان</th>
                            <th scope="col" class="text-center">قیمت خرید</th>
                            <th scope="col" class="text-center">قیمت فروش</th>
                            <th scope="col" class="text-center">موجودی</th>
                            <th scope="col" class="text-center">اقدام ها</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td scope="row" class="text-center">
                                    @if($item->category['title'])
                                        {{ $item->category['title'] }}
                                    @else
                                        فاقد دسته بندی
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->title}}
                                </td>
                                <td class="text-center">
                                    {{$item->purchase_price}}
                                </td>
                                <td class="text-center">
                                    {{$item->sale_price}}
                                </td>

                                <td class="text-center">
                                    <span-component web-address="{{ route('admin.item.inventory', [$item->id]) }}"></span-component>
                                </td>

                                <td>
                                    <a href="{{ route('admin.item.edit', ['id' => $item->id]) }}" class="btn btn-sm btn-dark"><i class="fa fa-edit"></i> ویرایش</a>
                                    @if(!$item->factory_id)
                                    <form method="post" action="{{ route('admin.item.delete',['id' => $item->id]) }}" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('آیا از عملیات حذف اطمینان دارید؟')" class="btn btn-danger btn-sm btn-mobile"><i class="fa fa-trash"></i> حذف</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection