<?php

namespace App\Http\Controllers;

use App\Models\ArticlesTranslation;
use App\Models\Category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Article;
use App\Models\ArticleTranslation;
use App\Models\Color;
use App\Models\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
      /*  App::setLocale('nl');*/
        //its just a dummy data object.
      /*  $categories = Category::with('translation')->get();*/

        // Sharing is caring
 /*       View::share('categories', $categories);*/
    }
    public function getCategories(){
        $categories = Category::with('translation')->get();
        return $categories;
    }
    public function getAllArticles($locale){
       App::setLocale($locale);


        $arttrans = ArticlesTranslation::with('collection')->get();
       $articles = Article::with('translation','color','translation.collection.translation', 'faq.translation' ,
           'translation.category.translation', 'translation.specification.translation')->paginate(5);

        return view('welcome', ['artcles' => $articles]);

    }
    public function getHotItems(){
        $articles = Article::with('translation','image.translation')->where('hot_item','=',1)->take(7)->get();
        return $articles;
    }
    public function getHomeView($locale){
        $articles = $this->getHotItems();
        App::setLocale($locale);
        $categories = $this->getCategories();
        return View('home', ['categories' => $categories, 'articles' => $articles]);
    }
    public function getDogView($locale){
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[0]->id);

        return View('dog', ['collections' => $collections,'categories' => $categories, 'articles' => $articles]);
    }
    public function getBirdView($locale){
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[3]->id);
      /*  Input::flash();*/
        return View('bird', ['collections' => $collections,'categories' => $categories, 'articles' => $articles])->withInput(Input::all());
    }
    public function getHamsterView($locale){
        App::setLocale($locale);
        /*Input::reflash();*/
        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[4]->id);

        return View('hamster', ['collections' => $collections,'categories' => $categories,
            'articles' => $articles]);/*->withInput(Input::all());*/
    }
    public function getCatView($locale){
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[1]->id);
/*        dd($articles);*/
        if(isset($articles)){
            return View('cat', ['collections' => $collections,'categories' => $categories, 'articles' => $articles]);
        }else{
            return View('cat', ['collections' => $collections,'categories' => $categories, 'articles' => $articles])->withErrors(['no_articles' =>  Lang::get('errors.no_article')]);
        }

    }
    public function getFishView($locale){
        App::setLocale($locale);

        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByCategory($categories[2]->id);

        return View('fish', ['collections' => $collections,'categories' => $categories, 'articles' => $articles]);
    }



    public function getArticlesByCollection($locale,$coll_id){
        App::setLocale($locale);
        $byCollection = Article::with('translation')->whereHas('translation', function($query) use ($coll_id) {
            $query->where('collection_id', '=', $coll_id );
        })->get();

        dd($byCollection);
    }

    public function getArticlesByCategory($cat_id){

        $count = Article::with('translation')->whereHas('translation', function($query) use ($cat_id) {
            $query->where('category_id', '=', $cat_id );
        })->count();

        if($count!= 0){
            $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id) {
                $query->where('category_id', '=', $cat_id );
            })->paginate(3);
            return $articles;
        }else{
            return null;
        }


    }

    public function getArticlesByFilter($cat_id, $coll_array,  $min_price = 0, $max_price = 1000){
        $pagination = 3;


             $count = Article::with('translation')->whereHas('translation', function($query) use ($cat_id, $coll_array, $min_price, $max_price) {
                $query->where('category_id', '=', $cat_id )->whereBetween('price', [$min_price, $max_price])->whereIn('collection_id', $coll_array);
            })->count();
            if($count != 0){
               $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id, $coll_array, $min_price, $max_price) {
                    $query->where('category_id', '=', $cat_id )->whereBetween('price', [$min_price, $max_price])->whereIn('collection_id', $coll_array);
                })->paginate($pagination);
                 return $articles;
            }else{
              /*  $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id, $coll_array, $min_price, $max_price) {
                    $query->where('category_id', '=', $cat_id )->whereBetween('price', [$min_price, $max_price]);
                })->paginate($pagination);*/
                return null;
            }
    }

    public function getForm($locale, Request $request){

        $coll_ids = array();
        if(isset($request->chkbx)){
        foreach($request->chkbx as $key => $value)
        {
            if($value == 1){
                array_push($coll_ids,$key);
            }

        };
        }
      /*  dd($this->getArticlesByFilter($request->category_id, $coll_ids));*/
        App::setLocale($locale);

        Input::flash();


        $categories = $this->getCategories();
        $collections = Collection::with('translation')->get();
        $articles = $this->getArticlesByFilter($request->category_id, $coll_ids,$request->minprice,$request->maxprice);
        if(!isset($articles)){
            $articles = $this->getArticlesByCategory($request->category_id);
            return View($request->view_name, ['collections' => $collections,'categories' => $categories, 'articles' => $articles])->withInput($request)->withErrors(['no_articles_filter' => Lang::get('errors.filter_null')]);
        }else{

            return View($request->view_name, ['collections' => $collections,'categories' => $categories, 'articles' => $articles])->withInput($request);
        }





    }
/*    public function getFilteredArticlesByCategory(Request $request){



        $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id) {
            $query->where(['category_id', '=', $cat_id])->whereIn('collection_id', );
        })->paginate(3);
        return $articles;
    }*/

}
