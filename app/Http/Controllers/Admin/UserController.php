<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function data()
    {
        return DataTables::eloquent(User::select(['id','name','email','mobile']))
            ->addColumn('balance',function($user){return number_format($user->balance());})
            ->addColumn('action', 'admin.user.action')
            ->make(true);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit',['user' => $user]);
    }

    public function insert(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'mobile' => 'required|numeric|digits:11|unique:users,mobile',
            'password' => 'required|string|min:6|confirmed',
            'level' => 'required',
        ])->validate();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->note = $request->note;
        $user->title = $request->title;
        $user->level = $request->level;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->telegram_password = $user->id . rand(1,9) . rand(100,999);
        $user->save();

        flash('کاربر با موفقیت اضافه شد.')->success();
        return redirect()->route('admin.user');
    }

    public function update($id, Request $request)
    {
        if($id == config('platform.main-admin-user-id') && Auth::user()->id != config('platform.main-admin-user-id') ) {
            flash('شما نمی توانید مدیر اصلی سیستم را ویرایش کنید.')->error();
            return redirect()->route('admin.user');
        }
        $user = User::findOrFail($id);
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'required|numeric|digits:11|unique:users,mobile,' . $user->id,
            'password' => 'confirmed',
            'level' => 'required',
        ])->validate();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->note = $request->note;
        $user->title = $request->title;
        $user->level = $request->level;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        flash('کاربر با موفقیت ویرایش شد.')->success();
        return redirect()->route('admin.user.edit',['id' => $user->id]);
    }

    public function delete($id, Request $request)
    {
        if($id == Auth::user()->id) {
            flash('شما نمی توانید خودتان را حذف کنید.')->error();
            return redirect()->route('admin.user');
        } else if($id == config('platform.main-admin-user-id')) {
            flash('شما نمی توانید مدیر اصلی سیستم را حذف کنید.')->error();
            return redirect()->route('admin.user');
        }
        $user = User::findOrFail($id);
        $user->delete();
        flash('حذف کاربر با موفقیت انجام شد.')->success();
        return redirect()->route('admin.user');
    }
}
