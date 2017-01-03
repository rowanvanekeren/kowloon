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
    Route::post('/checked', 'Controller@getForm');
    Route::post('/dog', 'Controller@getForm');
    Route::post('/bird', 'Controller@getForm');
    Route::post('/fish', 'Controller@getForm');
    Route::post('/hamster', 'Controller@getForm');
    Route::post('/cat', 'Controller@getForm');
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