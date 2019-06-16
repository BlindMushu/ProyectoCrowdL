<?php
//Route::get('/','FrontController@index')->name('front.index');

Route::get('/','HomeController@index')->name('home.index');

Route::get('categories/{name}', [
    'uses'  => 'InvestsController@searchCategory',
    'as'    => 'front.search.category'
]);

Route::get('tags/{name}', [
    'uses'  => 'InvestsController@searchTag',
    'as'    => 'front.search.tag'
]);

Route::get('articles/{slug}', [
    'uses'  => 'FrontController@viewArticle',
    'as'    => 'front.view.article'
]);



Route::get('admin', [
    'uses'  => 'WelcomeController@index',
    'as'    => 'admin.welcome'
]);

Route::prefix('admin')->group(function(){

    Route::resource('invests', 'InvestsController');

    Route::resource('pays', 'PaysController');

    Route::resource('payment_invests', 'PaymentInvestsController');

    Route::get('pays/{$id}/edit', 'PaysController@edit')->name('pays.edit');

    Route::resource('trades', 'TradesController');

    Route::get('trades/{$id}/edit', 'TradesController@edit')->name('trades.edit');
    //Route::get('invests/{$id}/store', 'InvestsController@store')->name('invests.store');
    Route::get('invests/{$id}/edit', 'InvestsController@edit')->name('invests.edit');
    Route::get('images','ImagesController@index')->name('images.index');

	Route::resource('users','UsersController');

	Route::get('users/{id}/destroy', 'UsersController@destroy')->name('admin.users.destroy');

	Route::get('users/{id}/edit', 'UsersController@edit')->name('admin.users.edit');

	Route::resource('categories', 'CategoriesController');

	Route::get('categories/{id}/destroy', 'CategoriesController@destroy')->name('admin.categories.destroy');

	Route::get('categories/{id}/edit', 'CategoriesController@edit')->name('admin.categories.edit');

    Route::resource('tags', 'TagsController');

    Route::get('tags/{id}/destroy', 'TagsController@destroy')->name('admin.tags.destroy');

    Route::get('tags/{id}/edit', 'TagsController@edit')->name('admin.tags.edit');

    Route::resource('articles', 'ArticlesController');

    Route::get('articles/{id}/destroy', 'ArticlesController@destroy')->name('admin.articles.destroy');

    Route::get('articles/{id}/edit', 'ArticlesController@edit')->name('admin.articles.edit');
});


Route::get('admin/auth/login', [
    'uses'  => 'Auth\LoginController@showLoginForm',
    'as'    => 'admin.auth.login'
]);

Route::post('admin/auth/login', [
    'uses'  => 'Auth\LoginController@login',
    'as'    => 'admin.auth.login'
]);

Route::get('admin/auth/logout', [
    'uses'  => 'Auth\LoginController@logout',
    'as'    => 'admin.auth.logout'
]);
