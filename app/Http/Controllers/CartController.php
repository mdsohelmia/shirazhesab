<?php

namespace App\Http\Controllers;

use App\Address;
use App\Invoice;
use App\Item;
use App\User;
use App\Notifications\InvoiceCreated;
use App\Record;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Validator;

class CartController extends Controller
{
    public function order()
    {
        $items = Item::with(['category'])->enable()->cart()->get();
        $categories = array();
        foreach ($items as $item) {
            $categories[$item->category->id]['title'] = $item->category->title;
            $categories[$item->category->id]['id'] = $item->category->id;
            $categories[$item->category->id]['icon'] = $item->category->icon;
        }
        return view('cart.order', ['items' => $items, 'categories' => $categories]);
    }

    public function category($id)
    {
        $items = Item::with(['category'])->enable()->cart()->get();
        $categories = array();
        foreach ($items as $item) {
            $categories[$item->category->id]['title'] = $item->category->title;
            $categories[$item->category->id]['id'] = $item->category->id;
            $categories[$item->category->id]['icon'] = $item->category->icon;
        }
        return view('cart.category', ['id' => $id, 'items' => $items, 'categories' => $categories]);
    }

    public function index()
    {
        return view('cart.index');
    }
    public function addCart(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);
        $item = Item::findOrFail($request->id);
        Cart::add($item->id, $item->title, $request->qty, $item->sale_price,['description' => $item->description]);
        flash($item->title . "سفارش شما ثبت شد.")->success();
        return redirect()->route('cart');
    }

    public function removeCart($id)
    {
        Cart::remove($id);
        flash("آیتم با موفقیت از سبد حذف شد.")->success();
        return redirect()->back();
    }

    public function information()
    {
        if(Auth::guest()) {
            flash("برای تکمیل سفارش نیاز است شما در سایت ثبت نام کنید لذا ابتدا فرم زیر را تکمیل کنید، در صورتی که پیش تر در سایت ثبت نام کردید از گزینه ورود استفاده نمایید.")->warning();
            return redirect()->route('register');
        } else {
            $addresses = Address::where('user_id', Auth::user()->id);
            return view('cart.information',['addresses' => $addresses]);
        }
    }

    public function storeInformation(Request $request)
    {
        Validator::make($request->all(), [
            'national_code' => 'required||numeric|unique:users,national_code,' . Auth::user()->id,
            'phone' => 'required|numeric',
            'zip_code' => 'required|numeric',
            'address' => 'required|string',
        ])->validate();
        $user = User::findOrFail(Auth::user()->id);
        session(['name' => $request->name]);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->zip_code = $request->zip_code;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('cart.checkout');
    }

    public function checkout()
    {
        if(Auth::guest()) {
            flash("برای تکمیل سفارش نیاز است شما در سایت ثبت نام کنید لذا ابتدا فرم زیر را تکمیل کنید، در صورتی که پیش تر در سایت ثبت نام کردید از گزینه ورود استفاده نمایید.")->warning();
            return redirect()->route('register');
        } else {
            if(Cart::total() == 0) {
                flash("سبد خرید شما خالی است لطفا ابتدا آیتم مورد نظر خود را انتخاب کنید.")->warning();
                return redirect()->route('file');
            }
            $invoice = new Invoice();
            $invoice->user_id = Auth::user()->id;
            $invoice->status = 'sent';
            $invoice->total = Cart::total();
            $invoice->tax = Cart::tax();
            $invoice->type = 'sale';
            $invoice->password = uniqid();
            $invoice->invoice_at = date("Y-m-d H:i:s");
            if(session('name') == Auth::user()->name) {
                $invoice->name = session('name');
            }
            $invoice->zip_code = Auth::user()->zip_code;
            $invoice->phone = Auth::user()->phone;
            $invoice->address = Auth::user()->address;

            $invoice->save();

            foreach (Cart::content() as $item) {
                $record = new Record();
                $record->invoice_id = $invoice->id;
                $record->description = $item->name;
                $record->quantity = ($item->qty) * -1;
                $record->price = $item->price;
                $record->total = $item->qty * $item->price;
                $record->item_id = $item->id;
                $record->save();
            }
            Cart::destroy();
            if(Auth::check()) {
                $user = Auth::user();
                try {
                    Notification::send($user, new InvoiceCreated($invoice, $user));
                } catch (\Exception $e) {}

            }
            return redirect()->route('invoice.view', ['id' => $invoice->id]);
        }

    }
}