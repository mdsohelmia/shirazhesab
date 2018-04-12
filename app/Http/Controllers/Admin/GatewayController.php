<?php

namespace App\Http\Controllers\Admin;

use App\Gateway;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $gateways = Gateway::orderBy('created_at', 'desc')->paginate(config('platform.file-per-page'));
        return view('admin.gateway.index',['gateways' => $gateways]);
    }

    public function create()
    {
        $users = User::all();
        return view('admin.gateway.create',['users' => $users]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'payment_password' => 'required|min:6',
            'callback_password' => 'required|min:6',
            'code' => 'nullable|unique:gateways,code',
            'enable' => 'required',
            'verity' => 'required',
            'gateway' => 'required',
            'website' => 'nullable|url',
            'callback_hook' => 'nullable|url',
        ]);
        $gateway = new Gateway();
        $gateway->title = $request->title;
        $gateway->code = $request->code;
        $gateway->description = $request->description;
        $gateway->payment_password = $request->payment_password;
        $gateway->callback_password = $request->callback_password;
        $gateway->enable = $request->enable;
        $gateway->verity = $request->verity;
        $gateway->gateway = $request->gateway;
        $gateway->website = $request->website;
        $gateway->callback_hook = $request->callback_hook;
        $gateway->user_id = $request->user_id;
        $gateway->save();
        flash('درگاه با موفقیت ایجاد شد.')->success();
        return redirect()->route('admin.gateway');
    }

    public function edit($id, Request $request)
    {

    }

    public function update($id, Request $request)
    {
        $gateway = Gateway::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'payment_password' => 'required|min:6',
            'callback_password' => 'required|min:6',
            'code' => 'required|unique:gateways,code,' . $gateway->id,
            'enable' => 'required',
            'verity' => 'required',
            'gateway' => 'required',
            'website' => 'nullable|url',
            'callback_hook' => 'nullable|url',
        ]);



    }

    public function transactions($id)
    {

    }
}
