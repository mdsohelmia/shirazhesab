<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\FileDownload;
use App\FilePurchase;
use App\FileVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Item;
use Telegram\Bot\Api;

use Telegram\Bot\Keyboard\Keyboard;

class FileController extends Controller
{
    public function index()
    {
        $files = File::published()->paginate(config('platform.file-per-page'));
        $categories = Category::findType('File');
        return view('file.index',['categories' => $categories, 'files' => $files]);
    }

    public function category($id)
    {
        $files = File::where('category_id', $id)->paginate(config('platform.file-per-page'));
        $categories = Category::findType('File');
        return view('file.index',['categories' => $categories, 'files' => $files]);
    }

    public function type($type)
    {
        $files = File::where('type', $type)->paginate(config('platform.file-per-page'));
        $categories = Category::findType('File');
        return view('file.index',['categories' => $categories, 'files' => $files]);
    }

    public function create()
    {
        $this->middleware(['auth','admin']);
        $categories = Category::findType('File');
        return view('file.create',['categories'=> $categories]);
    }

    public function delete($id, Request $request)
    {
        $this->middleware(['auth','admin']);
        $file = File::findOrFail($id);
        if($item = Item::find($file->item_id)) {
            $item->delete();
        }
        $file->delete();

        flash('فایل با موفقیت حذف شد.')->success();
        return redirect()->route('file');
    }
    public function view($id)
    {
        $file = File::with('versions')->findOrFail($id);
        $categories = Category::findType('File');
        return view('file.view',['categories'=> $categories, 'file' => $file]);
    }
    public function edit($id)
    {
        $file = File::with('versions')->findOrFail($id);
        $categories = Category::findType('File');
        return view('file.edit',['categories'=> $categories, 'file' => $file]);
    }
    public function slug($id, $slug)
    {
        $file = File::with('versions')->findOrFail($id);
        $categories = Category::findType('File');
        return view('file.view',['categories'=> $categories, 'file' => $file]);
    }

    public function insert(Request $request)
    {
        $this->middleware(['auth','admin']);

        if($request->type == 'paid') {
            $request->validate([
                'title' => 'required|max:191|string',
                'text' => 'required|string',
                'price' => 'numeric|min:'.config('platform.min-payment-price'),
                'type' => 'required',
                'source' => 'required|image',
                'learn_link' => 'nullable|url',
                'support_link' => 'nullable|url',
            ]);
        } else {
            $request->validate([
                'title' => 'required|max:191|string',
                'text' => 'required|string',
                'type' => 'required',
                'source' => 'required|image',
                'learn_link' => 'nullable|url',
                'support_link' => 'nullable|url',
            ]);
        }
        $file = new File();
        $file->title = $request->title;
        $file->category_id = $request->category_id;
        $file->description = $request->description;
        $file->text = $request->text;
        $file->price = $request->price;
        $file->published = $request->published;
        $file->support_link = $request->support_link;
        $file->learn_link = $request->learn_link;
        $file->top = $request->top;
        $file->type = $request->type;
        $file->source = $request->file('source')->store('public');
        $file->user_id = Auth::user()->id;
        $file->save();
        if($file->type == 'paid') {
            $item = new Item();
            $item->title = $file->title;
            $item->factory = '\App\Factory\FileFactory';
            $item->category_id  = config('platform.file-category-id');
            $item->factory_id = $file->id;
            $item->sale_price = $file->price;
            $item->save();

            $file->item_id = $item->id;
            $file->save();
        }
        flash('فایل با موفقیت ایجاد شد.')->success();
        return redirect()->route('file.view',['id'=>$file->id]);
    }

    public function update($id, Request $request)
    {
        $this->middleware(['auth','admin']);
        if($request->type == 'paid') {
            $request->validate([
                'title' => 'required|string',
                'text' => 'string',
                'price' => 'numeric|min:'.config('platform.min-payment-price'),
                'type' => 'required',
                'source' => 'image',
                'learn_link' => 'nullable|url',
                'support_link' => 'nullable|url',
            ]);
        } else {
            $request->validate([
                'title' => 'required|string',
                'text' => 'required|string',
                'type' => 'required',
                'source' => 'image',
                'learn_link' => 'nullable|url',
                'support_link' => 'nullable|url',
            ]);
        }
        $file = File::findOrFail($id);
        $file->title = $request->title;
        $file->category_id = $request->category_id;
        $file->description = $request->description;
        $file->top = $request->top;
        $file->text = $request->text;
        $file->price = $request->price;
        $file->published = $request->published;
        $file->support_link = $request->support_link;
        $file->learn_link = $request->learn_link;
        $file->type = $request->type;
        if($request->source) {
            Storage::delete($file->source);
            $file->source = $request->file('source')->store('public');
        }
        $file->user_id = Auth::user()->id;
        $file->save();
        if($file->type == 'paid') {
            if($item = Item::find($file->item_id)) {
                $item->title = $file->title;
                $item->sale_price = $file->price;
                $item->save();
            } else {
                $item = new Item();
                $item->title = $file->title;
                $item->factory = '\App\Factory\FileFactory';
                $item->category_id  = config('platform.file-category-id');
                $item->factory_id = $file->id;
                $item->sale_price = $file->price;
                $item->save();
                $file->item_id = $item->id;
                $file->save();
            }
        }
        flash('فایل با موفقیت ایجاد شد.')->success();
        return redirect()->route('file.view',['id'=>$file->id]);
    }

    public function removeCart($id)
    {
        Cart::remove($id);
        flash("آیتم با موفقیت از سبد حذف شد.")->success();
        return redirect()->back();
    }
    public function download($id)
    {
        $this->middleware(['auth']);
        $file = File::with('version')->findOrFail($id);
        if($file->type == 'paid') {
            $purchases = FilePurchase::ofFile($id)->where('user_id', Auth::user()->id)->count();
            if($purchases > 0) {
                FileDownload::create(['user_id'=>Auth::user()->id, 'file_id'=>$file->id]);
                $file->downloads++;
                $file->save();
                return Storage::download($file->version->source, $file->version->name);
            } else {
                flash('برای دریافت فایل ابتدا آن را باید بخرید.')->warning();
                return redirect()->route('file.add-cart',['id' => $file->id]);
            }
        } else if($file->type == 'free') {
            FileDownload::create(['user_id'=>Auth::user()->id, 'file_id'=>$file->id]);
            $file->downloads++;
            $file->save();
            return Storage::download($file->version->source, $file->version->name);
        }
    }
    public function downloadVersion($id,$version_id)
    {
        $this->middleware(['auth']);
        $file = File::findOrFail($id);
        $version = FileVersion::findOrFail($version_id);
        if($file->type == 'paid') {
            $purchases = FilePurchase::ofFile($id)->where('user_id', Auth::user()->id)->count();
            if($purchases > 0) {
                FileDownload::create(['user_id'=>Auth::user()->id, 'file_id'=>$file->id]);
                $file->downloads++;
                $file->save();
                return Storage::download($version->source, $version->name);
            } else {
                flash('برای دریافت فایل ابتدا آن را باید بخرید.')->warning();
                return redirect()->route('file.add-cart',['id' => $file->id]);
            }
        } else if($file->type == 'free') {
            FileDownload::create(['user_id'=>Auth::user()->id, 'file_id'=>$file->id]);
            $file->downloads++;
            $file->save();
            return Storage::download($version->source, $version->name);
        }
    }

}
