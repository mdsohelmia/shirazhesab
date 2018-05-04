<?php

namespace App\Http\Controllers;

use App\Product;
use App\Item;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(config('platform.file-per-page'));
        $categories = Category::findType('Product');
        return view('product.index',['categories' => $categories, 'products' => $products]);
    }

    public function category($id)
    {
        $products = Product::where('category_id', $id)->paginate(config('platform.file-per-page'));
        $categories = Category::findType('Product');
        return view('product.index',['categories' => $categories, 'products' => $products]);
    }


    public function create()
    {
        $this->middleware(['auth','admin']);
        $categories = Category::findType('Product');
        return view('product.create',['categories'=> $categories]);
    }

    public function delete($id, Request $request)
    {
        $this->middleware(['auth','admin']);

        $product = Product::findOrFail($id);
        if($item = Item::find($product->item_id)) {
            $item->delete();
        }
        $product->delete();

        flash('کالا با موفقیت حذف شد.')->success();
        return redirect()->route('product');
    }
    public function view($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('product.view',['product' => $product]);
    }
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::findType('Product');
        return view('product.edit',['categories'=> $categories, 'product' => $product]);
    }
    public function slug($id, $slug)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::findType('Product');
        return view('product.edit',['categories'=> $categories, 'product' => $product]);
    }

    public function insert(Request $request)
    {
        $this->middleware(['auth','admin']);

        $request->validate([
            'title' => 'required|max:191|string',
            'text' => 'required|string',
            'source' => 'required|image'
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->user_id = Auth::user()->id;
        $product->description = $request->description;
        $product->text = $request->text;
        $product->price = $request->price;
        $product->published = $request->published;
        $product->off_price = $request->off_price;
        $product->top = $request->top;
        $product->source = $request->file('source')->store('public');
        $product->save();

        $item = new Item();
        $item->title = $product->title;
        $item->post = 'yes';
        $item->asset = 'yes';
        $item->category_id  = config('platform.product-category-id');
        if($request->off_price) {
            $item->sale_price = $product->off_price;
        } else {
            $item->sale_price = $product->price;
        }
        $item->save();

        $product->item_id = $item->id;
        $product->save();

        flash('کالا با موفقیت ایجاد شد.')->success();
        return redirect()->route('product.view', ['id' => $product->id]);
    }

    public function update($id, Request $request)
    {
        $this->middleware(['auth','admin']);
        $request->validate([
            'title' => 'required|max:191|string',
            'text' => 'required|string',
            'source' => 'required|image'
        ]);

        $product = Product::fingOrFail($id);
        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->text = $request->text;
        $product->price = $request->price;
        $product->published = $request->published;
        $product->off_price = $request->off_price;
        $product->top = $request->top;
        if($request->source) {
            Storage::delete($product->source);
            $product->source = $request->file('source')->store('public');
        }
        $product->save();


        if($item = Item::find($product->item_id)) {
            $item->title = $product->title;
            $item->post = 'yes';
            $item->asset = 'yes';
            if($request->off_price) {
                $item->sale_price = $product->off_price;
            } else {
                $item->sale_price = $product->price;
            }
            $item->save();
        }

        flash('کالا با موفقیت ویرایش شد.')->success();
        return redirect()->route('product.view',['id'=>$product->id]);
    }
}
