<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        if (Session::token() != Input::get('_token')) {
            throw new Illuminate\Session\TokenMismatchException;
        }
        $funcNum = Input::get('CKEditorFuncNum');
        $message = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $image = new Image();
                $image->source = $request->file('upload')->store('public');
                $image->size = $request->file('upload')->getSize();
                $image->user_id = Auth::user()->id;
                $image->save();
                $url = Storage::url($image->source);
            } else {
                $message = 'خطای در زمان لود تصویر رخ داد.';
            }
        } else {
            $message = 'فایل بارگزاری نشد.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
