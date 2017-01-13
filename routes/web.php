<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/dogs', function () {
    return view('dogs');
});*/
View::composer('*', function($view){

    View::share('view_name', $view->getName());

});

Route::group(['prefix' => '/{locale}'], function ($locale) {

    Route::get('/', 'Controller@GetHomeView');
    Route::get('/home', 'Controller@GetHomeView');
    Route::get('dog', 'Controller@GetDogView');
    Route::get('cat', 'Controller@GetCatView');
    Route::get('fish', 'Controller@GetFishView');
    Route::get('hamster', 'Controller@GetHamsterView');
    Route::get('bird', 'Controller@GetBirdView');
    Route::get('help', 'Controller@GetHelpView');
    Route::get('search', 'Controller@GetSearchView');
    Route::get('create_article', 'Controller@createView');
    Route::get('update_faq/{id}', 'Controller@getFaqUpdateView');
    Route::get('create_faq/{id?}', 'Controller@getFaqCreateView');
    Route::get('detail/{id}', 'Controller@getDetailView');
    Route::get('update_article/{id}', 'Controller@getUpdateArticleView');
/*    Route::get('dog', function ($locale) {
        App::setLocale($locale);
        return view('dog');
    });*/
 /*   Route::get('cat', function ($locale) {
        App::setLocale($locale);
        return view('cat');
    });
    Route::get('fish', function ($locale) {
        App::setLocale($locale);
        return view('fish');
    });
    Route::get('hamster', function ($locale) {
        App::setLocale($locale);
        return view('hamster');
    });
    Route::get('bird', function ($locale) {
        App::setLocale($locale);
        return view('bird');
    });*/

    Auth::routes();
    Route::get('/login', array('as' => 'login', 'uses' => 'Auth\LoginController@getLogin'));
    Route::post('/search', 'Controller@getSearchResults');
    Route::post('/checked', 'Controller@getForm');
    Route::post('/dog', 'Controller@getForm');
    Route::post('/bird', 'Controller@getForm');
    Route::post('/fish', 'Controller@getForm');
    Route::post('/hamster', 'Controller@getForm');
    Route::post('/cat', 'Controller@getForm');
    Route::post('/create_article', 'Controller@createArticle');
    Route::post('/update_faq', 'Controller@updateFaq');
    Route::post('/create_faq', 'Controller@createFaq');
    Route::post('/update_article', 'Controller@updateArticle');
    Route::post('/add_subscriber', 'MailController@addSubscriber');

});

/*Route::get('/welcome/{locale}', 'Controller@GetAllArticles');*/
/*Route::get('/{locale}', 'Controller@GetAllArticles');*/
/*Route::get('/welcome/{locale}/{id}', 'Controller@getArticlesByCollection');*/
/*Route::get('welcome/{locale}', function ($locale) {
    App::setLocale($locale);

    if (App::isLocale('en')) {
        return view('welcome');
    }else if(App::isLocale('nl')){
        return view('welcome');
    }
});*/


Route::get('/home', 'HomeController@index');

