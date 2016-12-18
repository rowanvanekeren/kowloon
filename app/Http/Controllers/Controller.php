<?php

namespace App\Http\Controllers;

use App\Models\ArticlesTranslation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Article;
use App\Models\ArticleTranslation;
use App\Models\Color;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAllArticles($locale){
       App::setLocale($locale);
        $arttrans = ArticlesTranslation::with('collection')->get();
       $articles = Article::with('translation','color','translation.collection.translation',
           'translation.category.translation', 'translation.specification.translation')->paginate(5);
        dd($articles);
        return view('welcome', ['artcles' => $articles]);

    }
}
