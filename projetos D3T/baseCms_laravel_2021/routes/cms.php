<?php

use Cms\ProductStampsController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
  if (Auth::check()) {
    return redirect('/cms/configurations');
  } else {
    return redirect('/cms/login');
  }
});

Route::get('login', 'Cms\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Cms\Auth\LoginController@login');

Route::middleware(['auth'])->group(function () {
  Route::resource('banner', 'Cms\BannerController');
  /* Route::resource('products','Cms\ProductsController'); */
  Route::resource('dashboard', 'Cms\DashboardController');
  Route::resource('configurations', 'Cms\ConfigurationController');
  Route::resource('pages', 'Cms\PageController');
  Route::resource('teste', 'Cms\TesteController');
  Route::resource('clients', 'Cms\ClientsController');

  Route::prefix('blog')->group(function () {
    Route::resource('blog_categories', 'Cms\BlogCategoriesController');
    Route::resource('blog_posts', 'Cms\BlogPostsController');
    Route::resource('blog_posts.gallery', 'Cms\BlogGalleryController');
    Route::post('upload-images', 'Cms\UploadImageController@editorUpload')->name('upload-images');
    Route::get('/preview/{slug}', 'Cms\BlogPostsController@preview')->name('blog.preview');
  });

  Route::post('logout', 'Cms\Auth\LoginController@logout')->name('logout');

  Route::prefix('admin')->group(function () {
    Route::resource('groups', 'Cms\GroupsController');
    Route::resource('users', 'Cms\UsersController');
  });

/*   Route::prefix('pages')->group(function () {
    Route::resource('pages2', 'Cms\PageController');
    Route::resource('pages_teste', 'Cms\TesteController');
  }); */

  Route::prefix('products')->group(function () {
    Route::resource('products','Cms\ProductsController');
    Route::resource('products_category','Cms\ProductCategoryController');
    Route::resource('products_sub_category','Cms\ProductSubCategoryController');
    Route::resource('products.stamp','Cms\ProductStampsController');
  });
});
