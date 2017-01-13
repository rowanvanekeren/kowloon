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

    public function getRelatedArticles($cat_id, $coll_id)
    {
        $articles = Article::with('translation', 'image.translation')->whereHas('translation', function ($query) use ($cat_id, $coll_id) {
            $query->where([['collection_id', '=', $coll_id],
                ['category_id', '=', $cat_id]]);
        })->get();

        return $articles;
    }

    public function getDetailView($locale, $id)
    {
        App::setLocale($locale);
        $categories = $this->getCategories();
        $article = Article::with('translation', 'color', 'faq.translation', 'image.translation'
        )->find($id);
        $specifications = Specification::with('translation')->find($article->translation[0]->specification_id);
        $collection = Collection::with('translation')->find($article->translation[0]->collection_id);
        $category = Category::with('translation')->find($article->translation[0]->category_id);
        $related = $this->getRelatedArticles($category->id, $collection->id);
        return view('detail', ['article' => $article, 'specifications' => $specifications,
            'collection' => $collection, 'categories' => $categories, 'article_category' => $category,
            'related' => $related]);
    }

    public function getUpdateArticleView($locale, $id)
    {
        App::setLocale($locale);
        $categories = $this->getCategories();
        $article = Article::with('alltranslation', 'color', 'faq.alltranslation', 'image.alltranslation'
        )->find($id);
        $specifications = Specification::with('alltranslation')->find($article->translation[0]->specification_id);
        $collection = $this->getCollections();
        $category = Category::with('translation')->find($article->translation[0]->category_id);
        /*dd($specifications);*/
        /*  dd($article);*/
        return view('admin_update', ['articles' => $article, 'specifications' => $specifications,
            'collections' => $collection, 'categories' => $categories, 'article_category' => $category,
            'main_article' => $id
        ]);
    }

    public function updateArticle($locale, Request $request)
    {
       /* dd($request->id);*/
        App::setLocale($locale);

        $this->validate($request, [
            'dimension_spec_nl' => 'required',
            'descr_spec_nl' => 'required',
            'size_spec_nl' => 'required',
            'dimension_spec_en' => 'required',
            'descr_spec_en' => 'required',
            'size_spec_en' => 'required',
            'img_id_en' => 'required',
            'image' => 'required',
            'img_descr_nl' => 'required',
            'img_descr_en' => 'required',
            'color' => 'required',
            'title_en' => 'required',
            'img_descr_en' => 'required',
            'img_descr_en' => 'required',
            'img_descr_en' => 'required',
            'img_descr_en' => 'required',
            'img_descr_en' => 'required',
            'img_descr_en' => 'required',
            'img_descr_en' => 'required',
        ]);

        foreach ($request->id_spec_nl as $key => $id) {
            $spec_nl = SpecificationsTranslation::find($id);
            $spec_nl->dimension = $request->dimension_spec_nl[$key];
            $spec_nl->description = $request->descr_spec_nl[$key];
            $spec_nl->size = $request->size_spec_nl[$key];
            $spec_nl->save();
        }
        foreach ($request->id_spec_en as $key => $id) {
            $spec_en = SpecificationsTranslation::find($id);
            $spec_en->dimension = $request->dimension_spec_en[$key];
            $spec_en->description = $request->descr_spec_en[$key];
            $spec_en->size = $request->size_spec_en[$key];
            $spec_en->save();
        }
        foreach ($request->img_id_en as $key => $id) {
            $image = ImagesTranslation::find($id);
            if (isset($request->image[$key]) && $request->image[$key] != $image->image) {

                $uploadImage = $this->uploadImage($request->image[$key]);
                if (isset($uploadImage)) {
                    $image->image = $uploadImage;
                }
            }
            $image->description = $request->img_descr_en[$key];
            $image->save();
        }
        foreach ($request->img_id_nl as $key => $id) {
            $image = ImagesTranslation::find($id);
            if (isset($request->image[$key]) && $request->image[$key] != $image->image) {
                $uploadImage = $this->uploadImage($request->image[$key]);
                if (isset($uploadImage)) {
                    $image->image = $uploadImage;
                }
            }
            $image->description = $request->img_descr_nl[$key];
            $image->save();
        }
        foreach ($request->color_id as $key => $id) {
            $color = Color::find($id);
            $color->hex = $request->color[$key];
            $color->save();
        }
        function updateNLArticle(Request $request)
        {
            $article = ArticlesTranslation::find($request->art_id_nl);
            $article->title = $request->title_nl;
            $article->description = $request->description_nl;
            $article->tags = $request->tags_nl;
            $article->price = $request->price_nl;
            $article->save();
        }

        updateNLArticle($request);
        function updateENArticle(Request $request)
        {
            $article = ArticlesTranslation::find($request->art_id_en);
            $article->title = $request->title_en;
            $article->description = $request->description_en;
            $article->tags = $request->tags_en;
            $article->price = $request->price_en;
            $article->save();
        }
        updateENArticle($request);

        return Redirect(App::getLocale() . '/update_article/' . $request->main_article );
    }

    public function getCategories()
    {
        $categories = Category::with('translation')->get();
        return $categories;
    }


    public function getAllArticles($locale)
    {


        $articles = $this->getHotItems();
        App::setLocale($locale);
        $categories = $this->getCategories();
        return View('home', ['categories' => $categories, 'articles' => $articles]);

    }

    public function createView($locale)
    {
        $articles = $this->getHotItems();
        App::setLocale($locale);
        $categories = $this->getCategories();
        $collections = $this->getCollections();
        return View('admin_create', ['categories' => $categories, 'collections' => $collections]);

    }

    public function saveImage($request, $art_id)
    {
        $files = $request->image;
        $article_id = $art_id;
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $key => $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            $destinationPath = base_path() . "/public/images/article_pictures";
            $filename = $file->getClientOriginalName();

            if ($validator->passes() && isset($article_id)) {
                $image = new Image([
                ]);
                $image->save();
                $imageTranslation_nl = new ImagesTranslation([
                    'image' => $filename,
                    'description' => (isset($request->img_descr_nl[$key])) ? $request->img_descr_nl[$key] : '',
                    'locale' => 'nl',
                    'image_id' => $image->id
                ]);
                $imageTranslation_en = new ImagesTranslation([
                    'image' => $filename,
                    'description' => (isset($request->img_descr_en[$key])) ? $request->img_descr_en[$key] : '',
                    'locale' => 'en',
                    'image_id' => $image->id
                ]);

                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount++;
                $imageTranslation_nl->save();
                $imageTranslation_en->save();
                $art_img = new ArticlesImage([
                    'article_id' => $article_id,
                    'image_id' => $image->id,
                    'order' => $uploadcount,
                ]);
                $art_img->save();
            }
        }
        if ($uploadcount == $file_count) {

            return 'succes';
        } else {
            return 'error';
        }
    }

    public function uploadImage($image)
    {
        $file = $image;
        $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('file' => $file), $rules);
        $destinationPath = base_path() . "/public/images/article_pictures";
        $filename = $file->getClientOriginalName();
        if ($validator->passes) {
            $upload_success = $file->move($destinationPath, $filename);
            return $filename;
        } else {
            return null;
        }


    }

    public function saveColor($request, $art_id)
    {
        /*   $colors_en = $request->color_en;
           $colors_nl = $request->color_en;*/

        $colors = $request->color;

        foreach ($colors as $color) {
            $colors_count = Color::where('hex', '=', $color)->count();

            if ($colors_count != 0) {
                $existing_color = Color::where('hex', '=', $color)->first();
                $color_new = new Color([
                    'hex' => $existing_color->hex
                ]);
                $color_new->save();

                $art_color = new ArticlesColor([
                    'article_id' => $art_id,
                    'color_id' => $color_new->id
                ]);
                $art_color->save();

            } else {
                $color_new = new Color([
                    'hex' => $color
                ]);
                $color_new->save();

                $art_color = new ArticlesColor([
                    'article_id' => $art_id,
                    'color_id' => $color_new->id
                ]);
                $art_color->save();
            }

        }
        return 'succes';
    }

    public function createArticle($locale, Request $request)
    {
        App::setLocale($locale);
        /*dd($request);*/

        $article = new Article([
            'hot_item' => 0
        ]);
        $article->save();
        if (isset($request->dimension_spec_nl) && isset($request->dimension_spec_en)) {
            $specification = new Specification([]);
            $specification->save();
            foreach ($request->dimension_spec_nl as $key => $spec_dimension) {
                $specificationTranslation_nl = new SpecificationsTranslation([
                    'dimension' => $spec_dimension,
                    'description' => $request->descr_spec_nl[$key],
                    'size' => $request->size_spec_nl[$key],
                    'locale' => 'nl',
                    'specification_id' => $specification->id
                ]);
                $specificationTranslation_nl->save();
            }
            foreach ($request->dimension_spec_en as $key => $spec_dimension) {
                $specificationTranslation_en = new SpecificationsTranslation([
                    'dimension' => $spec_dimension,
                    'description' => $request->descr_spec_en[$key],
                    'size' => $request->size_spec_en[$key],
                    'locale' => 'en',
                    'specification_id' => $specification->id
                ]);
                $specificationTranslation_en->save();
            }

            $articleTranslation_nl = new ArticlesTranslation([
                'title' => $request->title_nl,
                'description' => $request->description_nl,
                'price' => $request->price_nl,
                'tags' => $request->tags_nl,
                'category_id' => $request->dd_category,
                'collection_id' => $request->dd_collection,
                'article_id' => $article->id,
                'specification_id' => $specification->id,
                'locale' => 'nl'
            ]);
            $articleTranslation_nl->save();

            $articleTranslation_en = new ArticlesTranslation([
                'title' => $request->title_en,
                'description' => $request->description_en,
                'price' => $request->price_en,
                'tags' => $request->tags_en,
                'category_id' => $request->dd_category,
                'collection_id' => $request->dd_collection,
                'article_id' => $article->id,
                'specification_id' => $specification->id,
                'locale' => 'en'
            ]);
            $articleTranslation_en->save();

            $uplImg = $this->saveImage($request, $article->id);
            $uplClr = $this->saveColor($request, $article->id);

            return 'succes';
        }
        return 'dunno';

    }

    public function getHotItems()
    {
        $articles = Article::with('translation', 'image.translation')->where('hot_item', '>', 0)->orderBy('hot_item')->paginate(4);
        return $articles;
    }

    public function getCollections()
    {
        $collections = Collection::with('translation')->get();
        return $collections;
    }

    public function getHomeView($locale)
    {
        $articles = $this->getHotItems();
        App::setLocale($locale);
        $categories = $this->getCategories();
        return View('home', ['categories' => $categories, 'articles' => $articles]);
    }

    public function getHelpView($locale)
    {
        $articles = $this->getHotItems();
        App::setLocale($locale);
        $categories = $this->getCategories();
        return View('home', ['categories' => $categories, 'articles' => $articles]);
    }

    public function getSearchView($locale)
    {

        App::setLocale($locale);
        $categories = $this->getCategories();
        return View('search', ['categories' => $categories]);
    }
//
//    public function getDogView($locale)
//    {
//        App::setLocale($locale);
//
//        $categories = $this->getCategories();
//        $collections = Collection::with('translation')->get();
//        $articles = $this->getArticlesByCategory($categories[0]->id);
//
//        return View('dog', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles]);
//    }
//
//    public function getBirdView($locale)
//    {
//        App::setLocale($locale);
//
//        $categories = $this->getCategories();
//        $collections = Collection::with('translation')->get();
//        $articles = $this->getArticlesByCategory($categories[3]->id);
//        /*  Input::flash();*/
//        return View('bird', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withInput(Input::all());
//    }
//
//    public function getHamsterView($locale)
//    {
//        App::setLocale($locale);
//        /*Input::reflash();*/
//        $categories = $this->getCategories();
//        $collections = Collection::with('translation')->get();
//        $articles = $this->getArticlesByCategory($categories[4]->id);
//
//        return View('hamster', ['collections' => $collections, 'categories' => $categories,
//            'articles' => $articles]);/*->withInput(Input::all());*/
//    }
//
//    public function getCatView($locale)
//    {
//        App::setLocale($locale);
//
//        $categories = $this->getCategories();
//        $collections = Collection::with('translation')->get();
//        $articles = $this->getArticlesByCategory($categories[1]->id);
//        /*        dd($articles);*/
//        if (isset($articles)) {
//            return View('cat', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles]);
//        } else {
//            return View('cat', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withErrors(['no_articles' => Lang::get('errors.no_article')]);
//        }
//
//    }

//    public function getFishView($locale)
//    {
//        App::setLocale($locale);
//
//        $categories = $this->getCategories();
//        $collections = Collection::with('translation')->get();
//        $articles = $this->getArticlesByCategory($categories[2]->id);
//
//        return View('fish', ['collections' => $collections, 'categories' => $categories, 'articles' => $articles]);
//    }

    public function getArticlesByCollection($locale, $coll_id)
    {
        App::setLocale($locale);
        $byCollection = Article::with('translation')->whereHas('translation', function ($query) use ($coll_id) {
            $query->where('collection_id', '=', $coll_id);
        })->get();

        dd($byCollection);
    }

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

    public function getSearchResults($locale, Request $request)
    {
        App::setLocale($locale);
        Input::flash();
        $categories = $this->getCategories();
        $cat_ids = array();
        if (isset($request->search)) {
            if (isset($request->chkbx)) {
                foreach ($request->chkbx as $key => $value) {
                    if ($value == 1) {
                        array_push($cat_ids, $key);
                    }

                };
            } else {
                foreach ($categories as $category) {
                    array_push($cat_ids, $category->id);
                }
            }
            $articles = $this->searchResults($request->search, $cat_ids, $request->minprice, $request->maxprice);
        }


        if (!isset($articles) /*&& isset($coll_ids) || isset($request->minprice) || isset($request->maxprice)*/) {
            /*$articles = $this->getArticlesByCategory($request->category_id,$order_by, $order_type);*/
            return View('search', ['categories' => $categories, 'articles' => ''])->withInput($request)->withErrors(['no_articles_filter' => Lang::get('errors.filter_null')]);
        } else {
            return view('search', ['articles' => $articles, 'categories' => $categories]);
        }


    }

    public function searchResults($search_string, $cat_id, $min_price = 0, $max_price = 800)
    {


        $count = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $min_price, $max_price, $search_string) {
            $query->whereIn('category_id', $cat_id)->whereBetween('price', [$min_price, $max_price])->where(function ($query) use ($search_string) {
                $query->where('title', 'LIKE', '%' . $search_string . '%')->orWhere('description', 'LIKE', '%' . $search_string . '%')
                    ->orWhere('tags', 'LIKE', '%' . $search_string . '%');
            });
        })->count();

        if ($count != 0) {
            $article = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $min_price, $max_price, $search_string) {
                $query->whereIn('category_id', [1, 2, 3, 4])->whereBetween('price', [$min_price, $max_price])->where(function ($query) use ($search_string) {
                    $query->where('title', 'LIKE', '%' . $search_string . '%')->orWhere('description', 'LIKE', '%' . $search_string . '%')
                        ->orWhere('tags', 'LIKE', '%' . $search_string . '%');
                });
            })->get();
            return $article;
        } else {
            return null;
        }
    }

//    public function getArticlesByFilter($cat_id, $coll_array, $min_price = 0, $max_price = 1000, $order_by = 'created_at', $order_by_updwn = 'DESC')
//    {
//        $pagination = 5;
//
//
//        $count = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $coll_array, $min_price, $max_price) {
//            if (isset($coll_array[0])) {
//                $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price])->whereIn('collection_id', $coll_array);
//            } else {
//                $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price]);
//            }
//
//        })->count();
//
//
//        if ($count != 0) {
//            $articles = Article::with('translation')->whereHas('translation', function ($query) use ($cat_id, $coll_array, $min_price, $max_price, $order_by, $order_by_updwn) {
//                if (isset($coll_array[0])) {
//                    $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price])->whereIn('collection_id', $coll_array)->orderBy($order_by, $order_by_updwn);
//                } else {
//                    $query->where('category_id', '=', $cat_id)->whereBetween('price', [$min_price, $max_price])->orderBy($order_by, $order_by_updwn);
//                }
//            })->paginate($pagination);
//            /* dd($articles);*/
//            return $articles;
//        } else {
//            /*  $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id, $coll_array, $min_price, $max_price) {
//                  $query->where('category_id', '=', $cat_id )->whereBetween('price', [$min_price, $max_price]);
//              })->paginate($pagination);*/
//            return null;
//        }
//    }
//
//    public function getForm($locale, Request $request)
//    {
//        Input::flash();
//        App::setLocale($locale);
//        $order_by = 'created_at';
//        $order_type = 'DESC';
//        $categories = $this->getCategories();
//        $collections = Collection::with('translation')->get();
//        switch ($request->order_by) {
//            case 'price_up':
//                $order_by = 'price';
//                $order_type = 'DESC';
//                break;
//            case 'price_down':
//                $order_by = 'price';
//                $order_type = 'ASC';
//                break;
//            case 'latest':
//                $order_by = 'created_at';
//                $order_type = 'DESC';
//                break;
//            case 'oldest':
//                $order_by = 'created_at';
//                $order_type = 'ASC';
//                break;
//            case 'default':
//                $order_by = 'created_at';
//                $order_type = 'DESC';
//                break;
//        }
//
//        $coll_ids = array();
//        if (isset($request->chkbx)) {
//            foreach ($request->chkbx as $key => $value) {
//                if ($value == 1) {
//                    array_push($coll_ids, $key);
//                }
//
//            };
//
//            /*  dd($this->getArticlesByFilter($request->category_id, $coll_ids));*/
//        }
//
//
//        $articles = $this->getArticlesByFilter($request->category_id, $coll_ids, $request->minprice, $request->maxprice, $order_by, $order_type);
//        if (!isset($articles) /*&& isset($coll_ids) || isset($request->minprice) || isset($request->maxprice)*/) {
//            $articles = $this->getArticlesByCategory($request->category_id, $order_by, $order_type);
//            return View($request->view_name, ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withInput($request)->withErrors(['no_articles_filter' => Lang::get('errors.filter_null')]);
//        } else {
//            return View($request->view_name, ['collections' => $collections, 'categories' => $categories, 'articles' => $articles])->withInput($request);
//        }
//
//
//    }

    public function getFaqUpdateView($locale, $id)
    {
        App::setLocale($locale);
        $categories = $this->getCategories();

        if (isset($id)) {
            /* $article  = Article::with('faq.translation')->where('id', '=' , $id)->first();*/
            $faqs = FaqTranslation::where('faq_id', '=', $id)->get();

            return view('admin_faq', ['categories' => $categories, 'faqs' => $faqs]);
        } else {
            return view('admin_faq', ['categories' => $categories]);
        }

    }

    public function getFaqCreateView($locale, $id = null)
    {
        App::setLocale($locale);
        $categories = $this->getCategories();

        if (isset($id)) {
            /* $article  = Article::with('faq.translation')->where('id', '=' , $id)->first();*/
            $article = Article::with('translation')->find($id);

            return view('admin_faq', ['categories' => $categories, 'article' => $article]);
        } else {
            return view('admin_faq', ['categories' => $categories]);
        }

    }

    public function updateFaq(Request $request)
    {
        /*     dd($request);*/
        if (isset($request->faqtrans_id)) {
            foreach ($request->faqtrans_id as $key => $faqtrans_id) {
                $curr_faq = FaqTranslation::find($faqtrans_id);
                $curr_faq->question = $request->question[$key];
                $curr_faq->answer = $request->answer[$key];
                $curr_faq->save();
            }
        }
    }

    public function createFaq(Request $request)
    {
        /* dd($request);*/


        $faq = new Faq([]);
        $faq->save();

        $faqTrans_nl = new FaqTranslation([
            'question' => $request->question_nl,
            'answer' => $request->answer_nl,
            'locale' => 'nl',
            'faq_id' => $faq->id
        ]);
        $faqTrans_en = new FaqTranslation([
            'question' => $request->question_en,
            'answer' => $request->answer_en,
            'locale' => 'nl',
            'faq_id' => $faq->id
        ]);
        $faqTrans_en->save();
        $faqTrans_nl->save();

        if (isset($request->faq_art_id)) {
            $article_faq = new ArticlesFaq([
                'article_id' => $request->faq_art_id,
                'faq_id' => $faq->id
            ]);
            $article_faq->save();
        }
        return 'succes';
    }
    /*    public function getFilteredArticlesByCategory(Request $request){



            $articles = Article::with('translation')->whereHas('translation', function($query) use ($cat_id) {
                $query->where(['category_id', '=', $cat_id])->whereIn('collection_id', );
            })->paginate(3);
            return $articles;
        }*/

}
