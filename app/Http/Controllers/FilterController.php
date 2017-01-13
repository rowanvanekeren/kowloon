<?php

namespace App\Http\Controllers;

/*use Illuminate\Http\Request;*/
use Symfony\Component\HttpFoundation\Request;
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

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FilterController extends Controller
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
    public function getArticlesByFilter($cat_id, $coll_array, $min_price = 0, $max_price = 1000, $order_by = 'created_at', $order_by_updwn = 'DESC')
    {
        $pagination = 5;


        $count = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $coll_array, $min_price, $max_price) {
            if (isset($coll_array[0])) {
                $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price])->whereIn('collection_id', $coll_array);
            } else {
                $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price]);
            }

        })->count();


        if ($count != 0) {
            $articles = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $coll_array, $min_price, $max_price, $order_by, $order_by_updwn) {
                if (isset($coll_array[0])) {
                    $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price])->whereIn('collection_id', $coll_array)->orderBy($order_by, $order_by_updwn);
                } else {
                    $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price])->orderBy($order_by, $order_by_updwn);
                }
            })->paginate($pagination);
            /* dd($articles);*/
            return $articles;
        } else {
            /*  $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id, $coll_array, $min_price, $max_price) {
                  $query->where('category_id', '=', $cat_id )->whereBetween('price', [$min_price, $max_price]);
              })->paginate($pagination);*/
            return null;
        }
    }

    public function getForm($locale, Request $request)
    {
        Input::flash();
        App::setLocale($locale);
        $order_by = 'created_at';
        $order_type = 'DESC';
        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        switch ($request->order_by) {
            case 'price_up':
                $order_by = 'price';
                $order_type = 'DESC';
                break;
            case 'price_down':
                $order_by = 'price';
                $order_type = 'ASC';
                break;
            case 'latest':
                $order_by = 'created_at';
                $order_type = 'DESC';
                break;
            case 'oldest':
                $order_by = 'created_at';
                $order_type = 'ASC';
                break;
            case 'default':
                $order_by = 'created_at';
                $order_type = 'DESC';
                break;
        }

        $coll_ids = array();
        if (isset($request->chkbx)) {
            foreach ($request->chkbx as $key => $value) {
                if ($value == 1) {
                    array_push($coll_ids, $key);
                }

            };

            /*  dd($this->getArticlesByFilter($request->category_id, $coll_ids));*/
        }


        $articles = $this->getArticlesByFilter($request->category_id, $coll_ids, $request->minprice, $request->maxprice, $order_by, $order_type);
        if (!isset($articles) /*&& isset($coll_ids) || isset($request->minprice) || isset($request->maxprice)*/) {
            $articles = $this->getArticlesByCategory($request->category_id, $order_by, $order_type);
            return View($request->view_name, ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withInput($request)->withErrors(['no_articles_filter' => Lang::get('errors.filter_null')]);
        } else {
            return View($request->view_name, ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withInput($request);
        }


    }
}
