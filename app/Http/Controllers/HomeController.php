<?php

namespace App\Http\Controllers;

use App\Page;
use App\Article;
use App\File;
use App\Discussion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::limit(5)->orderBy('created_at', 'desc')->get();
        $files = File::limit(5)->orderBy('updated_at', 'desc')->get();
        $discussions = Discussion::limit(5)->orderBy('updated_at', 'desc')->get();
        $page = Page::findWithCache(config('platform.index-page-id'));
        return view('home.index',['page' => $page, 'files' => $files, 'articles' => $articles, 'discussions' => $discussions]);
    }

    public function getLastArticles()
    {

    }

    public function  getLastFileUpdates()
    {

    }
}
