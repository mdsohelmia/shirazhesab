<div class="list-group mb-2 d-none d-md-block d-lg-block d-xl-block">
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'dashboard' ? ' active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-cogs"></i> داشبرد</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'user' ? ' active' : '' }}" href="{{ route('admin.user') }}"><i class="fa fa-users"></i> کاربرها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'page' ? ' active' : '' }}" href="{{ route('admin.page') }}"><i class="fa fa-window-restore"></i> صفحه ها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'article' ? ' active' : '' }}" href="{{ route('admin.article') }}"><i class="fa fa-newspaper-o"></i> مقاله ها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'transaction' ? ' active' : '' }}" href="{{ route('admin.transaction') }}"><i class="fa fa-money"></i> تراکنش ها </a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'item' ? ' active' : '' }}" href="{{ route('admin.item') }}"><i class="fa fa-cubes"></i> اقلام</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'invoice' ? ' active' : '' }}" href="{{ route('admin.invoice') }}"><i class="fa fa-bars"></i> فاکتورها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'account' ? ' active' : '' }}" href="{{ route('admin.account') }}"><i class="fa fa-address-book-o"></i> حساب ها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'category' ? ' active' : '' }}" href="{{ route('admin.category') }}"><i class="fa fa-object-group"></i> دسته ها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'setting' ? ' active' : '' }}" href="{{ route('admin.setting') }}"><i class="fa fa-cog fa-spin"></i>  تنظیمات</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(2) == 'app' ? ' active' : '' }}" href="{{ route('admin.app') }}"><i class="fa fa-rocket"></i> برنامه ها</a>
    @foreach($menus as $menu)
        @if($menu->type == 'admin')
        <a class="list-group-item list-group-item-action{{ Request::segment(2) == $menu->route ? ' active' : '' }}" href="{{ route('admin.' . $menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a>
        @endif
    @endforeach
</div>

<div class="nav-scroller d-block d-md-none d-lg-none d-xl-none mb-2 border">
    <nav class="nav nav-underline">
        <a class="nav-link{{ Request::segment(2) == 'dashboard' ? ' active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-cogs"></i> داشبرد</a>
        <a class="nav-link{{ Request::segment(2) == 'user' ? ' active' : '' }}" href="{{ route('admin.user') }}"><i class="fa fa-users"></i> کاربرها</a>
        <a class="nav-link{{ Request::segment(2) == 'page' ? ' active' : '' }}" href="{{ route('admin.page') }}"><i class="fa fa-window-restore"></i> صفحه ها</a>
        <a class="nav-link{{ Request::segment(2) == 'article' ? ' active' : '' }}" href="{{ route('admin.article') }}"><i class="fa fa-newspaper-o"></i> مقاله ها</a>
        <a class="nav-link{{ Request::segment(2) == 'transaction' ? ' active' : '' }}" href="{{ route('admin.transaction') }}"><i class="fa fa-money"></i> تراکنش ها </a>
        <a class="nav-link{{ Request::segment(2) == 'item' ? ' active' : '' }}" href="{{ route('admin.item') }}"><i class="fa fa-cubes"></i> اقلام</a>
        <a class="nav-link{{ Request::segment(2) == 'invoice' ? ' active' : '' }}" href="{{ route('admin.invoice') }}"><i class="fa fa-bars"></i> فاکتورها</a>
        <a class="nav-link{{ Request::segment(2) == 'account' ? ' active' : '' }}" href="{{ route('admin.account') }}"><i class="fa fa-address-book-o"></i> حساب ها</a>
        <a class="nav-link{{ Request::segment(2) == 'category' ? ' active' : '' }}" href="{{ route('admin.category') }}"><i class="fa fa-object-group"></i> دسته ها</a>
        <a class="nav-link{{ Request::segment(2) == 'setting' ? ' active' : '' }}" href="{{ route('admin.setting') }}"><i class="fa fa-cog fa-spin"></i>  تنظیمات</a>
        <a class="nav-link{{ Request::segment(2) == 'app' ? ' active' : '' }}" href="{{ route('admin.app') }}"><i class="fa fa-rocket"></i> برنامه ها</a>
        @foreach($menus as $menu)
            @if($menu->type == 'admin')
                <a class="nav-link{{ Request::segment(2) == $menu->route ? ' active' : '' }}" href="{{ route('admin.' . $menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a>
            @endif
        @endforeach
    </nav>
</div>