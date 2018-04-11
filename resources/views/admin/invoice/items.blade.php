<div class="list-group" style="z-index: 2000;position: fixed;left: {{$left}};top: {{$top}};">
    @foreach($items as $item)
    <button type="button" onclick="selectItem({{$item->id}}, {{$id}}, {{$item->sale_price}})" class="list-group-item list-group-item-action">{{ $item->title }}</button>
    @endforeach
</div>