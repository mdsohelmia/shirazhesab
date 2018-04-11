<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index($id)
    {

        $page = Page::findWithCache($id);
        if($page->access == 'private' && !Auth::check()) {
            return redirect()->guest('login');
        }
        return view('page.index',['page' => $page]);
    }

    public function slug($id,$slug)
    {
        $page = Page::findWithCache($id);
        if($page->access == 'private' && !Auth::check()) {
            return redirect()->guest('login');
        }
        return view('page.index',['page' => $page]);
    }

    public function contactUs()
    {
        $page = Page::findWithCache(config('platform.contact-us-page-id'));
        return view('page.index',['page' => $page]);
    }

    public function aboutUs()
    {
        $page = Page::findWithCache(config('platform.about-us-page-id'));
        return view('page.index',['page' => $page]);
    }
}
