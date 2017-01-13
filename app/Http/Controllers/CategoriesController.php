<?php

namespace App\Http\Controllers;

use App\Models\ArticlesColor;
use App\Models\ArticlesFaq;
use App\Models\ArticlesImage;
use App\Models\ArticlesTranslation;
use App\Models\Category;
use App\Models\Faq;
use App\Models\FaqTranslation;
use App\Models\ImagesTranslation;
use App\Models\Specification;
use App\Models\SpecificationsTranslation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Article;
use App\Models\Color;
use App\Models\Image;
use App\Models\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{

    public function getArticlesByCategory($cat_id, $order_by = 'created_at', $order_by_updwn = 'DESC')
    {

        $count = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id) {
            $query->where('category_id', '=', $cat_id);
        })->count();

        if ($count != 0) {
            $articles = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $order_by, $order_by_updwn) {
                $query->where('category_id', '=', $cat_id)->orderBy($order_by, $order_by_updwn);
            })->paginate(5);
            return $articles;
        } else {
            return null;
        }


    }
    public function getCategories()
    {
        $categories = Category::with('translation')->get();
        return $categories;
    }

    public function getDogView($locale)
    {
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[0]->id);

        return View('dog', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles]);
    }

    public function getBirdView($locale)
    {
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[3]->id);
        /*  Input::flash();*/
        return View('bird', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withInput(Input::all());
    }

    public function getHamsterView($locale)
    {
        App::setLocale($locale);
        /*Input::reflash();*/
        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[4]->id);

        return View('hamster', ['collections' => $collections, 'categories' => $categories,
            'articles' => $articles]);/*->withInput(Input::all());*/
    }

    public function getCatView($locale)
    {
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[1]->id);
        /*        dd($articles);*/
        if (isset($articles)) {
            return View('cat', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles]);
        } else {
            return View('cat', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withErrors(['no_articles' => Lang::get('errors.no_article')]);
        }

    }

    public function getFishView($locale)
    {
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[2]->id);

        return View('fish', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles]);
    }
}
