<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $items = Item::with('category')->orderBy('created_at', 'desc')->paginate(config('platform.file-per-page'));
        return view('admin.item.index',['items' => $items]);
    }

    public function create()
    {
        $categories = Category::findType('Item');
        return view('admin.item.create',['categories' => $categories]);
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::findType('Item');
        return view('admin.item.edit',['categories' => $categories,'item' => $item]);
    }

    public function inventory($id)
    {
        $item = Item::findOrFail($id);
        if($item->asset == 'yes') {
            return $item->getInventory();
        } else {
            return "فاقد انبار داری";
        }

    }

    public function insert(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
        ])->validate();

        $item = new Item();
        $item->category_id = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->purchase_price = $request->purchase_price;
        $item->sale_price = $request->sale_price;
        $item->revival_price = $request->revival_price;
        $item->enable = $request->enable;
        $item->asset = $request->asset;
        $item->cart = $request->cart;
        $item->save();
        flash('آیتم با موفقیت اضافه شد.')->success();
        return redirect()->route('admin.item');
    }

    public function update($id, Request $request)
    {
        $item = Item::findOrFail($id);
        Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
        ])->validate();
        $item->category_id = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->purchase_price = $request->purchase_price;
        $item->sale_price = $request->sale_price;
        $item->revival_price = $request->revival_price;
        $item->enable = $request->enable;
        $item->asset = $request->asset;
        $item->cart = $request->cart;
        $item->save();
        flash('آیتم با موفقیت ویرایش شد.')->success();
        return redirect()->route('admin.item');
    }

    public function delete($id, Request $request)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        flash('آیتم با موفقیت حذف شد.')->success();
        return redirect()->route('admin.item');
    }
}
