<div class="list-group mb-2 d-none d-md-block d-lg-block d-xl-block">
    <a class="list-group-item list-group-item-action{{ Request::segment(1) == 'dashboard' ? ' active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> داشبرد</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(1) == 'ticket' ? ' active' : '' }}" href="{{ route('ticket') }}"><i class="fa fa-life-ring"></i> پشتیبانی</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(1) == 'invoice' ? ' active' : '' }}" href="{{ route('invoice') }}"><i class="fa fa-bars"></i> فاکتورها</a>
    <a class="list-group-item list-group-item-action{{ Request::segment(1) == 'transaction' ? ' active' : '' }}" href="{{ route('transaction') }}"><i class="fa fa-money"></i> تراکنش ها</a>
    @foreach($menus as $menu)
        @if($menu->type == 'user')
            <a class="list-group-item list-group-item-action{{ Request::segment(1) == $menu->route ? ' active' : '' }}" href="{{ route($menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a>
        @endif
    @endforeach
</div>


<div class="nav-scroller d-block d-md-none d-lg-none d-xl-none mb-2 border">
    <nav class="nav nav-underline">
        <a class="nav-link{{ Request::segment(1) == 'dashboard' ? ' active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> داشبرد</a>
        <a class="nav-link{{ Request::segment(1) == 'ticket' ? ' active' : '' }}" href="{{ route('ticket') }}"><i class="fa fa-life-ring"></i> پشتیبانی</a>
        <a class="nav-link{{ Request::segment(1) == 'invoice' ? ' active' : '' }}" href="{{ route('invoice') }}"><i class="fa fa-bars"></i> فاکتورها</a>
        <a class="nav-link{{ Request::segment(1) == 'transaction' ? ' active' : '' }}" href="{{ route('transaction') }}"><i class="fa fa-money"></i> تراکنش ها</a>
        @foreach($menus as $menu)
            @if($menu->type == 'user')
                <a class="nav-link{{ Request::segment(2) == $menu->route ? ' active' : '' }}" href="{{ route('admin.' . $menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a>
            @endif
        @endforeach
    </nav>
</div>