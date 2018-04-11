<div class="btn-group" role="group" aria-label="انتخاب نوع فایل" style="margin-bottom: 10px">
    <a href="{{ route('file.type',['type'=>'free']) }}" class="btn btn-secondary{{ (Request::segment(2) == 'type' && Request::segment(3) == 'free') ? ' active' : '' }}">رایگان</a>
    <a href="{{ route('file.type',['type'=>'paid']) }}" class="btn btn-secondary{{ (Request::segment(2) == 'type' && Request::segment(3) == 'paid') ? ' active' : '' }}">تجاری</a>
</div>
<div class="list-group mb-2">
    @foreach($categories as $category)
            <a class="list-group-item list-group-item-action{{ (Request::segment(2) == 'category' && Request::segment(3) == $category->id) ? ' active' : '' }}" href="{{ route('file.category',['id'=>$category->id]) }}"><i class="{{ $category->icon }}"></i> {{ $category->title }}</a>
    @endforeach
</div>