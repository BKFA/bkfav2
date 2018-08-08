<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------|
*/

Route::group(['middleware' => 'localization', 'prefix' => Session::get('locale')], function() {
    // Home
    Route::name('home')->get('/', 'Front\PostController@index');
    Route::name('home.post.list')->post('home/{type}', 'Front\PostController@getPostByType');

    //Topic
    Route::name('topic')->get('topic/{topic}', 'Front\PostController@topic');

    // Posts and comments
    Route::group(['prefix' => 'posts', 'namespace' => 'Front'], function () {

        //Full Text Search posts
        Route::name('posts.search')->get('/search', 'PostController@search');

        //Post 
        Route::name('home.posts.create')->get('front/create', 'PostController@create');
        Route::name('home.posts.store')->post('front/create', 'PostController@store');
        Route::name('home.posts.edit')->get('front/edit/{post}', 'PostController@edit');
        Route::name('home.posts.update')->put('front/edit/{post}', 'PostController@update');
        Route::name('home.posts.destroy')->delete('front/destroy/{post}', 'PostController@destroy');

        Route::name('posts.questions')->post('questions/{type}', 'PostController@question');
        Route::name('posts.tag')->get('tag/{tag}', 'PostController@tag');
        Route::name('posts.comments.store')->post('{post}/comments', 'CommentController@store');
        Route::name('posts.comments.comments.store')->post('{post}/comments/{comment}/comments', 'CommentController@store');
        Route::name('posts.comments')->get('{post}/comments/{page}', 'CommentController@comments');

       Route::name('posts.display')->get('{slug}', 'PostController@show');

       // Contact 
        Route::name('home.contact.create')->get('contact/create', 'ContactController@create');
        Route::name('home.contact.store')->post('contact/create', 'ContactController@store');
    });

    //User Following , Rating
    Route::group(['middleware' => ['auth']], function () {
        Route::post('/follow/{user}', 'Front\FollowController@follow');
        Route::delete('/unfollow/{user}', 'Front\FollowController@unfollow');
        Route::name('posts.rate')->put('posts/rate/{post}', 'Front\RateController@rate');
    });

    //Delete comment
    Route::resource('comments', 'Front\CommentController', [
        'only' => ['destroy'],
        'names' => ['destroy' => 'front.comments.destroy'],
    ]);

    //Edit comment
    Route::name('comment.update')->put('front/comment/update/{comment}', 'Front\CommentController@update');

    //Submit comment
    Route::name('comment.submit')->post('front/comment/submit', 'Front\CommentController@submit');
    Route::name('comment.child.submit')->post('front/comment/child/submit/{comment}', 'Front\CommentController@submitChild');

    //User
    Route::resource('users', 'Front\UserController', [
        'only' => ['show', 'update'],
        'names' => ['show' => 'front.user.show', 'update' => 'front.user.update'],
    ]);
    Route::name('front.user.index')->get('/list-user',  'Front\UserController@index');

    //Search like users
    Route::name('users.search')->get('users/search/{key?}', 'Front\UserController@search');

    //Change avata user
    Route::name('front.user.avata')->post('front/user/avata/{user}', 'Front\UserController@avata');

    // Auth::routes();
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    //Send Mail valid Account
    Route::get('/user/verify/{confirmation_code}', 'Auth\RegisterController@verifyUser');
    //I18n
    Route::post('/lang', [
        'as' => 'switchLang',
        'uses' => 'LangController@postLang',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Backend
    |--------------------------------------------------------------------------|
    */
    Route::prefix('admin')->namespace('Back')->group(function () {

        Route::middleware('admin')->group(function () {
            // Home
            Route::name('admin')->get('/', 'AdminController@adminDashboard');
            // Topics
            Route::resource('topics', 'TopicController', ['except' => ['show', 'create', 'edit'] ]);
            // Users
            Route::resource('users', 'UserController', ['only' => [
                'index', 'edit', 'update', 'destroy'
            ]]);
            // Tags
            Route::resource('tags', 'TagController', ['except' => ['show', 'create', 'edit'] ]);
            // Posts
            Route::name('posts.active')->put('posts/active/{post}/{status?}', 'PostController@updateActive')->middleware('can:manage,post');
            Route::resource('posts', 'PostController', ['except' => ['show'] ]);
            // Comments
            Route::resource('comments', 'CommentController', ['only' => ['index', 'destroy']]);
            // Medias
            Route::view('medias', 'back.medias')->name('medias.index');
        });

    });

});
