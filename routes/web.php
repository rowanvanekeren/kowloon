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
    Route::get('dog', 'CategoriesController@GetDogView');
    Route::get('cat', 'CategoriesController@GetCatView');
    Route::get('fish', 'CategoriesController@GetFishView');
    Route::get('hamster', 'CategoriesController@GetHamsterView');
    Route::get('bird', 'CategoriesController@GetBirdView');
    Route::get('help', 'Controller@GetHelpView');
    Route::get('search', 'Controller@GetSearchView');

    Route::get('detail/{id}', 'Controller@getDetailView');


    Route::group(['middleware' => 'auth'], function () {
        Route::get('create_article', 'Controller@createView');
        Route::get('update_faq/{id}', 'Controller@getFaqUpdateView');
        Route::get('create_faq/{id?}', 'Controller@getFaqCreateView');
        Route::get('update_article/{id}', 'Controller@getUpdateArticleView');
    });
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
    Route::get('/logout', array('as' => 'login', 'uses' => 'Auth\LoginController@logout'));
/*    Route::post('/login', array('as' => 'login', 'uses' => 'Auth\LoginController@postLogin'));*/
    Route::post('/search', 'Controller@getSearchResults');
    Route::post('/checked', 'FilterController@getForm');
    Route::post('/dog', 'FilterController@getForm');
    Route::post('/bird', 'FilterController@getForm');
    Route::post('/fish', 'FilterController@getForm');
    Route::post('/hamster', 'FilterController@getForm');
    Route::post('/cat', 'FilterController@getForm');
    Route::post('/create_article', 'Controller@createArticle');

    Route::post('/update_article', 'Controller@updateArticle');
    Route::post('/add_subscriber', 'EmailController@addSubscriber');
    Route::post('/update_faq', 'Controller@updateFaq');
    Route::post('/create_faq', 'Controller@createFaq');


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



