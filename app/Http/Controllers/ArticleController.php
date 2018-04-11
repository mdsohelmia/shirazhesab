<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function view($id)
    {

        $article = Article::findWithCache($id);
        return view('article.view',['article' => $article]);
    }

    public function slug($id, $slug)
    {
        $article = Article::findWithCache($id);
        return view('article.view',['article' => $article]);
    }

    public function json()
    {
        $articles = Article::select(['title','id'])->limit(5)->orderBy('created_at', 'desc')->get();
        $articles_array = array();
        $i = 0;
        foreach ($articles as $article) {
            $articles_array[$i]['title'] = $article->title;
            $articles_array[$i]['id'] = $article->id;
            $articles_array[$i]['url'] = route('article.view',[$article->id]);
            $i++;
        }
        return response()->json($articles_array);
    }
}
