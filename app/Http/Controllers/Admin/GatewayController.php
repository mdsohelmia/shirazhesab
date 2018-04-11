<?php

namespace App\Http\Controllers\Admin;

use App\Gateway;
use App\User;
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

    }

    public function edit($id, Request $request)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function transactions($id)
    {

    }
}
